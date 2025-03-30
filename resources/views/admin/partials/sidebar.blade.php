<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <img src="/img/logo/cmtLogo.png" alt="" style="width: 170px; height: 60px;">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý website
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
            aria-expanded="true" aria-controls="collapseUsers">
            <i class="fa-solid fa-user"></i>
            <span>Người dùng</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Chức năng:</h6>
                <a class="collapse-item" onclick="DangPhatTrien()">Thêm mới</a>
                <a class="collapse-item" onclick="DangPhatTrien()">Danh sách</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTypeProducts"
            aria-expanded="true" aria-controls="collapseTypeProducts">
            <i class="fa-solid fa-boxes-stacked"></i>
            <span>Danh mục</span>
        </a>
        <div id="collapseTypeProducts" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Chức năng:</h6>
                <a class="collapse-item" href="{{ route('categories.create') }}">Thêm mới</a>
                <a class="collapse-item" href="{{ route('categories.index') }}">Danh sách</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTypeBrands"
            aria-expanded="true" aria-controls="collapseTypeBrands">
            <i class="fa-solid fa-laptop"></i>
            <span>Thương hiệu</span>
        </a>
        <div id="collapseTypeBrands" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Chức năng:</h6>
                <a class="collapse-item" href="{{ route('brands.create') }}">Thêm mới</a>
                <a class="collapse-item" href="{{ route('brands.index') }}">Danh sách</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts"
            aria-expanded="true" aria-controls="collapseProducts">
            <i class="fa-solid fa-box"></i>
            <span>Sản phẩm</span>
        </a>
        <div id="collapseProducts" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Chức năng:</h6>
                <a class="collapse-item" href="{{ route('products.create') }}">Thêm mới</a>
                <a class="collapse-item" href="{{ route('products.index') }}">Danh sách</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link " href="https://my.payos.vn/dc15f29c0d5d11f08bac0242ac110002/dashboard">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Đơn hàng</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Thống kê
    </div>

    <li class="nav-item">
        <a class="nav-link" onclick="DangPhatTrien()">
            <i class="fa-solid fa-chart-pie"></i>
            <span>Sản phẩm</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" onclick="DangPhatTrien()">
            <i class="fa-solid fa-chart-simple"></i>
            <span>Đơn hàng</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" onclick="DangPhatTrien()">
            <i class="fa-solid fa-chart-line"></i>
            <span>Doanh thu</span></a>
    </li>


    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link" onclick="DangPhatTrien()">
            <i class="fa-solid fa-gears"></i>
            <span>Cài đặt</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

<script>
    function DangPhatTrien() {
        Swal.fire({
            title: 'Tính năng đăng phát triển!',
            text: 'Tính năng này còn đang trong quá trình phát triển.',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    }
</script>
