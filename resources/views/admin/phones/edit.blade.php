@extends('admin.layouts')
@section('title', 'Chỉnh sửa: ' . $phone->name)

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa sản phẩm: {{ $phone->name }}</h6>
        <a href="{{ route('admin.phones.index') }}" class="btn btn-sm btn-secondary">Quay lại</a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.phones.update', $phone->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $phone->name) }}">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Đường dẫn (Slug) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug', $phone->slug) }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                <select class="form-control" name="categories_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('categories_id', $phone->categories_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả ngắn</label>
                <textarea class="form-control" name="short_description" rows="2">{{ old('short_description', $phone->short_description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh chính</label>
                @if ($phone->main_image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($phone->main_image) }}" width="100" class="img-thumbnail border-primary">
                        <div class="form-check mt-1">
                            <input type="checkbox" class="form-check-input" name="remove_main_image" id="remove_main_image">
                            <label class="form-check-label text-danger" for="remove_main_image small">Xóa ảnh hiện tại và tải ảnh mới</label>
                        </div>
                    </div>
                @endif
                <input type="file" class="form-control" name="main_image">
            </div>

            <hr>
            <h4 class="text-dark">Biến thể sản phẩm</h4>
            <div id="phone-variants-container">
                {{-- Lưu ý: Loop này sẽ tự lấy dữ liệu từ old() nếu có lỗi validation, nếu không sẽ lấy từ database --}}
                @foreach (old('variants', $phone->variants) as $index => $variant)
                    @include('admin.phones.variant_form_fields', [
                        'index' => $index,
                        'variant' => $variant,
                        'sizes' => $sizes,
                        'colors' => $colors
                    ])
                @endforeach
            </div>
            
            <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-variant-btn">
                <i class="fas fa-plus"></i> Thêm biến thể khác
            </button>

            <hr>
            <h4>Ảnh phụ sản phẩm</h4>
            <div class="row bg-light p-3 rounded mx-0">
                @foreach ($phone->images as $image)
                    <div class="col-md-2 mb-3 text-center" id="image-item-{{ $image->id }}">
                        <div class="position-relative">
                            <img src="{{ Storage::url($image->image_path) }}" class="img-thumbnail mb-1" style="height: 100px; object-fit: cover;">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="existing_other_images[]" value="{{ $image->id }}" checked id="img_{{ $image->id }}">
                                <label class="form-check-label small" for="img_{{ $image->id }}">Giữ lại</label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-3">
                <label class="form-label font-weight-bold">Thêm ảnh phụ mới</label>
                <input type="file" class="form-control" name="other_images[]" multiple accept="image/*">
            </div>

            <div class="mt-5">
                <button type="submit" class="btn btn-primary btn-lg btn-block shadow">
                    <i class="fas fa-save"></i> CẬP NHẬT SẢN PHẨM
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Khởi tạo index dựa trên số lượng biến thể đang có
        let variantIndex = {{ count(old('variants', $phone->variants)) }};

        // 1. Logic ẩn/hiện thông tin máy cũ (Dùng Event Delegation)
        $(document).on('change', '.condition-select', function() {
            let selectedValue = $(this).val();
            let parentContainer = $(this).closest('.variant-item');
            let usedSection = parentContainer.find('.used-details-container');

            if (selectedValue === 'used') {
                usedSection.slideDown(); 
            } else {
                usedSection.slideUp();
                // Xóa trắng input máy cũ khi chuyển về máy mới để tránh gửi dữ liệu thừa
                usedSection.find('input').val('');
            }
        });

        // 2. Tự động tạo slug từ tên sản phẩm
        $('#name').on('keyup', function() {
            let title = $(this).val();
            let slug = title.toLowerCase()
                .replace(/[^a-z0-9 -]/g, '') 
                .replace(/\s+/g, '-') 
                .replace(/-+/g, '-');
            $('#slug').val(slug);
        });

        // 3. AJAX Thêm biến thể mới
        $('#add-variant-btn').on('click', function() {
            $.ajax({
                url: '{{ route('admin.phones.getVariantFormFields') }}',
                type: 'GET',
                data: { index: variantIndex },
                success: function(data) {
                    $('#phone-variants-container').append(data);
                    variantIndex++;
                },
                error: function() {
                    alert("Lỗi khi tải form biến thể.");
                }
            });
        });

        // 4. Xóa biến thể
        $(document).on('click', '.remove-variant-btn', function() {
            if(confirm('Bạn có chắc muốn xóa biến thể này? Lưu ý: Biến thể sẽ bị xóa hoàn toàn khi bạn nhấn Cập nhật.')) {
                $(this).closest('.variant-item').remove();
            }
        });
    });
</script>
@endpush