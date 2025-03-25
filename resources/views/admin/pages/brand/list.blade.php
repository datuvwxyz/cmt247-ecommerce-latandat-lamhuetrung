@extends('dashboard')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách thương hiệu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên thương hiệu</th>
                            <th>Mô tả</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $index => $brand)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->description }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <img width="30px" src="{{ asset('/img/dotsMenu.png')}}" alt="Menu">
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <!-- View -->
                                            <a class="dropdown-item" href=""><i class="fa-brands fa-openid"></i> Xem thêm</a>

                                            <!-- Edit -->
                                            <a class="dropdown-item" href="{{ route('brands.edit', $brand->id) }}"><i class="fa-regular fa-pen-to-square"></i> Chỉnh sửa</a>

                                            <!-- Delete -->
                                            <a class="dropdown-item" href="#" onclick="confirmDelete({{ $brand->id }})"><i class="fa-regular fa-trash-can"></i> Xoá</a>
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
    <!-- End of Main Content -->

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

    <script>
        function confirmDelete(brandId) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa?',
                text: "Thương hiệu sẽ không thể phục hồi sau khi xóa!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tạo form để gửi yêu cầu DELETE
                    var form = document.createElement('form');
                    form.action = '/brands/' + brandId; // Sử dụng route destroy cho thương hiệu
                    form.method = 'POST';

                    // Thêm phương thức DELETE
                    var methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(methodField);

                    // Thêm CSRF token
                    var csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}'; // Lấy token CSRF từ blade
                    form.appendChild(csrfToken);

                    // Thêm form vào body và submit
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection
