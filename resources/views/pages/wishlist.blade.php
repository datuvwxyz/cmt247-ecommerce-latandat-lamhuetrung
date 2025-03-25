@extends('welcome')
@section('content')
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