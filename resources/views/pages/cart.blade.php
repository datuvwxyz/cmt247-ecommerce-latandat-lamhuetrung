@extends('welcome')
@section('content')
<<<<<<< HEAD
<div class="card">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col">
                        <h4><b>Giỏ hàng</b></h4>
                    </div>
                    <div class="col align-self-center text-right text-muted">3 items</div>
                </div>
            </div>
            <div class="row border-top border-bottom">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/1GrakTl.jpg"></div>
                    <div class="col">
                        <div class="row text-muted">Shirt</div>
                        <div class="row">Cotton T-shirt</div>
                    </div>
                    <div class="col">
                        <a class="cart-link" href="#">-</a><a href="#" class="border">1</a><a class="cart-link" href="#">+</a>
                    </div>
                    <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                </div>
            </div>
            <div class="row">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/ba3tvGm.jpg"></div>
                    <div class="col">
                        <div class="row text-muted">Shirt</div>
                        <div class="row">Cotton T-shirt</div>
                    </div>
                    <div class="col">
                        <a class="cart-link" href="#">-</a><a href="#" class="border">1</a><a class="cart-link" href="#">+</a>
                    </div>
                    <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                </div>
            </div>
            <div class="row border-top border-bottom">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/pHQ3xT3.jpg"></div>
                    <div class="col">
                        <div class="row text-muted">Shirt</div>
                        <div class="row">Cotton T-shirt</div>
                    </div>
                    <div class="col">
                        <a class="cart-link" href="#">-</a><a href="#" class="border">1</a><a class="cart-link" href="#">+</a>
                    </div>
                    <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                </div>
            </div>
            <div class="back-to-shop"><a href="{{route('home')}}">&leftarrow; <span class="text-muted">Quay lại trang chính</a></span></div>
        </div>
        <div class="col-md-4 summary">
            <div>
                <h5><b>Tổng cộng</b></h5>
            </div>
            <hr>
            <div class="row">
                <div class="col" style="padding-left:0;">ITEMS 3</div>
                <div class="col text-right">&euro; 132.00</div>
            </div>
            <form class="cart-form">
                <p>Giao hàng</p>
                <select class="cart-select">
                    <option class="text-muted">Standard-Delivery- &euro;5.00</option>
                </select>
                <p>Mã giảm giá</p>
                <input class="cart-input" id="code" placeholder="Nhập mã giảm giá">
            </form>
            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col">Tổng tiền</div>
                <div class="col text-right">VNĐ</div>
            </div>
            <button class="btn">Thanh toán</button>
        </div>
    </div>
</div>
@endsection
=======
<style>
    .cart-container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .cart-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item img {
        max-width: 100px;
        margin-right: 20px;
    }

    .cart-item-details {
        flex: 1;
    }

    .cart-item-actions {
        text-align: right;
    }

    .cart-item-actions button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }

    .cart-item-actions button:hover {
        background-color: #0056b3;
    }

    .cart-total {
        text-align: right;
        margin-top: 20px;
        font-size: 1.2em;
    }
</style>
<div class="cart-container">
    <h1 class="cart-header">My Cart</h1>
    @php
        $cartItems = [
            (object)[
                'image' => 'https://via.placeholder.com/100',
                'name' => 'Product 1',
                'description' => 'Description for product 1',
                'price' => 29.99
            ],
            (object)[
                'image' => 'https://via.placeholder.com/100',
                'name' => 'Product 2',
                'description' => 'Description for product 2',
                'price' => 49.99
            ],
            (object)[
                'image' => 'https://via.placeholder.com/100',
                'name' => 'Product 3',
                'description' => 'Description for product 3',
                'price' => 19.99
            ]
        ];
        $total = array_reduce($cartItems, function($carry, $item) {
            return $carry + $item->price;
        }, 0);
    @endphp
    @foreach($cartItems as $item)
    <div class="cart-item">
        <img src="{{ $item->image }}" alt="{{ $item->name }}">
        <div class="cart-item-details">
            <h3>{{ $item->name }}</h3>
            <p>{{ $item->description }}</p>
            <p>${{ number_format($item->price, 2) }}</p>
        </div>
        <div class="cart-item-actions">
            <button>Remove</button>
        </div>
    </div>
    @endforeach
    <div class="cart-total">
        <strong>Total: ${{ number_format($total, 2) }}</strong>
    </div>
</div>
@endsection
>>>>>>> 1caad101946840d550a27e6cd657752c6768a002
