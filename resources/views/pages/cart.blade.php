@extends('welcome')
@section('content')
<div class="card">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col">
                        <h4><b>Giỏ hàng</b></h4>
                    </div>
                    <div class="col align-self-center text-right text-muted">{{ $totalQuantity }} sản phẩm</div>
                </div>
            </div>

            <div class="row border-top border-bottom">
                @if ($cartItems->isNotEmpty())
                @foreach ($cartItems as $item)
                <div class="row align-items-center py-3" style="display: flex;">
                    <div class="col-4">
                        <img style="width: 7.5rem;" src="{{ Storage::url($item->product->image) }}">
                    </div>

                    <div class="col">
                        <div class="row text-muted">{{ $item->product->category->name ?? 'Không rõ danh mục' }}
                        </div>
                        <div class="row">{{ $item->product->name }}</div>
                    </div>

                    {{-- Số lượng --}}
                    <div class="col d-flex" style="margin: auto;display: flex;">
                        <form action="{{ route('carts.update', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                            <button type="submit" class="cart-link"
                                {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                        </form>

                        <span class="border px-2">{{ $item->quantity }}</span>

                        <form action="{{ route('carts.update', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                            <button type="submit" class="cart-link">+</button>
                        </form>
                    </div>

                    {{-- Giá tiền --}}
                    <div class="col" style="margin: auto;">
                        {{ number_format($item->product->price, 0, ',', '.') }} VNĐ
                    </div>

                    {{-- Nút xoá --}}
                    <div class="col">
                        <form action="{{ route('carts.destroy', $item->id) }}" method="POST"
                            class="delete-cart-item">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                        </form>
                    </div>
                    @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công',
                            text: '{{ session('
                            success ') }}',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    </script>
                    @endif
                </div>
                @endforeach
                @else
                <p class="text-center mt-4">Không có sản phẩm trong giỏ hàng.</p>
                @endif
            </div>
            <div class="back-to-shop"><a href="{{ route('home') }}">&leftarrow; <span class="text-muted">Quay lại trang
                        chính</a></span></div>
        </div>
        <div class="col-md-4 summary">
            <div>
                <h5><b>Tổng cộng</b></h5>
            </div>
            <hr>
            <div class="row">
                <div class="col" style="padding-left:0;">{{ $totalQuantity }} sản phẩm</div>
                <div class="col text-right">{{ number_format($totalPrice, 0, ',', '.') }} VNĐ</div>
            </div>

            <form class="cart-form my-3">
                <p>Giao hàng</p>
                <select class="cart-select form-select">
                    <option class="text-muted" value="standard">Giao hàng tiêu chuẩn - 30.000đ</option>
                    <option class="text-muted" value="fast">Giao hàng nhanh - 50.000đ</option>
                    <option class="text-muted" value="free">Miễn phí (đơn trên 500.000đ)</option>
                </select>
            </form>

            <div class="row border-top pt-3">
                <div class="col">Tổng tiền</div>
                <div class="col text-right">{{ number_format($totalPrice, 0, ',', '.') }} VNĐ</div>
            </div>

            <button class="btn btn-primary mt-3">Thanh toán</button>

        </div>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-cart-item');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = button.closest('form');

                Swal.fire({
                    title: 'Xác nhận xoá?',
                    text: "Bạn có chắc chắn muốn xoá sản phẩm này khỏi giỏ hàng?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Xoá',
                    cancelButtonText: 'Huỷ',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>