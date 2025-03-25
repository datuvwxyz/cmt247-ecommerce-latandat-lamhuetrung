@extends('welcome')
@section('content')
<<<<<<< HEAD
<div class="cart-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-heading mb-10">My wishlist</div>
                <div class="table-wishlist">
                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                        <thead>
                            <tr>
                                <th width="45%">Product Name</th>
                                <th width="15%">Unit Price</th>
                                <th width="15%">Stock Status</th>
                                <th width="15%"></th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="45%">
                                    <div class="display-flex align-center">
                                        <div class="img-product">
                                            <img src="https://www.91-img.com/pictures/laptops/asus/asus-x552cl-sx019d-core-i3-3rd-gen-4-gb-500-gb-dos-1-gb-61721-large-1.jpg" alt="" class="mCS_img_loaded">
                                        </div>
                                        <div class="name-product">
                                            Apple iPad Mini
                                        </div>
                                    </div>
                                </td>
                                <td width="15%" class="price">$110.00</td>
                                <td width="15%"><span class="in-stock-box">In Stock</span></td>
                                <td width="15%"><button class="round-black-btn small-btn">Add to Cart</button></td>
                                <td width="10%" class="text-center"><a href="#" class="trash-icon"><i class="far fa-trash-alt"></i></a></td>
                            </tr>
                            <tr>
                                <td width="45%">
                                    <div class="display-flex align-center">
                                        <div class="img-product">
                                            <img src="https://www.91-img.com/pictures/laptops/asus/asus-x552cl-sx019d-core-i3-3rd-gen-4-gb-500-gb-dos-1-gb-61721-large-1.jpg" alt="" class="mCS_img_loaded">
                                        </div>
                                        <div class="name-product">
                                            Apple iPad Mini
                                        </div>
                                    </div>
                                </td>
                                <td width="15%" class="price">$110.00</td>
                                <td width="15%"><span class="in-stock-box">In Stock</span></td>
                                <td width="15%"><button class="round-black-btn small-btn">Add to Cart</button></td>
                                <td width="10%" class="text-center"><a href="#" class="trash-icon"><i class="far fa-trash-alt"></i></a></td>
                            </tr>
                            <tr>
                                <td width="45%">
                                    <div class="display-flex align-center">
                                        <div class="img-product">
                                            <img src="https://www.91-img.com/pictures/laptops/asus/asus-x552cl-sx019d-core-i3-3rd-gen-4-gb-500-gb-dos-1-gb-61721-large-1.jpg" alt="" class="mCS_img_loaded">
                                        </div>
                                        <div class="name-product">
                                            Apple iPad Mini
                                        </div>
                                    </div>
                                </td>
                                <td width="15%" class="price">$110.00</td>
                                <td width="15%"><span class="in-stock-box">In Stock</span></td>
                                <td width="15%"><button class="round-black-btn small-btn">Add to Cart</button></td>
                                <td width="10%" class="text-center"><a href="#" class="trash-icon"><i class="far fa-trash-alt"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="back-to-shop"><a href="{{route('home')}}">&leftarrow; <span class="text-muted">Quay lại trang chính</a></span></div>
            </div>
        </div>
    </div>
</div>
@endsection
=======
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
>>>>>>> 1caad101946840d550a27e6cd657752c6768a002
