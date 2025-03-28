@extends('welcome')
@section('content')
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-7">
                <!-- Billing Details -->
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Thông tin nhận hàng</h3>
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="first-name" placeholder="Họ">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="last-name" placeholder="Tên đệm & tên">
                    </div>
                    <div class="form-group">
                        <input class="input" type="tel" name="tel" placeholder="Số điện thoại">
                    </div>
                </div>
                <!-- /Billing Details -->

                <!-- Shipping Details -->
                <div class="shiping-details">
                    <div class="section-title">
                        <h3 class="title">Địa chỉ giao hàng</h3>
                    </div>
                    <!-- Chọn thành phố -->
                    <div class="form-group">
                        <select class="input" id="city-select">
                            <option value="">Chọn Thành Phố</option>
                            <!-- Thành phố sẽ được điền qua JS -->
                        </select>
                    </div>
                    <!-- Chọn quận/huyện -->
                    <div class="form-group">
                        <select class="input" id="district-select">
                            <option value="">Chọn Quận/Huyện</option>
                        </select>
                    </div>
                    <!-- Chọn xã/phường -->
                    <div class="form-group">
                        <select class="input" id="ward-select">
                            <option value="">Chọn Xã/Phường</option>
                        </select>
                    </div>
                    <!-- Ô nhập địa chỉ chi tiết -->
                    <div class="form-group">
                        <input id="address-detail" class="input" type="text" placeholder="Nhập địa chỉ cụ thể">
                    </div>
                </div>
                <!-- /Shipping Details -->

                <!-- Order notes -->
                <div class="order-notes">
                    <textarea class="input" placeholder="Lưu ý khi giao hàng"></textarea>
                </div>
                <!-- /Order notes -->
            </div>

            <!-- Order Details -->
            <div class="col-md-5 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Thông tin đơn hàng</h3>
                </div>
                <div class="order-summary">
                    <div class="order-col">
                        <div><strong>Số lượng</strong></div>
                        <div><strong>Sản phẩm</strong></div>
                        <div><strong>Giá tiền</strong></div>
                    </div>

                    <div class="order-products">
                        @php
                            $totalPrice = 0;
                        @endphp
                        @foreach ($cartItems as $cartItem)
                            @php
                                $totalPrice += $cartItem->quantity * $cartItem->price;
                            @endphp
                            <div class="order-col">
                                <div>{{ $cartItem->quantity }} </div>
                                <div>{{ $cartItem->product->name }}</div>
                                <div>{{ number_format( $cartItem->price, 0, ',', '.') }} VNĐ</div>
                            </div>
                        @endforeach
                    </div>

                    <div class="order-col">
                        <div>Shipping</div>
                        <div>
                            @if ($totalPrice >= 1500000)
                                <strong>FREE</strong>
                            @else
                                <strong>{{ number_format($shippingFee, 0, ',', '.') }} VNĐ</strong>
                            @endif
                        </div>
                    </div>

                    <div class="order-col">
                        <div><strong>Tổng tiền</strong></div>
                        <div><strong class="order-total">{{ number_format($totalPrice + $shippingFee, 0, ',', '.') }} VNĐ</strong></div>
                    </div>
                </div>

                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <input type="hidden" name="cart_items" value="{{ implode(',', $cartItems->pluck('id')->toArray()) }}">
                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                    <input type="hidden" name="shipping_fee" value="{{ $shippingFee }}">
                    <input type="hidden" name="address" value="{{ request('address-detail') }}">
                    <input type="hidden" name="phone" value="{{ request('tel') }}">

                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-2">
                            <label for="payment-2">
                                <span></span>
                                Thanh toán online
                            </label>
                            <div class="caption">
                                <p>Sacombank, MB bank, Vietcombank, Viettinbank</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-3">
                            <label for="payment-3">
                                <span></span>
                                Thanh toán khi nhận hàng
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="primary-btn order-submit" id="order-submit">Hoàn tất</button>
                </form>
            </div>

            <!-- /Order Details -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const citySelect = document.getElementById('city-select');
        const districtSelect = document.getElementById('district-select');
        const wardSelect = document.getElementById('ward-select');

        // Dữ liệu mẫu cho các thành phố, quận/huyện và xã/phường từ TP.Hồ Chí Minh đến Trà Vinh
        const cities = ["Hồ Chí Minh", "Trà Vinh"];
        const districts = {
            "Hồ Chí Minh": ["Quận 1", "Quận 2", "Quận 3"],
            "Trà Vinh": ["Trà Cú", "Càng Long", "Duyên Hải"]
        };
        const wards = {
            "Quận 1": ["Phường Bến Nghé", "Phường Đa Kao"],
            "Trà Cú": ["Phường 1", "Phường 2"]
        };

        // Cập nhật thành phố
        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city;
            option.textContent = city;
            citySelect.appendChild(option);
        });

        // Cập nhật quận khi chọn thành phố
        citySelect.addEventListener('change', function() {
            const selectedCity = this.value;
            districtSelect.innerHTML = "<option value=''>Chọn Quận/Huyện</option>";  // Reset quận/huyện

            if (districts[selectedCity]) {
                districts[selectedCity].forEach(district => {
                    const option = document.createElement('option');
                    option.value = district;
                    option.textContent = district;
                    districtSelect.appendChild(option);
                });
            }
        });

        // Cập nhật xã/phường khi chọn quận/huyện
        districtSelect.addEventListener('change', function() {
            const selectedDistrict = this.value;
            wardSelect.innerHTML = "<option value=''>Chọn Xã/Phường</option>";  // Reset xã/phường

            if (wards[selectedDistrict]) {
                wards[selectedDistrict].forEach(ward => {
                    const option = document.createElement('option');
                    option.value = ward;
                    option.textContent = ward;
                    wardSelect.appendChild(option);
                });
            }
        });

        // Cập nhật nút "Hoàn tất" dựa trên phương thức thanh toán
        const paymentRadios = document.querySelectorAll('input[name="payment"]');
        const orderSubmitButton = document.getElementById('order-submit');

        paymentRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (document.getElementById('payment-2').checked) {
                    orderSubmitButton.textContent = 'Thanh toán';
                } else if (document.getElementById('payment-3').checked) {
                    orderSubmitButton.textContent = 'Hoàn tất';
                }
            });
        });
    });
</script>
