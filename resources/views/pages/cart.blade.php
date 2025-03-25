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
