<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thêm Sản Phẩm</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    @extends('dashboard')

    @section('content')
    <div class="container mt-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Thêm Sản Phẩm</h3>
            </div>
            <div class="panel-body">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-sm-12">
                        <!-- Nút Import File -->
                        <div class="form-group text-center mb-4">
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#importModal">Import File Excel</button>
                        </div>

                        <!-- Form Thêm Sản Phẩm -->
                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <!-- Tên sản phẩm -->
                                <div class="form-group col-md-6">
                                    <label for="name">Tên Sản Phẩm</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Nhập tên sản phẩm" required>
                                    @error('name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- SKU -->
                                <div class="form-group col-md-6">
                                    <label for="sku">Mã SKU</label>
                                    <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku') }}" placeholder="Nhập mã SKU" required>
                                    @error('sku')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Barcode và Đơn vị -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="barcode">Mã vạch</label>
                                    <input type="text" class="form-control" id="barcode" name="barcode" value="{{ old('barcode') }}" placeholder="Nhập mã vạch">
                                    @error('barcode')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="unit">Đơn Vị</label>
                                    <input type="text" class="form-control" id="unit" name="unit" value="{{ old('unit') }}" placeholder="Nhập đơn vị" required>
                                    @error('unit')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Thương hiệu và Danh mục -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="brand_id">Thương Hiệu</label>
                                    <select class="form-control" name="brand_id" id="brand_id" required>
                                        <option value="">Chọn thương hiệu</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="category_id">Danh Mục</label>
                                    <select class="form-control" name="category_id" id="category_id" required>
                                        <option value="">Chọn danh mục</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Giá và Số lượng -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="price">Giá</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Nhập giá sản phẩm" required>
                                    @error('price')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="quantity">Số Lượng</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" placeholder="Nhập số lượng" required>
                                    @error('quantity')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Mô tả ngắn và chi tiết -->
                            <div class="form-group">
                                <label for="short_description">Mô Tả Ngắn</label>
                                <textarea class="form-control" id="short_description" name="short_description" rows="4" placeholder="Mô tả ngắn về sản phẩm">{{ old('short_description') }}</textarea>
                                @error('short_description')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="detailed_description">Mô Tả Chi Tiết</label>
                                <textarea class="form-control" id="detailed_description" name="detailed_description" rows="6" placeholder="Mô tả chi tiết về sản phẩm">{{ old('detailed_description') }}</textarea>
                                @error('detailed_description')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Hình ảnh sản phẩm -->
                            <div class="form-group">
                                <label for="image">Hình ảnh</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                                @error('image')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Button submit -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Thêm Sản Phẩm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Import File Excel -->
        <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import File Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Chọn File Excel</label>
                                <input type="file" class="form-control-file" name="file" required>
                                @error('file')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-lg">Import</button>
                                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Đóng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
        @if(session('success'))
            <script>
                Swal.fire({
                    title: 'Thành công!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'Đóng'
                }).then(() => {
                    window.location.href = "{{ route('products.index') }}";
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

    <!-- Tinymce -->
    <script src="{{ asset('/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: '#detailed_description',
                menubar: false,
                plugins: ['link', 'image', 'lists', 'advlist'],
                toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | link image | numlist bullist',
                height: 300
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
