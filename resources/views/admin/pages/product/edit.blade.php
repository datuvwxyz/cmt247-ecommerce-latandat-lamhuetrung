<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    @extends('dashboard')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title text-center">Chỉnh sửa sản phẩm</h3>
    </div>
    <div class="panel-body">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Tên sản phẩm -->
                    <div class="form-group">
                        <label for="name">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="Nhập tên sản phẩm" required>
                        @error('name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- SKU -->
                    <div class="form-group">
                        <label for="sku">Mã SKU</label>
                        <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" placeholder="Nhập mã SKU" required>
                        @error('sku')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Barcode -->
                    <div class="form-group">
                        <label for="barcode">Mã vạch</label>
                        <input type="text" class="form-control" id="barcode" name="barcode" value="{{ old('barcode', $product->barcode) }}" placeholder="Nhập mã vạch">
                        @error('barcode')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Đơn vị -->
                    <div class="form-group">
                        <label for="unit">Đơn Vị</label>
                        <input type="text" class="form-control" id="unit" name="unit" value="{{ old('unit', $product->unit) }}" placeholder="Nhập đơn vị" required>
                        @error('unit')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Thương hiệu -->
                    <div class="form-group">
                        <label for="brand_id">Thương Hiệu</label>
                        <select class="form-control" name="brand_id" id="brand_id" required>
                            <option value="">Chọn thương hiệu</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Danh mục -->
                    <div class="form-group">
                        <label for="category_id">Danh Mục</label>
                        <select class="form-control" name="category_id" id="category_id" required>
                            <option value="">Chọn danh mục</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Giá -->
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" placeholder="Nhập giá sản phẩm" required>
                        @error('price')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Số lượng -->
                    <div class="form-group">
                        <label for="quantity">Số Lượng</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" placeholder="Nhập số lượng" required>
                        @error('quantity')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mô tả ngắn -->
                    <div class="form-group">
                        <label for="short_description">Mô Tả Ngắn</label>
                        <textarea class="form-control" id="short_description" name="short_description" rows="4" placeholder="Nhập mô tả ngắn về sản phẩm">{{ old('short_description', $product->short_description) }}</textarea>
                        @error('short_description')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mô tả chi tiết -->
                    <div class="form-group">
                        <label for="detailed_description">Mô Tả Chi Tiết</label>
                        <textarea class="form-control" id="detailed_description" name="detailed_description" rows="4" placeholder="Nhập mô tả chi tiết về sản phẩm">{{ old('detailed_description', $product->detailed_description) }}</textarea>
                        @error('detailed_description')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Hình ảnh -->
                    <div class="form-group">
                        <label for="image">Hình Ảnh</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <img src="{{ Storage::url($product->image) }}" alt="Product Image" class="img-thumbnail mt-2" width="150">
                        @error('image')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg">Cập Nhật Sản Phẩm</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="{{ asset('/tinymce/js/tinymce/tinymce.min.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        tinymce.init({
            selector: '#detailed_description', // Chọn ID của trường mô tả chi tiết
            menubar: false,
            plugins: ['link', 'image', 'lists', 'advlist'],
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | link image | numlist bullist',
            height: 300
        });
    });
</script>
</body>
</html>
