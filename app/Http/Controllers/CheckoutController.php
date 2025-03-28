<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if ($paymentMethod == 'payment-3') {
            // Cập nhật trạng thái của đơn hàng nếu thanh toán khi nhận hàng
            $order->status = 'waiting_for_delivery'; // Trạng thái có thể thay đổi theo yêu cầu
            $order->save();
        }

        // Xóa các sản phẩm trong giỏ hàng sau khi tạo đơn hàng
        CartItem::destroy($cartItemIds);

        // Redirect đến trang thành công hoặc trang chi tiết đơn hàng
        return redirect()->route('home', ['order' => $order->id])->with('success', 'Thanh toán thành công!');
    }
}
