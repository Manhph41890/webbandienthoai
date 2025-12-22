@extends('admin.layouts')

@section('title', 'Chỉnh sửa Điện Thoại')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa Điện Thoại: {{ $phone->name }}</h1>
        <a href="{{ route('admin.phones.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Quay lại Danh sách Điện Thoại
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Có lỗi xảy ra!</strong> Vui lòng kiểm tra lại.
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin Điện Thoại</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.phones.update', $phone->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Bắt buộc phải có để gửi request PUT --}}

                <div class="form-group">
                    <label for="name">Tên Điện Thoại <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $phone->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="brand_id">Thương hiệu <span class="text-danger">*</span></label>
                    <select class="form-control @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id"
                        required>
                        <option value="">Chọn thương hiệu</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}"
                                {{ old('brand_id', $phone->brand_id) == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="main_image">Ảnh chính</label>
                    <input type="file" class="form-control-file @error('main_image') is-invalid @enderror"
                        id="main_image" name="main_image" accept="image/*">
                    @error('main_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Để trống nếu không muốn thay đổi ảnh. Kích thước đề xuất:
                        400x600px</small>
                    @if ($phone->main_image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $phone->main_image) }}" alt="Ảnh chính hiện tại"
                                class="img-thumbnail" style="max-width: 150px;">
                            <p class="text-muted small mt-1">Ảnh hiện tại</p>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="short_description">Mô tả ngắn</label>
                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                        name="short_description" rows="3">{{ old('short_description', $phone->short_description) }}</textarea>
                    @error('short_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="long_description">Mô tả chi tiết</label>
                    <textarea class="form-control @error('long_description') is-invalid @enderror" id="long_description"
                        name="long_description" rows="5">{{ old('long_description', $phone->long_description) }}</textarea>
                    @error('long_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="price">Giá bán <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                            id="price" name="price" value="{{ old('price', $phone->price) }}" required
                            min="0">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="original_price">Giá gốc</label>
                        <input type="number" step="0.01"
                            class="form-control @error('original_price') is-invalid @enderror" id="original_price"
                            name="original_price" value="{{ old('original_price', $phone->original_price) }}"
                            min="0">
                        @error('original_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="quantity">Số lượng tồn kho <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                            name="quantity" value="{{ old('quantity', $phone->quantity) }}" required min="0">
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="storage_capacity">Dung lượng <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('storage_capacity') is-invalid @enderror"
                            id="storage_capacity" name="storage_capacity"
                            value="{{ old('storage_capacity', $phone->storage_capacity) }}" required>
                        @error('storage_capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="color">Màu sắc</label>
                        <input type="text" class="form-control @error('color') is-invalid @enderror" id="color"
                            name="color" value="{{ old('color', $phone->color) }}">
                        @error('color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="serial_number">Số serial</label>
                    <input type="text" class="form-control @error('serial_number') is-invalid @enderror"
                        id="serial_number" name="serial_number"
                        value="{{ old('serial_number', $phone->serial_number) }}">
                    @error('serial_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái <span class="text-danger">*</span></label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status"
                        required>
                        <option value="available" {{ old('status', $phone->status) == 'available' ? 'selected' : '' }}>Còn
                            hàng</option>
                        <option value="out_of_stock"
                            {{ old('status', $phone->status) == 'out_of_stock' ? 'selected' : '' }}>Hết hàng</option>
                        <option value="upcoming" {{ old('status', $phone->status) == 'upcoming' ? 'selected' : '' }}>Sắp
                            ra mắt</option>
                        <option value="disabled" {{ old('status', $phone->status) == 'disabled' ? 'selected' : '' }}>Ngừng
                            kinh doanh</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4">
                <h6 class="m-0 font-weight-bold text-primary mb-3">Thông số kỹ thuật (Tùy chọn)</h6>
                <div id="specifications-fields">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="specs_os">Hệ điều hành</label>
                            <input type="text" class="form-control @error('specs_os') is-invalid @enderror"
                                id="specs_os" name="specs_os"
                                value="{{ old('specs_os', $phone->specifications['os'] ?? '') }}">
                            @error('specs_os')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="specs_chip">Chip xử lý</label>
                            <input type="text" class="form-control @error('specs_chip') is-invalid @enderror"
                                id="specs_chip" name="specs_chip"
                                value="{{ old('specs_chip', $phone->specifications['chip'] ?? '') }}">
                            @error('specs_chip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="specs_camera">Camera</label>
                            <input type="text" class="form-control @error('specs_camera') is-invalid @enderror"
                                id="specs_camera" name="specs_camera"
                                value="{{ old('specs_camera', $phone->specifications['camera'] ?? '') }}">
                            @error('specs_camera')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="specs_screen">Màn hình</label>
                            <input type="text" class="form-control @error('specs_screen') is-invalid @enderror"
                                id="specs_screen" name="specs_screen"
                                value="{{ old('specs_screen', $phone->specifications['screen'] ?? '') }}">
                            @error('specs_screen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="specs_battery">Pin</label>
                            <input type="text" class="form-control @error('specs_battery') is-invalid @enderror"
                                id="specs_battery" name="specs_battery"
                                value="{{ old('specs_battery', $phone->specifications['battery'] ?? '') }}">
                            @error('specs_battery')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Thêm các trường specs_ khác ở đây nếu cần --}}
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật Điện Thoại</button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    {{-- Nếu bạn muốn dùng editor như CKEditor, TinyMCE cho long_description --}}
    {{-- <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('long_description');
    </script> --}}
@endpush
