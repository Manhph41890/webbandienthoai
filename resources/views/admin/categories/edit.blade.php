@extends('admin.layouts')

@section('title', 'Chỉnh sửa Thương hiệu: ' . $brand->name)

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa Thương hiệu: {{ $brand->name }}</h1>
        <a href="{{ route('admin.categoriesindex') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Quay lại
        </a>
    </div>

    <!-- Form để chỉnh sửa thương hiệu -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin Thương hiệu</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categoriesupdate', $brand->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Sử dụng phương thức PUT cho cập nhật --}}

                <div class="form-group">
                    <label for="name">Tên Thương hiệu <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name', $brand->name) }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="5">{{ old('description', $brand->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật Thương hiệu</button>
            </form>
        </div>
    </div>

@endsection