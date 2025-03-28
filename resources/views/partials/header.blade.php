<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li>
                    <a href="#"><i class="fa fa-phone"></i>0866.168.247</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-envelope-o"></i>thietbisocmt@gmail.com</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-map-marker"></i>18 Lâm Văn Vững - Phường 1 - Tp.Trà vinh</a>
                </li>
            </ul>
            <ul class="header-links pull-right">
                @if (Route::has('login'))
                    @auth
                        <li>
                            <div class="sm:flex sm:items-center sm:ms-6">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                            <div class="name-user">{{ Auth::user()->name }}</div>

                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')" class="fs-11">
                                            {{ __('Hồ sơ cá nhân') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                                                            this.closest('form').submit();"
                                                class="fs-11">
                                                {{ __('Đăng xuất') }}

                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Đăng nhập</a>
                        </li>

                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> Đăng ký</a>
                            </li>
                        @endif
                    @endauth
                @endif

            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="{{ route('home') }}" class="logo">
                            <img src="/img/logo/cmtLogo.png" alt="" />
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <div class="custom-select">
                            <div class="select-selected">Danh Mục</div>
                            <div class="select-items">
                                <?php
                                use App\Models\Category;

                                $categories = Category::orderBy('updated_at', 'desc')->get();
                                ?>
                                @foreach ($categories as $index => $category)
                                    <div>
                                        @if ($category->name == 'Laptop')
                                            <i class="fa-solid fa-laptop"></i> {{ $category->name }}
                                        @elseif($category->name == 'Card đồ hoạ')
                                            <i class="fa-solid fa-microchip"></i> {{ $category->name }}
                                        @elseif($category->name == 'Màn hình')
                                            <i class="fa-solid fa-display"></i> {{ $category->name }}
                                        @elseif($category->name == 'Máy in')
                                            <i class="fa-solid fa-print"></i> {{ $category->name }}
                                        @elseif($category->name == 'Camera')
                                            <i class="fa-solid fa-camera"></i> {{ $category->name }}
                                        @elseif($category->name == 'Loa')
                                            <i class="fa-solid fa-headphones"></i> {{ $category->name }}
                                        @elseif($category->name == 'PC')
                                            <i class="fa-solid fa-desktop"></i> {{ $category->name }}
                                        @elseif($category->name == 'Phụ kiện')
                                            <i class="fa-solid fa-keyboard"></i> {{ $category->name }}
                                        @elseif($category->name == 'Mạng')
                                            <i class="fa-solid fa-wifi"></i> {{ $category->name }}
                                        @elseif($category->name == 'Máy lạnh')
                                            <i class="fa-solid fa-fan"></i> {{ $category->name }}
                                        @else
                                            <i class="fa-solid fa-question-circle"></i> {{ $category->name }}
                                        @endif
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <form class="search-form">
                            <input class="search-input" placeholder="Nhập từ khóa tìm kiếm..." />
                            <button class="search-btn">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <div>
                            <a href="{{ route('wishlist') }}">
                                <i class="fa fa-heart-o"></i>
                                <span>Yêu thích</span>
                                <div class="qty">2</div>
                            </a>
                        </div>
                        <!-- /Wishlist -->
                        <?php
                        use App\Models\Cart;

                        use Illuminate\Support\Facades\Auth;

                        $totalQuantity = 0;
                        $totalPrice = 0;
                        $cartItems = collect();

                        if (Auth::check()) {
                            $user = Auth::user();
                            $cart = Cart::firstOrCreate(['user_id' => $user->id]);
                            $cartItems = $cart->cartItems()->with('product')->get();
                            $totalQuantity = $cartItems->sum('quantity');
                            $totalPrice = $cartItems->sum(function ($item) {
                                return $item->product->price * $item->quantity;
                            });
                        }
                        ?>
                        @if (Auth::check())
                        <!-- Cart -->
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Giỏ hàng</span>
                                <div class="qty">{{ $totalQuantity }}</div>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list">

                                    @if ($cartItems->isNotEmpty())
                                        @foreach ($cartItems as $item)
                                            <div class="product-widget">
                                                <div class="product-img">
                                                    <img src="{{ Storage::url($item->product->image) }}"
                                                        alt="" />
                                                </div>
                                                <div class="product-body">
                                                    <h3 class="product-name">
                                                        <a href="#">{{ $item->product->name }}</a>
                                                    </h3>
                                                    <h4 class="product-price">
                                                        <span
                                                            class="qty">{{ $item->quantity }}</span>{{ number_format($item->product->price, 0, ',', '.') }}
                                                        VNĐ
                                                    </h4>
                                                </div>
                                                <div class="col">
                                                    <form action="{{ route('carts.destroy', $item->id) }}"
                                                        method="POST" class="delete-cart-item">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="delete"><i
                                                                class="fa fa-close"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-center mt-4">Không có sản phẩm trong giỏ hàng.</p>
                                    @endif

                                    @if (session('success'))
                                        <script>
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Thành công',
                                                text: '{{ session('success') }}',
                                                timer: 2000,
                                                showConfirmButton: false
                                            });
                                        </script>
                                    @endif
                                </div>
                                <div class="cart-summary">
                                    <small>{{ $totalQuantity }} sản phẩm</small>
                                    <h5>Tổng tiền: {{ number_format($totalPrice, 0, ',', '.') }} VNĐ</h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="{{ route('carts.index') }}">Xem giỏ hàng</a>
                                    <a id="checkout-btn" style="cursor: pointer;">Thanh toán<i
                                            class="fa fa-arrow-circle-right"></i></a>
                                            <script>
                                                // Lắng nghe sự kiện nhấn nút thanh toán trên header
const checkoutButton = document.getElementById('checkout-btn');
checkoutButton.addEventListener('click', function() {
    // Giả sử bạn có tất cả các CartItem IDs trong mảng cartItems (có thể là từ server hoặc đã được render trong HTML)
    const cartItems = @json($cartItems); // Lấy tất cả CartItem IDs từ PHP (dữ liệu từ controller)

    if (cartItems.length === 0) {
        Swal.fire('Giỏ hàng trống. Vui lòng thêm sản phẩm để thanh toán!');
        return;
    }

    // Lấy tất cả các cart_item IDs
    const cartItemIds = cartItems.map(item => item.id); // Lấy tất cả các ID từ giỏ hàng

    // Chuyển đến trang thanh toán với các id sản phẩm đã chọn
    window.location.href = "{{ route('checkout') }}?cart_items=" + cartItemIds.join(',');
});

                                            </script>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Giỏ hàng</span>
                                <div class="qty">0</div>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list">
                                </div>
                                <div class="cart-summary">
                                    <small>0 sản phẩm</small>
                                    <h5>Tổng tiền: 0 VNĐ</h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="{{ route('carts.index') }}">Xem giỏ hàng</a>
                                    <a href="{{ route('checkout') }}">Thanh toán<i
                                            class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-cart-item');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = button.closest('form');

                    Swal.fire({
                        title: 'Xác nhận xoá?',
                        text: "Bạn có chắc chắn muốn xoá sản phẩm này khỏi giỏ hàng?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Xoá',
                        cancelButtonText: 'Huỷ',
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</header>
{{-- <nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('home') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav> --}}
