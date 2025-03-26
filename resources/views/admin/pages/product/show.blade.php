@extends('dashboard')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title text-center">Chi tiết sản phẩm</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ Storage::url($product->image) }}" alt="Product Image" class="img-fluid">
            </div>
            <div class="col-md-8">
                <p><strong>Tên sản phẩm:</strong> {{ $product->name }}</p>
                <p><strong>Mã SKU:</strong> {{ $product->sku }}</p>
                <p><strong>Danh mục:</strong> {{ $product->category->name }}</p>
                <p><strong>Thương hiệu:</strong> {{ $product->brand->name }}</p>
                <p><strong>Giá:</strong> {{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                <p><strong>Số lượng:</strong> {{ $product->quantity }} {{ $product->unit }}</p>
                <p><strong>Mô tả ngắn:</strong> {{ $product->short_description }}</p>
                <p><strong>Mô tả chi tiết:</strong> </p>
            </div>
            <div style="width: 80%;
                margin: auto;
            margin-top: 5%;
            margin-bottom: 5%;">
                {!! $product->detailed_description !!}
            </div>
        </div>
    </div>
</div>
@endsection
