<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PayOS\PayOS;


class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Lấy giá trị cart_items từ URL
        $cartItemIds = explode(',', $request->query('cart_items')); // Chuyển string '6,7' thành mảng [6, 7]

        // Truy xuất thông tin CartItem từ cơ sở dữ liệu theo các cart_item_id
        $cartItems = CartItem::whereIn('id', $cartItemIds)
            ->with('product') // Lấy thông tin sản phẩm liên quan đến CartItem
            ->get();

        // Tính tổng giá trị đơn hàng
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->quantity * $cartItem->price;
        });

        // Tính phí vận chuyển (nếu cần)
        $shippingFee = $totalPrice >= 1500000 ? 0 : 30000; // Miễn phí vận chuyển nếu tổng trên 1.5 triệu

        // Trả lại view và truyền dữ liệu
        return view('pages.checkout', compact('cartItems', 'totalPrice', 'shippingFee'));
    }


    public function createOrder(Request $request)
    {
        // Kiểm tra phương thức thanh toán
        $paymentMethod = $request->input('payment');
        $user = Auth::user();  // Lấy thông tin người dùng đã đăng nhập

        // Tạo đơn hàng mới
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_price = $request->input('total_price') + $request->input('shipping_fee'); // Tổng tiền đơn hàng
        $order->status = 'pending';  // Trạng thái đơn hàng, có thể thay đổi khi thanh toán hoàn tất
        $order->address = $request->input('address');  // Địa chỉ giao hàng
        $order->phone_number = $request->input('phone');  // Số điện thoại
        $order->save();

        // Thêm các mục trong đơn hàng (Order Items)
        $cartItemIds = explode(',', $request->input('cart_items')); // Lấy cart item ids từ input
        foreach ($cartItemIds as $cartItemId) {
            $cartItem = CartItem::findOrFail($cartItemId); // Lấy thông tin CartItem

            // Tạo OrderItem cho mỗi sản phẩm trong giỏ hàng
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
            ]);
        }

        // Xử lý nếu phương thức thanh toán là khi nhận hàng
        if ($paymentMethod == 'Direct') {
            // Cập nhật trạng thái của đơn hàng nếu thanh toán khi nhận hàng
            $order->status = 'pending';
            $order->save();
            // Xóa các sản phẩm trong giỏ hàng sau khi tạo đơn hàng
            CartItem::destroy($cartItemIds);

            // Redirect đến trang thành công hoặc trang chi tiết đơn hàng
            return redirect()->route('home', ['order' => $order->id])->with('success', 'Đặt hàng thành công!');
        } else if ($paymentMethod == 'VnPay') {

            $code_order = rand(0,9999);
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/home";
            $vnp_TmnCode = "FDN6NFWD";//Mã website tại VNPAY
            $vnp_HashSecret = "KMW9FDHZPHWZTDCMV6YW5GNWZHS00G5X"; //Chuỗi bí mật

            $vnp_TxnRef = $code_order+$order['id'];
            $vnp_OrderInfo = "Thanh toán hoá đơn";
            $vnp_OrderType = "billpayment";
            $vnp_Amount = $order['total_price'] * 100;
            $vnp_Locale = "vn";
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
                , 'message' => 'success'
                , 'data' => $vnp_Url);
                if (isset($_POST['payment-btn'])) {
                    $order->status = 'completed';
                    $order->save();
                    // Xóa các sản phẩm trong giỏ hàng sau khi tạo đơn hàng
                    CartItem::destroy($cartItemIds);
                    return redirect()->to($vnp_Url);
                } else {
                    echo json_encode($returnData);
                }
        }else if ($paymentMethod == 'PayOs') {
            $IdItems = $request->input('cart_items');
            $payOS = new PayOS(env('CLIENT_ID'), env('API_KEY'), env('CHECKSUM_KEY'));
            // Tạo giao dịch thanh toán
            $data = [
                "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)),
                // "amount" => floatval($request->input('total_price') + $request->input('shipping_fee')),
                "amount" => 2000,
                "description" => $cartItem->product->name,
                "items" => [
                    [
                        "name" => $cartItem->product->name,
                        "quantity" => $cartItem->quantity,
                        "price" => floatval($cartItem->price)
                    ]
                ],
                "returnUrl" => "http://127.0.0.1:8000/home",
                "cancelUrl" => "http://127.0.0.1:8000/checkout?cart_items=$IdItems"
            ];

            try {
                $response = $payOS->createPaymentLink($data);
                return redirect($response['checkoutUrl']);
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }

    }
}
