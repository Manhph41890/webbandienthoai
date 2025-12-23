
<div class="card mb-3 p-3 bg-light variant-item" data-index="{{ $index }}">
    <div class="d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Biến thể #{{ $index + 1 }}</h6>
        {{-- Chỉ hiển thị nút xóa nếu đây không phải là biến thể đầu tiên của form tạo mới
             HOẶC đây là một biến thể hiện có (có ID) --}}
        @if ($index > 0 || (isset($variant) && $variant->id))
            <button type="button" class="btn btn-danger btn-sm remove-variant-btn">
                <i class="fas fa-times"></i> Xóa
            </button>
        @endif
    </div>
    <div class="row mt-2">
        {{-- Input hidden để lưu ID biến thể hiện có (nếu có) --}}
        @if (isset($variant) && $variant->id)
            <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant->id }}">
        @endif

        <div class="col-md-6 mb-3">
            <label for="variants_{{ $index }}_size_id" class="form-label">Kích thước</label>
            <select class="form-control" id="variants_{{ $index }}_size_id"
                name="variants[{{ $index }}][size_id]">
                <option value="">Chọn kích thước</option>
                @foreach ($sizes as $size)
                    <option value="{{ $size->id }}"
                        {{ old('variants.' . $index . '.size_id', $variant->size_id ?? '') == $size->id ? 'selected' : '' }}>
                        {{ $size->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="variants_{{ $index }}_color_id" class="form-label">Màu sắc</label>
            <select class="form-control" id="variants_{{ $index }}_color_id"
                name="variants[{{ $index }}][color_id]">
                <option value="">Chọn màu sắc</option>
                @foreach ($colors as $color)
                    <option value="{{ $color->id }}"
                        {{ old('variants.' . $index . '.color_id', $variant->color_id ?? '') == $color->id ? 'selected' : '' }}>
                        {{ $color->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="variants_{{ $index }}_sku" class="form-label">SKU</label>
            <input type="text" class="form-control" id="variants_{{ $index }}_sku"
                name="variants[{{ $index }}][sku]"
                value="{{ old('variants.' . $index . '.sku', $variant->sku ?? '') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="variants_{{ $index }}_price" class="form-label">Giá <span
                    class="text-danger">*</span></label>
            <input type="number" step="0.01" class="form-control" id="variants_{{ $index }}_price"
                name="variants[{{ $index }}][price]"
                value="{{ old('variants.' . $index . '.price', $variant->price ?? '') }}" required>
            @error('variants.' . $index . '.price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="variants_{{ $index }}_stock" class="form-label">Tồn kho <span
                    class="text-danger">*</span></label>
            <input type="number" class="form-control" id="variants_{{ $index }}_stock"
                name="variants[{{ $index }}][stock]"
                value="{{ old('variants.' . $index . '.stock', $variant->stock ?? '') }}" required>
            @error('variants.' . $index . '.stock')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="variants_{{ $index }}_image_path" class="form-label">Ảnh biến thể</label>
            <input type="file" class="form-control" id="variants_{{ $index }}_image_path"
                name="variants[{{ $index }}][image_path]" accept="image/*">
            <small class="form-text text-muted">Tối đa 2MB.</small>
            @if (isset($variant) && $variant->image_path)
                <div class="mt-2">
                    <img src="{{ Storage::url($variant->image_path) }}" alt="Ảnh biến thể hiện tại" width="70"
                        class="img-thumbnail">
                    <div class="form-check mt-1">
                        <input type="checkbox" class="form-check-input" id="remove_variant_image_{{ $index }}"
                            name="variants[{{ $index }}][remove_image_path]" value="1">
                        <label class="form-check-label" for="remove_variant_image_{{ $index }}">Xóa ảnh hiện
                            tại</label>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="variants_{{ $index }}_is_default"
            name="variants[{{ $index }}][is_default]" value="1"
            {{ old('variants.' . $index . '.is_default', $variant->is_default ?? false) ? 'checked' : '' }}>
        <label class="form-check-label" for="variants_{{ $index }}_is_default">Đặt làm biến thể mặc định</label>
    </div>
</div>
