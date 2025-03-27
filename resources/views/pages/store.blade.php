@extends('welcome')
@section('content')
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Danh mục</h3>
                    <div class="checkbox-filter">
                        @foreach($categories as $index => $category)
                        <div class="input-checkbox category-item" style="{{ $index >= 5 ? 'display: none;' : '' }}">
                            <input type="checkbox" id="category-{{ $category->id }}" value="{{ $category->id }}">
                            <label for="category-{{ $category->id }}">
                                <span></span>
                                {{ $category->name }}
                                <small>({{ $category->product_count }})</small>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @if(count($categories) > 5)
                    <button id="toggleCategories" class="show-more-btn">Xem thêm</button>
                    @endif
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Giá</h3>
                    <div class="price-filter">
                        <div id="price-slider"></div>
                        <div class="input-number price-min">
                            <input id="price-min" type="number">
                            <span class="qty-up">+</span>
                            <span class="qty-down">-</span>
                        </div>
                        <span>-</span>
                        <div class="input-number price-max">
                            <input id="price-max" type="number">
                            <span class="qty-up">+</span>
                            <span class="qty-down">-</span>
                        </div>
                    </div>
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Thương hiệu</h3>
                    <div class="checkbox-filter">
                        @foreach($brands as $index => $brand)
                        <div class="input-checkbox brand-item" style="{{ $index >= 5 ? 'display: none;' : '' }}">
                            <input type="checkbox" id="brand-{{ $brand->id }}" value="{{ $brand->id }}">
                            <label for="brand-{{ $brand->id }}">
                                <span></span>
                                {{ $brand->name }}
                                <small>({{ $brand->product_count }})</small>
                            </label>
                        </div>
                        @endforeach
                    </div>

                    @if(count($brands) > 5)
                    <button id="toggleBrands" class="show-more-btn">Xem thêm</button>
                    @endif
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Bán chạy nhất</h3>
                    <div class="product-widget">
                        <div class="product-img">
                            <img src="./img/product01.png" alt="">
                        </div>
                        <div class="product-body">
                            <p class="product-category">Category</p>
                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                            <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                        </div>
                    </div>

                    <div class="product-widget">
                        <div class="product-img">
                            <img src="./img/product02.png" alt="">
                        </div>
                        <div class="product-body">
                            <p class="product-category">Category</p>
                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                            <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                        </div>
                    </div>

                    <div class="product-widget">
                        <div class="product-img">
                            <img src="./img/product03.png" alt="">
                        </div>
                        <div class="product-body">
                            <p class="product-category">Category</p>
                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                            <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                        </div>
                    </div>
                </div>
                <!-- /aside Widget -->
            </div>
            <!-- /ASIDE -->

            <!-- STORE -->
            <div id="store" class="col-md-9">
                <!-- store top filter -->
                <div class="store-filter clearfix">
                    <div class="store-sort">
                        <label>
                            Sắp xếp theo:
                            <select class="input-select">
                                <option value="0">Phổ biến</option>
                                <option value="1">Vị trí</option>
                            </select>
                        </label>

                        <label>
                            Show:
                            <select class="input-select">
                                <option value="0">20</option>
                                <option value="1">50</option>
                            </select>
                        </label>
                    </div>
                    <ul class="store-grid">
                        <li class="active"><i class="fa fa-th"></i></li>
                        <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                    </ul>
                </div>
                <!-- /store top filter -->

                <!-- store products -->
                <div class="row">
                    @foreach($products as $index => $product)
                    <!-- product -->
                    <div class="col-md-4 col-xs-6">
                        <div class="product">
                            <div class="product-img">
                                <a href="{{route('product', $product->id )}}">
                                    <img style="min-height: 245px; max-height: 245px;"
                                        src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                                </a>
                                <div class="product-label">
                                    {{-- <span class="sale">-30%</span> --}}
                                    @php
                                    // Kiểm tra nếu updated_at trong vòng 2 ngày gần đây
                                    $updatedWithinTwoDays = \Carbon\Carbon::parse($product->updated_at)->isAfter(\Carbon\Carbon::now()->subDays(2));
                                    @endphp
                                    @if($updatedWithinTwoDays)
                                    <span class="new">NEW</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-body">
                                <p class="product-category">{{ $product->category->name }}</p>
                                <h3 class="product-name"><a href="{{route('product', $product->id )}}">{{ $product->name }}</a></h3>
                                <h4 class="product-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ <del
                                        class="product-old-price">{{ number_format($product->price = $product->price + $product->price*10/100, 0, ',', '.') }} VNĐ</del></h4>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                {{-- <div class="product-btns">
                                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                                    class="tooltipp">add to wishlist</span></button>
                                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                                    class="tooltipp">add to compare</span></button>
                                                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick
                                                                    view</span></button>
                                                        </div> --}}
                            </div>
                            <div class="add-to-cart">
                                <form action="{{ route('carts.store') }}" method="POST">
                                    @csrf
                                    <div class="qty-label">
                                        <div class="input-number">
                                            <input type="hidden" name="quantity" min="1" value="1">
                                        </div>
                                    </div>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /product -->
                    <div class="clearfix visible-sm visible-xs"></div>
                    @endforeach
                    <!-- /product -->
                </div>
                <!-- /store products -->

                <style>
                    /* Tùy chỉnh CSS cho phân trang */
                    .pagination {
                        display: flex;
                        justify-content: flex-start;
                        /* Căn trái để các nút phân trang bắt đầu từ bên trái */
                        padding: 0;
                        margin: 0;
                        list-style: none;
                        margin-top: 20px;
                    }

                    .pagination li {
                        margin: 0 5px;
                    }

                    .page-item {
                        margin-left: 5px;
                        display: inline-block;
                        width: 40px;
                        height: 40px;
                        line-height: 40px;
                        text-align: center;
                        background-color: #FFF;
                        border: 1px solid #E4E7ED;
                        -webkit-transition: 0.2s all;
                        transition: 0.2s all;
                    }

                    .page-link {
                        display: block;
                        color: black;
                        color: #2B2D42;
                        font-weight: 500;
                        -webkit-transition: 0.2s color;
                        transition: 0.2s color;
                    }

                    .pagination>li>a,
                    .pagination>li>span {
                        position: unset;
                        float: none;
                        padding: 0;
                        margin-left: 0;
                        line-height: revert;
                        color: #333;
                        text-decoration: none;
                        background-color: #fff;
                        border: 1px solid #ddd;
                    }

                    .pagination>.active>a,
                    .pagination>.active>a:focus,
                    .pagination>.active>a:hover,
                    .pagination>.active>span,
                    .pagination>.active>span:focus,
                    .pagination>.active>span:hover,
                    .page-item.active.page-link {
                        background-color: #D10024;
                        border-color: #D10024;
                        color: #FFF;
                        font-weight: 500;
                        cursor: default;
                    }

                    .pagination>li>a:focus,
                    .pagination>li>a:hover,
                    .pagination>li>span:focus,
                    .pagination>li>span:hover {
                        color: #D10024;
                    }

                    .show-more-btn {
                        background: none;
                        border: none;
                        color: blue;
                        cursor: pointer;
                        padding: 5px 0;
                        display: block;
                        text-align: left;
                        padding-left: 20px;
                    }
                </style>
                <!-- store bottom filter -->
                <div class="store-filter clearfix">
                    <span class="store-qty">Xem {{ $products->count() }} sản phẩm</span>
                    <ul class="store-pagination">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </ul>
                </div>
                <!-- /store bottom filter -->
            </div>
            <!-- /STORE -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        function setupToggle(buttonId, itemClass) {
            let isExpanded = false;
            const button = document.getElementById(buttonId);
            const hiddenItems = document.querySelectorAll(`.${itemClass}[style='display: none;']`);

            if (button) {
                button.addEventListener("click", function() {
                    isExpanded = !isExpanded;
                    hiddenItems.forEach(item => {
                        item.style.display = isExpanded ? "block" : "none";
                    });
                    button.textContent = isExpanded ? "Thu gọn" : "Xem thêm";
                });
            }
        }

        // Toggle cho danh mục
        setupToggle("toggleCategories", "category-item");

        // Toggle cho thương hiệu
        setupToggle("toggleBrands", "brand-item");
    });
</script>
@endsection