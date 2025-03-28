@extends('dashboard')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chi tiết đơn hàng</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Thông tin người mua</h4>
                    <p><strong>Tên người mua:</strong> {{ $order->user->name }}</p>
                    <p><strong>Số điện thoại:</strong> {{ $order->phone_number }}</p>
                    <p><strong>Địa chỉ giao hàng:</strong> {{ $order->address }}</p>
                </div>
                <div class="col-md-6">
                    <h4>Thông tin đơn hàng</h4>
                    <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }} VNĐ</p>
                    <p><strong>Trạng thái:</strong> {{ $order->status }}</p>
                    <p><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
                </div>
            </div>

            <h4>Danh sách sản phẩm</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $orderItem)
                        <tr>
                            <td>{{ $orderItem->product->name }}</td>
                            <td>{{ $orderItem->quantity }}</td>
                            <td>{{ number_format($orderItem->price, 0, ',', '.') }} VNĐ</td>
                            <td>{{ number_format($orderItem->quantity * $orderItem->price, 0, ',', '.') }} VNĐ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
