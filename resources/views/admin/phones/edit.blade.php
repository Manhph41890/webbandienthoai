@extends('admin.layouts')
@section('title', 'Chỉnh sửa: ' . $phone->name)

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa sản phẩm</h6>
        <a href="{{ route('admin.phones.index') }}" class="btn btn-sm btn-secondary">Quay lại</a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.phones.update', $phone->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $phone->name) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Đường dẫn (Slug) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', $phone->slug) }}">
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
                        <img src="{{ Storage::url($phone->main_image) }}" width="100" class="img-thumbnail">
                        <label><input type="checkbox" name="remove_main_image"> Xóa ảnh hiện tại</label>
                    </div>
                @endif
                <input type="file" class="form-control" name="main_image">
            </div>

            <hr>
            <h4>Biến thể sản phẩm</h4>
            <div id="phone-variants-container">
                @foreach (old('variants', $phone->variants) as $index => $variant)
                    @include('admin.phones.variant_form_fields', [
                        'index' => $index,
                        'variant' => $variant,
                        'sizes' => $sizes,
                        'colors' => $colors
                    ])
                @endforeach
            </div>
            <button type="button" class="btn btn-dark btn-sm mt-2" id="add-variant-btn"> + Thêm biến thể</button>

            <hr>
            <h4>Ảnh phụ hiện có</h4>
            <div class="row">
                @foreach ($phone->images as $image)
                    <div class="col-md-2 mb-3 text-center" id="image-item-{{ $image->id }}">
                        <img src="{{ Storage::url($image->image_path) }}" class="img-thumbnail mb-1">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="existing_other_images[]" value="{{ $image->id }}" checked>
                            <label class="form-check-label small">Giữ lại</label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label class="form-label">Thêm ảnh phụ mới</label>
                <input type="file" class="form-control" name="other_images[]" multiple>
            </div>

            <button type="submit" class="btn btn-primary btn-block shadow">CẬP NHẬT SẢN PHẨM</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let variantIndex = {{ count(old('variants', $phone->variants)) }};

        // Tự động tạo slug khi gõ tên
        $('#name').on('keyup', function() {
            let title = $(this).val();
            let slug = title.toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
            $('#slug').val(slug);
        });

        $('#add-variant-btn').on('click', function() {
            $.get('{{ route('admin.phones.getVariantFormFields') }}', { index: variantIndex }, function(data) {
                $('#phone-variants-container').append(data);
                variantIndex++;
            });
        });

        $(document).on('click', '.remove-variant-btn', function() {
            if(confirm('Bạn có chắc muốn xóa biến thể này?')) {
                $(this).closest('.variant-item').remove();
            }
        });
    });
</script>
@endpush