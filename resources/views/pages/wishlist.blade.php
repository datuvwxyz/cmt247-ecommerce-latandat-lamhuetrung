@extends('welcome')
@section('content')
<style>
    .wishlist-container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .wishlist-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .wishlist-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .wishlist-item:last-child {
        border-bottom: none;
    }

    .wishlist-item img {
        max-width: 100px;
        margin-right: 20px;
    }

    .wishlist-item-details {
        flex: 1;
    }

    .wishlist-item-actions {
        text-align: right;
    }

    .wishlist-item-actions button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }

    .wishlist-item-actions button:hover {
        background-color: #0056b3;
    }
</style>
<div class="wishlist-container">
    <h1 class="wishlist-header">My Wishlist</h1>
    @php
        $wishlistItems = [
            (object)[
                'image' => 'https://via.placeholder.com/100',
                'name' => 'Product 1',
                'description' => 'Description for product 1'
            ],
            (object)[
                'image' => 'https://via.placeholder.com/100',
                'name' => 'Product 2',
                'description' => 'Description for product 2'
            ],
            (object)[
                'image' => 'https://via.placeholder.com/100',
                'name' => 'Product 3',
                'description' => 'Description for product 3'
            ]
        ];
    @endphp
    @foreach($wishlistItems as $item)
    <div class="wishlist-item">
        <img src="{{ $item->image }}" alt="{{ $item->name }}">
        <div class="wishlist-item-details">
            <h3>{{ $item->name }}</h3>
            <p>{{ $item->description }}</p>
        </div>
        <div class="wishlist-item-actions">
            <button>Remove</button>
        </div>
    </div>
    @endforeach
</div>
@endsection
