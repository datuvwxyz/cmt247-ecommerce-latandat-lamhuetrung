<div class="row">
    <!-- shop -->
    <a href="{{ route('store', ['categories' => 'Laptop']) }}">
    <div class="col-md-4 col-xs-6">
        <div class="shop">
            <div class="shop-img">
                <img src="./img/shop01.png" alt="" />
            </div>
            <div class="shop-body">
                <h3>Bộ sưu tập<br />Laptop</h3>
                <a href="{{ route('store', ['categories' => 'Laptop']) }}" class="cta-btn">Mua ngay <i class="fa fa-shopping-cart"></i></a>
            </div>
        </div>
    </div>
    </a>
    <!-- /shop -->

    <!-- shop -->
    <a href="{{ route('store', ['categories' => 'Phụ kiện']) }}">
    <div class="col-md-4 col-xs-6">
        <div class="shop">
            <div class="shop-img">
                <img src="./img/shop03.png" alt="" />
            </div>
            <div class="shop-body">
                <h3>Bộ sưu tập<br />Phụ kiện</h3>
                <a href="{{ route('store', ['categories' => 'Phụ kiện']) }}" class="cta-btn">Mua ngay <i class="fa fa-shopping-cart"></i></a>
            </div>
        </div>
    </div>
    </a>
    <!-- /shop -->

    <!-- shop -->
    <a href="{{ route('store', ['categories' => 'Camera']) }}">
        <div class="col-md-4 col-xs-6">
            <div class="shop">
                <div class="shop-img">
                    <img src="./img/shop02.png" alt="" />
                </div>
                <div class="shop-body">
                    <h3>Bộ sưu tập<br />Camera</h3>
                    <a href="{{ route('store', ['categories' => 'Camera']) }}" class="cta-btn">Mua ngay <i class="fa fa-shopping-cart"></i></a>
                </div>
            </div>
        </div>
    </a>

    <!-- /shop -->
</div>