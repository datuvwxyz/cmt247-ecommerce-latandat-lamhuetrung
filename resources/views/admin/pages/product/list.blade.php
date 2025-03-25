@extends('dashboard')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thương hiệu</th>
                            <th>Danh mục</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->brand->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <img width="30px" src="{{ asset('/img/dotsMenu.png')}}" alt="Menu">
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <!-- View -->
                                            <a class="dropdown-item" href="{{ route('products.show', $product->id) }}"><i class="fa-brands fa-openid"></i> Xem chi tiết</a>

                                            <!-- Edit -->
                                            <a class="dropdown-item" href="{{ route('products.edit', $product->id) }}"><i class="fa-regular fa-pen-to-square"></i> Chỉnh sửa</a>

                                            <!-- Soft Delete -->
                                            <a class="dropdown-item" href="#" onclick="confirmDelete({{ $product->id }}, 'soft')"><i class="fa-regular fa-trash-can"></i> Xóa mềm</a>

                                            <!-- Hard Delete -->
                                            <a class="dropdown-item" href="#" onclick="confirmDelete({{ $product->id }}, 'hard')"><i class="fa-regular fa-trash-can"></i> Xóa thật</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
<script>
    function confirmDelete(productId, type) {
    let message = type === 'soft' ? 'Sản phẩm sẽ bị xóa mềm và không thể khôi phục!' : 'Sản phẩm sẽ bị xóa vĩnh viễn!';

    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: type === 'soft' ? 'Xóa mềm' : 'Xóa thật',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            // Tạo form để gửi yêu cầu POST (với _method DELETE)
            var form = document.createElement('form');
            form.action = type === 'soft' ? '/products/' + productId + '/soft-delete' : '/products/' + productId + '/hard-delete';
            form.method = 'POST';

            // Thêm phương thức DELETE giả lập
            var methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';  // Phương thức DELETE giả lập
            form.appendChild(methodField);

            // Thêm CSRF token
            var csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}'; // CSRF token từ Blade template
            form.appendChild(csrfToken);

            // Thêm form vào body và submit
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
