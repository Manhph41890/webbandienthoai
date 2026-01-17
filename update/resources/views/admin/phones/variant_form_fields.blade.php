<div class="card mb-3 p-3 bg-light variant-item" data-index="{{ $index }}">
    <div class="d-flex justify-content-between align-items-center">
        <h6 class="mb-0 text-primary font-weight-bold">Biến thể #{{ $index + 1 }}</h6>
        {{-- @if ($index > 0 || (isset($variant) && $variant->id)) --}}
        @if ($index > 0 || (isset($variant) && data_get($variant, 'id')))
            <button type="button" class="btn btn-danger btn-sm remove-variant-btn">
                <i class="fas fa-times"></i> Xóa
            </button>
        @endif
    </div>
    
    <div class="row mt-2">
        {{-- @if (isset($variant) && $variant->id)
            <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant->id }}">
        @endif --}}

        @if (isset($variant) && data_get($variant, 'id'))
    <input type="hidden" name="variants[{{ $index }}][id]" value="{{ data_get($variant, 'id') }}">
@endif

        <!-- Tình trạng máy (Mới/Cũ) -->
        <div class="col-md-4 mb-3">
            <label class="form-label text-success font-weight-bold">Tình trạng máy</label>
            <select class="form-control condition-select @error('variants.' . $index . '.condition') is-invalid @enderror" 
                name="variants[{{ $index }}][condition]">
                <option value="new" {{ old("variants.$index.condition", $variant->condition ?? '') == 'new' ? 'selected' : '' }}>Máy mới (New)</option>
                <option value="used" {{ old("variants.$index.condition", $variant->condition ?? '') == 'used' ? 'selected' : '' }}>Máy cũ (Used/Lướt)</option>
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Kích thước (Size)</label>
            <select class="form-control @error('variants.' . $index . '.size_id') is-invalid @enderror" 
                name="variants[{{ $index }}][size_id]">
                <option value="">Chọn kích thước</option>
                @foreach ($sizes as $size)
                    <option value="{{ $size->id }}" {{ old("variants.$index.size_id", $variant->size_id ?? '') == $size->id ? 'selected' : '' }}>
                        {{ $size->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Màu sắc</label>
            <select class="form-control @error('variants.' . $index . '.color_id') is-invalid @enderror" 
                name="variants[{{ $index }}][color_id]">
                <option value="">Chọn màu sắc</option>
                @foreach ($colors as $color)
                    <option value="{{ $color->id }}" {{ old("variants.$index.color_id", $variant->color_id ?? '') == $color->id ? 'selected' : '' }}>
                        {{ $color->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Thông tin chung (General Specs) -->
    <div class="row bg-white mx-0 py-2 mb-3 border rounded">
        <div class="col-md-12"><small class="text-muted">Thông tin cấu hình chung:</small></div>
        <div class="col-md-4 mb-2">
            <label class="small">Bộ nhớ (Storage)</label>
            <input type="text" class="form-control form-control-sm" name="variants[{{ $index }}][general_specs][storage]" 
                value="{{ old("variants.$index.general_specs.storage", $variant->general_specs['storage'] ?? '') }}" placeholder="VD: 256GB">
        </div>
        <div class="col-md-4 mb-2">
            <label class="small">RAM</label>
            <input type="text" class="form-control form-control-sm" name="variants[{{ $index }}][general_specs][ram]" 
                value="{{ old("variants.$index.general_specs.ram", $variant->general_specs['ram'] ?? '') }}" placeholder="VD: 8GB">
        </div>
        <div class="col-md-4 mb-2">
            <label class="small">Màn hình (Screen Size)</label>
            <input type="text" class="form-control form-control-sm" name="variants[{{ $index }}][general_specs][screen_size]" 
                value="{{ old("variants.$index.general_specs.screen_size", $variant->general_specs['screen_size'] ?? '') }}" placeholder="VD: 6.7 inch">
        </div>
    </div>

    <!-- Thông tin máy cũ (Used Details) - Chỉ hiện khi chọn 'used' -->
    @php
        $isUsed = old("variants.$index.condition", $variant->condition ?? '') == 'used';
    @endphp
    <div class="used-details-container row bg-warning-light mx-0 py-2 mb-3 border rounded border-warning" 
         style="display: {{ $isUsed ? 'flex' : 'none' }}; background-color: #fffcf0;">
        <div class="col-md-12"><small class="text-warning font-weight-bold">Thông tin chi tiết máy cũ:</small></div>
        <div class="col-md-4 mb-2">
            <label class="small">Dung lượng Pin (%)</label>
            <input type="number" class="form-control form-control-sm" name="variants[{{ $index }}][used_details][battery_health]" 
                value="{{ old("variants.$index.used_details.battery_health", $variant->used_details['battery_health'] ?? '') }}">
        </div>
        <div class="col-md-4 mb-2">
            <label class="small">Số lần sạc</label>
            <input type="number" class="form-control form-control-sm" name="variants[{{ $index }}][used_details][charging_cycles]" 
                value="{{ old("variants.$index.used_details.charging_cycles", $variant->used_details['charging_cycles'] ?? '') }}">
        </div>
        <div class="col-md-4 mb-2">
            <label class="small">Mô tả tình trạng (Lỗi, trầy xước...)</label>
            <input type="text" class="form-control form-control-sm" name="variants[{{ $index }}][used_details][description]" 
                value="{{ old("variants.$index.used_details.description", $variant->used_details['description'] ?? '') }}" placeholder="VD: Màn sọc nhẹ, trầy vỏ">
        </div>
    </div>

    <div class="row">
        <!-- SKU -->
        <div class="col-md-4 mb-3">
            <label class="form-label">SKU</label>
            <input type="text" class="form-control" name="variants[{{ $index }}][sku]"
                value="{{ old("variants.$index.sku", $variant->sku ?? '') }}">
        </div>

        <!-- Giá -->
        <div class="col-md-4 mb-3">
            <label class="form-label">Giá <span class="text-danger">*</span></label>
            <input type="number" step="0.01" class="form-control" name="variants[{{ $index }}][price]"
                value="{{ old("variants.$index.price", $variant->price ?? '') }}" >
        </div>

        <!-- Tồn kho -->
        <div class="col-md-4 mb-3">
            <label class="form-label">Tồn kho <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="variants[{{ $index }}][stock]"
                value="{{ old("variants.$index.stock", $variant->stock ?? '') }}" >
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <label class="form-label">Ảnh biến thể</label>
            <input type="file" class="form-control" name="variants[{{ $index }}][image_path]" accept="image/*">
        </div>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="variants_{{ $index }}_is_default"
            name="variants[{{ $index }}][is_default]" value="1"
            {{ old("variants.$index.is_default", $variant->is_default ?? false) ? 'checked' : '' }}>
        <label class="form-check-label" for="variants_{{ $index }}_is_default">Đặt làm biến thể mặc định</label>
    </div>
</div>