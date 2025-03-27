<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // GET /cart - Xem giỏ hàng
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $cartItems = $cart->cartItems()->with('product')->get();

        // Tính tổng số lượng sản phẩm trong giỏ
        $totalQuantity = $cartItems->sum('quantity');
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });


        return view('pages.cart', compact('cartItems', 'totalQuantity', 'totalPrice'));
    }

    // POST /cart - Thêm sản phẩm vào giỏ
    public function store(AddToCartRequest $request)
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $product = Product::findOrFail($request->product_id);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;

            if ($newQuantity > $product->quantity) {
                return back()->withErrors(['quantity' => "Chỉ còn {$product->quantity} sản phẩm trong kho."]);
            }

            $cartItem->quantity = $newQuantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price*$request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    // PUT /cart/{id} - Cập nhật số lượng
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($id);
        $product = Product::findOrFail($cartItem->product_id);

        if ($request->quantity > $product->quantity) {
            return back()->withErrors(['quantity' => "Chỉ còn {$product->quantity} sản phẩm trong kho."]);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->price = $cartItem->price*$request->quantity;
        $cartItem->save();

        return redirect()->back()->with('success', 'Cập nhật số lượng thành công!');
    }

    // DELETE /cart/{id} - Xoá sản phẩm khỏi giỏ
    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Đã xoá sản phẩm khỏi giỏ hàng!');
    }
}
