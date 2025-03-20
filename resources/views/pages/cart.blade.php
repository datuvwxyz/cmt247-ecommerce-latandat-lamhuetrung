@extends('welcome')
@section('content')
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
