<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index()
    {
        // Lấy danh sách đơn hàng và thông tin chi tiết các mặt hàng trong đơn hàng
        $orders = Order::with('user', 'orderItems.product')->get();  // Eager load để giảm số lần truy vấn
        return view('admin.pages.order.listOrder', compact('orders'));
    }

    // Xem chi tiết đơn hàng
    public function show($id)
    {
        // Lấy thông tin chi tiết đơn hàng theo ID
        $order = Order::with('user', 'orderItems.product')->findOrFail($id);
        return view('admin.pages.order.showOrder', compact('order'));
    }
}

