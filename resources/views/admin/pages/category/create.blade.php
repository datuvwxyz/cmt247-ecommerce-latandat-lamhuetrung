@extends('dashboard')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title text-center">Thêm Danh Mục</h3>
    </div>
    <div class="panel-body">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <!-- Tên danh mục -->
                    <div class="form-group">
                        <label for="category_name">Tên Danh Mục</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Nhập tên danh mục">
                        @error('name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Mô tả -->
                    <div class="form-group">
                        <label for="description">Mô Tả</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Mô tả chi tiết về danh mục">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Button submit -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Thêm Danh Mục</button>
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
                window.location.href = "{{ route('categories.index') }}";
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
