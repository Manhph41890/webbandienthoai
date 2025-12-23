@extends('admin.layouts')

@section('title', 'Thêm mới sản phẩm')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm mới sản phẩm</h1>
        <a href="{{ route('admin.phones.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Quay lại danh sách
        </a>
    </div>

    <!-- Thông báo thành cong (nếu có) -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Thông báo lỗi (nếu có) -->
    {{-- @if ($errors->any())
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
    @endif --}} {{-- IGNORE --}}

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin sản phẩm</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.phones.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Thông tin cơ bản sản phẩm -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categories_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                    <select class="form-control @error('categories_id') is-invalid @enderror" id="categories_id"
                        name="categories_id">
                        <option value="">Chọn danh mục</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('categories_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('categories_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="slug">Slug (URL)</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                        name="slug" value="{{ old('slug') }}">
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="short_description" class="form-label">Mô tả ngắn</label>
                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                        name="short_description" rows="3">{{ old('short_description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="main_image" class="form-label">Ảnh chính sản phẩm</label>
                    <input type="file" class="form-control @error('main_image') is-invalid @enderror" id="main_image"
                        name="main_image" accept="image/*">
                    <small class="form-text text-muted">Kích thước tối đa 2MB. Định dạng: JPG, PNG, GIF.</small>
                    @error('main_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>

                <!-- Quản lý biến thể sản phẩm -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Biến thể sản phẩm <span class="text-danger">*</span></h4>
                    @error('variants')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div id="phone-variants-container">
                    <!-- Khối biến thể -->
                    @include('admin.phones.variant_form_fields', [
                        'index' => 0,
                        'sizes' => $sizes,
                        'colors' => $colors,
                        'variant' => null,
                    ])
                </div>

                <button type="button" class="btn btn-secondary btn-sm mt-3" id="add-variant-btn">
                    <i class="fas fa-plus"></i> Thêm biến thể khác
                </button>

                <hr>

                <!-- Quản lý ảnh phụ sản phẩm -->
                <h4 class="mb-3">Ảnh phụ sản phẩm</h4>
                <div class="mb-3">
                    <label for="other_images" class="form-label">Chọn nhiều ảnh phụ</label>
                    <input type="file" class="form-control @error('other_images.*') is-invalid @enderror"
                        id="other_images" name="other_images[]" multiple accept="image/*">
                    <small class="form-text text-muted">Chọn nhiều ảnh. Kích thước tối đa 2MB mỗi ảnh.</small>
                    @error('other_images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-4">Thêm sản phẩm</button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let variantIndex = {{ old('variants') ? count(old('variants')) : 1 }};

            // 1. Xử lý ẩn/hiện thông tin máy cũ khi thay đổi Tình trạng máy
            $(document).on('change', '.condition-select', function() {
                let selectedValue = $(this).val();
                let parentContainer = $(this).closest('.variant-item');
                let usedSection = parentContainer.find('.used-details-container');

                if (selectedValue === 'used') {
                    usedSection.fadeIn(); // Hiện phần nhập máy cũ
                } else {
                    usedSection.fadeOut(); // Ẩn phần nhập máy cũ
                    // Tùy chọn: Xóa dữ liệu cũ khi người dùng đổi về 'new'
                    usedSection.find('input').val('');
                }
            });

            // 2. Nút Thêm biến thể mới (Giữ nguyên logic cũ của bạn)
            $('#add-variant-btn').on('click', function() {
                $.ajax({
                    url: '{{ route('admin.phones.getVariantFormFields') }}',
                    type: 'GET',
                    data: {
                        index: variantIndex
                    },
                    success: function(data) {
                        $('#phone-variants-container').append(data);
                        variantIndex++;
                    },
                    error: function(xhr, status, error) {
                        alert("Không thể thêm biến thể.");
                    }
                });
            });

            // 3. Nút Xóa biến thể
            $('#phone-variants-container').on('click', '.remove-variant-btn', function() {
                $(this).closest('.variant-item').remove();
            });

            // 4. Xử lý khi có lỗi Validation (old values)
            @if (old('variants'))
                $('#phone-variants-container .variant-item[data-index="0"]').remove();
                @foreach (old('variants') as $index => $variantData)
                    $.ajax({
                        url: '{{ route('admin.phones.getVariantFormFields') }}',
                        type: 'GET',
                        data: {
                            index: {{ $index }}
                        },
                        async: false,
                        success: function(data) {
                            $('#phone-variants-container').append(data);

                            // Gán các giá trị cơ bản
                            let row = $(
                                `#phone-variants-container .variant-item[data-index="{{ $index }}"]`
                                );
                            row.find(`[name="variants[{{ $index }}][condition]"]`).val(
                                "{{ $variantData['condition'] ?? 'new' }}").change();
                            row.find(`[name="variants[{{ $index }}][size_id]"]`).val(
                                "{{ $variantData['size_id'] ?? '' }}");
                            row.find(`[name="variants[{{ $index }}][color_id]"]`).val(
                                "{{ $variantData['color_id'] ?? '' }}");
                            row.find(`[name="variants[{{ $index }}][sku]"]`).val(
                                "{{ $variantData['sku'] ?? '' }}");
                            row.find(`[name="variants[{{ $index }}][price]"]`).val(
                                "{{ $variantData['price'] ?? '' }}");
                            row.find(`[name="variants[{{ $index }}][stock]"]`).val(
                                "{{ $variantData['stock'] ?? '' }}");

                            // Gán giá trị General Specs
                            row.find(`[name="variants[{{ $index }}][general_specs][storage]"]`)
                                .val("{{ $variantData['general_specs']['storage'] ?? '' }}");
                            row.find(`[name="variants[{{ $index }}][general_specs][ram]"]`).val(
                                "{{ $variantData['general_specs']['ram'] ?? '' }}");
                            row.find(
                                `[name="variants[{{ $index }}][general_specs][screen_size]"]`
                                ).val("{{ $variantData['general_specs']['screen_size'] ?? '' }}");

                            // Gán giá trị Used Details
                            row.find(
                                `[name="variants[{{ $index }}][used_details][battery_health]"]`
                                ).val("{{ $variantData['used_details']['battery_health'] ?? '' }}");
                            row.find(
                                `[name="variants[{{ $index }}][used_details][charging_cycles]"]`
                                ).val(
                                "{{ $variantData['used_details']['charging_cycles'] ?? '' }}");
                            row.find(
                                `[name="variants[{{ $index }}][used_details][description]"]`
                                ).val("{{ $variantData['used_details']['description'] ?? '' }}");

                            if ("{{ isset($variantData['is_default']) }}") {
                                row.find(`[name="variants[{{ $index }}][is_default]"]`).prop(
                                    'checked', true);
                            }
                        }
                    });
                @endforeach
                variantIndex = {{ count(old('variants')) }};
            @endif
        });
    </script>
@endpush
