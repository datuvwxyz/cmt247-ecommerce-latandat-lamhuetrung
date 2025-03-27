@extends('dashboard')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title text-center">Chỉnh Sửa Thương Hiệu</h3>
    </div>
    <div class="panel-body">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <form method="POST" action="{{ route('brands.update', $brand->id) }}">
                    @csrf
                    @method('PUT')
                    <!-- Tên thương hiệu -->
                    <div class="form-group">
                        <label for="name">Tên Thương Hiệu</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $brand->name) }}" placeholder="Nhập tên thương hiệu" required>
                        @error('name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mô tả -->
                    <div class="form-group">
                        <label for="description">Mô Tả</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Mô tả chi tiết về thương hiệu">{{ old('description', $brand->description) }}</textarea>
                        @error('description')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Button submit -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Cập Nhật Thương Hiệu</button>
                    </div>
                </form>
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
