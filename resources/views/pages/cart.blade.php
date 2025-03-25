@extends('welcome')
@section('content')
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
