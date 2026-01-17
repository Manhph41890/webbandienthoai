{{-- // dd($parentCategories) --}}
@extends('admin.layouts')

@section('title', 'Thêm mới Chuyên mục')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm mới Chuyên mục</h1>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Quay lại
        </a>
    </div>
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Có lỗi xảy ra!</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin Chuyên mục</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf {{-- Bắt buộc phải có token CSRF để bảo mật --}}
                <div class="row">
                    {{-- Cột trái chứa các thông tin chính --}}
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name">Tên Chuyên mục <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="slug">Slug (URL thân thiện)</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                name="slug" value="{{ old('slug') }}">
                            <small class="form-text text-muted">Bỏ trống sẽ tự động tạo từ tên chuyên mục.</small>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="5">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Cột phải chứa các thông tin phụ --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="parent_id">Chuyên mục cha</label>
                            <select class="form-control @error('parent_id') is-invalid @enderror" id="parent_id"
                                name="parent_id">
                                <option value="">— Là chuyên mục cha —</option>
                                @foreach ($parentCategories as $parent)
                                    <option value="{{ $parent->id }}"
                                        {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="is_active">Trạng thái <span class="text-danger">*</span></label>
                            <select class="form-control @error('is_active') is-invalid @enderror" id="is_active"
                                name="is_active" required>
                                <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Hoạt động</option>
                                <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>Tạm ẩn</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="order">Thứ tự</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" id="order"
                                name="order" value="{{ old('order', 0) }}" min="0">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="fas fa-save fa-sm text-white-50"></i> Lưu lại
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary shadow-sm">Hủy</a>
                </div>
            </form>
        </div>
    </div>

@endsection
