@extends('welcome')
@section('content')
@section('scripts')
    @if(session('success'))
        <script>
            Swal.fire({
                title: 'Thành công!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Đóng'
            }).then(() => {
                window.location.href = "{{ route('brands.index') }}";
            });
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire({
                title: 'Lỗi!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'Đóng'
            });
        </script>
    @endif
@endsection
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            @include('partials.banner')
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Sản phẩm mới</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab1">Laptop</a>
                                </li>
                                <li><a data-toggle="tab" href="#tab1">Điện thoại</a></li>
                                <li><a data-toggle="tab" href="#tab1">Camera</a></li>
                                <li><a data-toggle="tab" href="#tab1">Phụ kiện</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->


                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">

                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach($products as $index => $product)
                                    @php
                                        // Kiểm tra nếu updated_at trong vòng 2 ngày gần đây
                                        $updatedWithinTwoDays = \Carbon\Carbon::parse($product->updated_at)->isAfter(\Carbon\Carbon::now()->subDays(2));
                                    @endphp
                                    @if($updatedWithinTwoDays)
                                        <div class="product">
                                            <div class="product-img">
                                                <img style="min-height: 245px; max-height: 245px;" src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" alt="" />
                                                <div class="product-label">
                                                    <span class="new">NEW</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $product->category->name }}</p>
                                                <h3 class="product-name">
                                                    <a href="{{route('product', $product->id )}}">{{ $product->name }}</a>
                                                </h3>
                                                <h4 class="product-price">
                                                    {{ number_format($product->price, 0, ',', '.') }} VNĐ <del class="product-old-price">$990.00</del>
                                                </h4>
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                {{-- <div class="product-btns">
                                                    <button class="add-to-wishlist">
                                                        <i class="fa fa-heart-o"></i><span class="tooltipp">add to
                                                            wishlist</span>
                                                    </button>
                                                    <button class="add-to-compare">
                                                        <i class="fa fa-exchange"></i><span class="tooltipp">add to
                                                            compare</span>
                                                    </button>
                                                    <button class="quick-view">
                                                        <i class="fa fa-eye"></i><span class="tooltipp">quick view</span>
                                                    </button>
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
                                    @endif
                                    @endforeach
                                    <!-- product -->

                                    <!-- /product -->

                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            @include('partials.hotdeal');
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->

    @include('partials.topselling');

    <!-- NEWSLETTER -->
    @include('partials.newlester');
    <!-- /NEWSLETTER -->
@endsection

