@extends('welcome')
@section('content')
    <div class="card">
        <div class="row">
            <div class="col-md-12 cart">
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
                                <div class="col-4" style="margin-right: 15px;">
                                    <!-- Thay đổi từ radio thành checkbox -->
                                    <input type="checkbox" class="product-checkbox" data-id="{{ $item->id }}" name="check[]" style="width: 15px;height: 15px;border-radius: 50%;">
                                </div>
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
                                <div class="col" style="display: flex;">
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
                                            text: '{{ session('success') }}',
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

                <div class="back-to-shop"><a href="{{ route('home') }}">&leftarrow; <span class="text-muted">Quay lại trang chính</a></span></div>

                <button style="margin-left: 10px;height: 35px;" class="btn btn-primary mt-3" id="checkout-btn">Thanh toán</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectedItems = [];

            // Lắng nghe sự kiện click vào ô chọn sản phẩm (checkbox)
            const checkboxes = document.querySelectorAll('.product-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const productId = this.getAttribute('data-id');

                    if (this.checked) {
                        selectedItems.push(productId); // Thêm sản phẩm vào mảng khi chọn
                    } else {
                        const index = selectedItems.indexOf(productId);
                        if (index > -1) {
                            selectedItems.splice(index, 1); // Xoá sản phẩm khỏi mảng khi bỏ chọn
                        }
                    }
                });
            });

            // Xử lý sự kiện nhấn nút thanh toán
            const checkoutButton = document.getElementById('checkout-btn');
            checkoutButton.addEventListener('click', function() {
                if (selectedItems.length === 0) {
                    Swal.fire('Vui lòng chọn ít nhất một sản phẩm để thanh toán!');
                    return;
                }

                // Chuyển đến trang thanh toán với các id sản phẩm đã chọn
                window.location.href = "{{ route('checkout') }}?cart_items=" + selectedItems.join(',');
            });
        });
    </script>
@endsection
