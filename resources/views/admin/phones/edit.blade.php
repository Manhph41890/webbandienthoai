@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa sản phẩm: ' . $product->name)

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa sản phẩm</h1>
        <a href="{{ route('admin.products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Quay lại danh sách
        </a>
    </div>

    <!-- Thông báo thành công (nếu có) -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Thông báo lỗi (nếu có) -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
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
            <h6 class="m-0 font-weight-bold text-primary">Thông tin sản phẩm</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Sử dụng phương thức PUT cho cập nhật --}}

                <!-- Thông tin cơ bản sản phẩm -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="">Chọn danh mục</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="short_description" class="form-label">Mô tả ngắn</label>
                    <textarea class="form-control" id="short_description" name="short_description" rows="3">{{ old('short_description', $product->short_description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả chi tiết</label>
                    <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="main_image" class="form-label">Ảnh chính sản phẩm</label>
                    @if ($product->main_image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($product->main_image) }}" alt="Ảnh chính hiện tại" width="150"
                                class="img-thumbnail">
                            <div class="form-check mt-1">
                                <input type="checkbox" class="form-check-input" id="remove_main_image"
                                    name="remove_main_image" value="1">
                                <label class="form-check-label" for="remove_main_image">Xóa ảnh chính hiện tại</label>
                            </div>
                        </div>
                    @endif
                    <input type="file" class="form-control" id="main_image" name="main_image" accept="image/*">
                    <small class="form-text text-muted">Kích thước tối đa 2MB. Định dạng: JPG, PNG, GIF. (Chọn ảnh mới sẽ thay thế ảnh cũ)</small>
                </div>

                <hr>

                <!-- Quản lý biến thể sản phẩm -->
                <h4 class="mb-3">Biến thể sản phẩm <span class="text-danger">*</span></h4>
                <div id="product-variants-container">
                    {{-- Các biến thể hiện có sẽ được load ở đây --}}
                    @foreach (old('variants', $product->variants) as $index => $variant)
                        @include('admin.products.variant_form_fields', [
                            'index' => $index,
                            'sizes' => $sizes,
                            'colors' => $colors,
                            'variant' => $variant, // Truyền biến thể hiện tại vào partial
                        ])
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary btn-sm mt-3" id="add-variant-btn">
                    <i class="fas fa-plus"></i> Thêm biến thể khác
                </button>

                <hr>

                <!-- Quản lý ảnh phụ sản phẩm -->
                <h4 class="mb-3">Ảnh phụ sản phẩm</h4>
                <div class="mb-3">
                    <label class="form-label">Ảnh phụ hiện có</label>
                    <div class="row mb-2">
                        @forelse ($product->images as $image)
                            <div class="col-md-2 mb-2 existing-other-image-item" id="other-image-{{ $image->id }}">
                                <img src="{{ Storage::url($image->image_path) }}" alt="Ảnh phụ" class="img-thumbnail"
                                    width="100">
                                <div class="form-check mt-1">
                                    <input type="checkbox" class="form-check-input"
                                        id="existing_other_images_{{ $image->id }}" name="existing_other_images[]"
                                        value="{{ $image->id }}" checked>
                                    <label class="form-check-label"
                                        for="existing_other_images_{{ $image->id }}">Giữ lại</label>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm mt-1 delete-existing-other-image"
                                    data-image-id="{{ $image->id }}">Xóa</button>
                            </div>
                        @empty
                            <div class="col-12 text-muted">Không có ảnh phụ nào.</div>
                        @endforelse
                    </div>

                    <label for="other_images" class="form-label">Thêm ảnh phụ mới</label>
                    <input type="file" class="form-control" id="other_images" name="other_images[]" multiple
                        accept="image/*">
                    <small class="form-text text-muted">Chọn nhiều ảnh. Kích thước tối đa 2MB mỗi ảnh.</small>
                </div>

                <button type="submit" class="btn btn-primary mt-4">Cập nhật sản phẩm</button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Đặt variantIndex bắt đầu từ số lượng biến thể hiện có hoặc từ 0 nếu không có
            let variantIndex = {{ old('variants') ? count(old('variants')) : $product->variants->count() }};

            // Hàm để tải form biến thể mới bằng AJAX
            function loadNewVariantForm(index) {
                $.ajax({
                    url: '{{ route('admin.products.getVariantFormFields') }}',
                    type: 'GET',
                    data: {
                        index: index
                    },
                    success: function(data) {
                        $('#product-variants-container').append(data);
                    },
                    error: function(xhr, status, error) {
                        console.error("Lỗi khi tải form biến thể:", error);
                        alert("Không thể thêm biến thể. Vui lòng thử lại.");
                    }
                });
            }

            // Xử lý thêm biến thể
            $('#add-variant-btn').on('click', function() {
                loadNewVariantForm(variantIndex);
                variantIndex++;
            });

            // Xử lý xóa biến thể (sử dụng event delegation)
            $('#product-variants-container').on('click', '.remove-variant-btn', function() {
                $(this).closest('.variant-item').remove();
            });

            // Xử lý xóa ảnh phụ hiện có (chỉ xóa khỏi giao diện, giữ lại input hidden để thông báo server)
            $('.delete-existing-other-image').on('click', function() {
                const imageId = $(this).data('image-id');
                // Uncheck và disable checkbox "Giữ lại"
                $(`#existing_other_images_${imageId}`).prop('checked', false).prop('disabled', true);
                // Ẩn ảnh khỏi giao diện
                $(`#other-image-${imageId}`).hide();
                alert('Ảnh sẽ được xóa khi bạn lưu thay đổi sản phẩm.');
            });

            // Nếu có lỗi validation và dữ liệu cũ từ old(), cần tải lại form với dữ liệu cũ
            @if (old('variants'))
                
            @endif
        });
    </script>
@endpush