@extends('admin.layouts.app')

@section('title', 'Thêm mới sản phẩm')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm mới sản phẩm</h1>
        <a href="{{ route('admin.products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
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
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Thông tin cơ bản sản phẩm -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="">Chọn danh mục</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="short_description" class="form-label">Mô tả ngắn</label>
                    <textarea class="form-control" id="short_description" name="short_description" rows="3">{{ old('short_description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả chi tiết</label>
                    <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="main_image" class="form-label">Ảnh chính sản phẩm</label>
                    <input type="file" class="form-control" id="main_image" name="main_image" accept="image/*">
                    <small class="form-text text-muted">Kích thước tối đa 2MB. Định dạng: JPG, PNG, GIF.</small>
                </div>

                <hr>

                <!-- Quản lý biến thể sản phẩm -->
                <h4 class="mb-3">Biến thể sản phẩm <span class="text-danger">*</span></h4>
                <div id="product-variants-container">
                    <!-- Một khối biến thể mẫu để thêm động bằng JS -->
                    @include('admin.products.variant_form_fields', [
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
                    <input type="file" class="form-control" id="other_images" name="other_images[]" multiple
                        accept="image/*">
                    <small class="form-text text-muted">Chọn nhiều ảnh. Kích thước tối đa 2MB mỗi ảnh.</small>
                </div>

                <button type="submit" class="btn btn-primary mt-4">Thêm sản phẩm</button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let variantIndex =
                {{ old('variants') ? count(old('variants')) : 1 }}; // Bắt đầu index từ 1 nếu chưa có dữ liệu old, hoặc tiếp tục từ số lượng biến thể cũ
            // Xử lý thêm biến thể bằng AJAX
            $('#add-variant-btn').on('click', function() {
                $.ajax({
                    url: '{{ route('admin.products.getVariantFormFields') }}', // Đảm bảo route này tồn tại và đúng
                    type: 'GET',
                    data: {
                        index: variantIndex
                    },
                    success: function(data) {
                        $('#product-variants-container').append(data);
                        variantIndex++;
                    },
                    error: function(xhr, status, error) {
                        console.error("Lỗi khi tải form biến thể:", error);
                        alert("Không thể thêm biến thể. Vui lòng thử lại.");
                    }
                });
            });

            // Xử lý xóa biến thể (sử dụng event delegation vì các nút được thêm động)
            $('#product-variants-container').on('click', '.remove-variant-btn', function() {
                $(this).closest('.variant-item').remove();
                // Không cần cập nhật lại variantIndex ở đây vì nó chỉ dùng để thêm mới.
                // Laravel sẽ tự động xử lý các mảng không liên tục.
            });

            // Nếu có lỗi validation và dữ liệu cũ từ old()
            @if (old('variants'))
                // Xóa biến thể mẫu ban đầu nếu đã có dữ liệu old
                $('#product-variants-container .variant-item[data-index="0"]')
            .remove(); // Xóa biến thể mẫu mặc định
                @foreach (old('variants') as $index => $variantData)
                    // Thay vì gọi createVariantHtml, chúng ta render từng biến thể cũ
                    $.ajax({
                        url: '{{ route('admin.products.getVariantFormFields') }}',
                        type: 'GET',
                        data: {
                            index: {{ $index }}
                        },
                        async: false, // Sử dụng async: false để đảm bảo thứ tự và gán giá trị old
                        success: function(data) {
                            $('#product-variants-container').append(data);
                            // Gán lại các giá trị old() cho biến thể vừa thêm
                            $(`[name="variants[{{ $index }}][size_id]"]`).val(
                                "{{ $variantData['size_id'] ?? '' }}");
                            $(`[name="variants[{{ $index }}][color_id]"]`).val(
                                "{{ $variantData['color_id'] ?? '' }}");
                            $(`[name="variants[{{ $index }}][sku]"]`).val(
                                "{{ $variantData['sku'] ?? '' }}");
                            $(`[name="variants[{{ $index }}][price]"]`).val(
                                "{{ $variantData['price'] ?? '' }}");
                            $(`[name="variants[{{ $index }}][stock]"]`).val(
                                "{{ $variantData['stock'] ?? '' }}");
                            @if (isset($variantData['is_default']))
                                $(`[name="variants[{{ $index }}][is_default]"]`).prop('checked',
                                    true);
                            @endif
                            // Lưu ý: file input (image_path) không thể set giá trị old() trực tiếp vì lý do bảo mật.
                        },
                        error: function(xhr, status, error) {
                            console.error("Lỗi khi tải lại form biến thể cũ:", error);
                        }
                    });
                @endforeach
                variantIndex = {{ count(old('variants')) }}; // Cập nhật lại variantIndex
            @endif
        });
        // Hàm tạo HTML cho một khối biến thể mới
        function createVariantHtml(index) {
            return `
                <div class="card mb-3 p-3 bg-light variant-item" data-index="${index}">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Biến thể #${index + 1}</h6>
                        <button type="button" class="btn btn-danger btn-sm remove-variant-btn">
                            <i class="fas fa-times"></i> Xóa
                        </button>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6 mb-3">
                            <label for="variants_${index}_size_id" class="form-label">Kích thước</label>
                            <select class="form-control" id="variants_${index}_size_id" name="variants[${index}][size_id]">
                                <option value="">Chọn kích thước</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="variants_${index}_color_id" class="form-label">Màu sắc</label>
                            <select class="form-control" id="variants_${index}_color_id" name="variants[${index}][color_id]">
                                <option value="">Chọn màu sắc</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="variants_${index}_sku" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="variants_${index}_sku" name="variants[${index}][sku]" value="{{ old('variants.${index}.sku') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="variants_${index}_price" class="form-label">Giá <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="variants_${index}_price" name="variants[${index}][price]" value="{{ old('variants.${index}.price') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="variants_${index}_stock" class="form-label">Tồn kho <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="variants_${index}_stock" name="variants[${index}][stock]" value="{{ old('variants.${index}.stock') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="variants_${index}_image_path" class="form-label">Ảnh biến thể</label>
                            <input type="file" class="form-control" id="variants_${index}_image_path" name="variants[${index}][image_path]" accept="image/*">
                            <small class="form-text text-muted">Tối đa 2MB.</small>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="variants_${index}_is_default" name="variants[${index}][is_default]" value="1">
                        <label class="form-check-label" for="variants_${index}_is_default">Đặt làm biến thể mặc định</label>
                    </div>
                </div>
                `;
        }

        // Xử lý thêm biến thể
        $('#add-variant-btn').on('click', function() {
            $('#product-variants-container').append(createVariantHtml(variantIndex));
            variantIndex++;
        });

        // Xử lý xóa biến thể (sử dụng event delegation vì các nút được thêm động)
        $('#product-variants-container').on('click', '.remove-variant-btn', function() {
            $(this).closest('.variant-item').remove();
            // Cần cập nhật lại index của các biến thể còn lại nếu muốn giữ thứ tự liên tục
            // Nhưng Laravel vẫn xử lý tốt ngay cả khi index không liên tục
        });

        // Nếu có lỗi validation và dữ liệu cũ từ old()
        @if (old('variants'))
            // Xóa biến thể mẫu ban đầu nếu đã có dữ liệu old
            $('#product-variants-container .variant-item[data-index="0"]').remove();
            @foreach (old('variants') as $index => $variantData)
                $('#product-variants-container').append(createVariantHtml({{ $index }}));
                // Set lại các giá trị old() cho biến thể vừa thêm nếu có
                $(`[name="variants[{{ $index }}][size_id]"]`).val(
                    "{{ $variantData['size_id'] ?? '' }}");
                $(`[name="variants[{{ $index }}][color_id]"]`).val(
                    "{{ $variantData['color_id'] ?? '' }}");
                $(`[name="variants[{{ $index }}][sku]"]`).val("{{ $variantData['sku'] ?? '' }}");
                $(`[name="variants[{{ $index }}][price]"]`).val("{{ $variantData['price'] ?? '' }}");
                $(`[name="variants[{{ $index }}][stock]"]`).val("{{ $variantData['stock'] ?? '' }}");
                @if (isset($variantData['is_default']) && $variantData['is_default'])
                    $(`[name="variants[{{ $index }}][is_default]"]`).prop('checked', true);
                @endif
            @endforeach
            variantIndex = {{ count(old('variants')) }}; // Cập nhật lại variantIndex
        @endif
        });
    </script>
@endpush
