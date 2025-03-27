@extends('dashboard')
@section('title', 'Thống Kê Sản Phẩm')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Thống Kê Sản Phẩm</h3>
        </div>
        <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Thống Kê Sản Phẩm</h3>
            <div class="card-tools">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-file-export"></i> Xuất Báo Cáo
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('export.statistics') }}?type=pdf" class="dropdown-item">
                            <i class="far fa-file-pdf"></i> Xuất PDF
                        </a>
                        <a href="{{ route('export.statistics') }}?type=excel" class="dropdown-item">
                            <i class="far fa-file-excel"></i> Xuất Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalProducts }}</h3>
                            <p>Tổng Số Sản Phẩm</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalActiveProducts }}</h3>
                            <p>Sản Phẩm Còn Hàng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $totalOutOfStockProducts }}</h3>
                            <p>Sản Phẩm Hết Hàng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-alert-circled"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Top 10 Sản Phẩm Bán Chạy</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sản Phẩm</th>
                                        <th>Số Lượng Bán</th>
                                        <th>Doanh Thu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($topSellingProducts as $item)
                                    <tr>
                                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                                        <td>{{ $item->total_quantity }}</td>
                                        <td>{{ number_format($item->total_revenue) }} VNĐ</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Chưa có dữ liệu bán hàng</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sản Phẩm Sắp Hết Hàng</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sản Phẩm</th>
                                        <th>Số Lượng Tồn</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($lowStockProducts as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                                Nhập Thêm
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tất cả sản phẩm đều đủ hàng</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thống Kê Theo Danh Mục</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Danh Mục</th>
                                        <th>Số Lượng Sản Phẩm</th>
                                        <th>Tổng Số Lượng Tồn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($productsByCategory as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->products_count }}</td>
                                        <td>{{ $category->total_quantity }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Chưa có danh mục</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thống Kê Theo Thương Hiệu</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Thương Hiệu</th>
                                        <th>Số Lượng Sản Phẩm</th>
                                        <th>Tổng Số Lượng Tồn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($productsByBrand as $brand)
                                    <tr>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->products_count }}</td>
                                        <td>{{ $brand->total_quantity }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Chưa có thương hiệu</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection