<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <ul class="main-nav nav navbar-nav">
                    <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="{{ Request::is('danh-muc') ? 'active' : '' }}"><a href="#">Danh mục</a></li>
                    <li class="{{ Request::is('store') ? 'active' : '' }}"><a href="{{ route('store') }}">Sản phẩm</a></li>
                    <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Liên hệ</a></li>
                </ul>
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>


