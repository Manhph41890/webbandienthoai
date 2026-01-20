<div class="card shadow-sm mb-4 border-0" style="border-radius: 12px;">
    <div class="card-body p-3">
        <form action="{{ route('admin.categories.index') }}" method="GET" class="row align-items-end g-2">

            <!-- Ô tìm kiếm -->
            <div class="col-md-5">
                <label class="small font-weight-bold text-muted">Từ khóa</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-light border-right-0"><i
                                class="fas fa-search text-muted"></i></span>
                    </div>
                    <input type="text" name="search" class="form-control border-left-0 bg-light"
                        placeholder="Tìm tên chuyên mục..." value="{{ request('search') }}">
                </div>
            </div>

            <!-- Bộ lọc cấp bậc -->
            <div class="col-md-4">
                <label class="small font-weight-bold text-muted">Cấp bậc chuyên mục</label>
                <select name="parent_id" class="form-control bg-light border-0 custom-select-style">
                    <option value="">-- Tất cả cấp bậc --</option>
                    <option value="root" {{ request('parent_id') == 'root' ? 'selected' : '' }}>Chuyên mục gốc (Cấp 1)
                    </option>

                    @foreach ($filterCategories as $parent)
                        <option value="{{ $parent->id }}" {{ request('parent_id') == $parent->id ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>

                        <!-- Hiển thị chuyên mục con cấp 2 (nếu có) -->
                        @if ($parent->children->count() > 0)
                            @foreach ($parent->children as $child)
                                <option value="{{ $child->id }}"
                                    {{ request('parent_id') == $child->id ? 'selected' : '' }}>
                                    &nbsp;&nbsp;&nbsp;↳ {{ $child->name }}
                                </option>
                            @endforeach
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Nút hành động -->
            <div class="col-md-3 d-flex" style="gap: 8px;">
                <button type="submit" class="btn btn-primary flex-grow-1 shadow-sm font-weight-bold"
                    style="background: #140000; border: none; height: 38px;">
                    <i class="fas fa-filter mr-1"></i> Lọc
                </button>
                <a href="{{ route('admin.categories.index') }}"
                    class="btn btn-light border flex-grow-1 font-weight-bold" style="height: 38px;">
                    Làm mới
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    /* Style bổ sung cho "xịn" */
    .custom-select-style {
        height: 38px;
        border-radius: 8px;
        font-size: 14px;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #140000;
    }

    .input-group-text {
        border-radius: 8px 0 0 8px;
    }

    input.form-control {
        border-radius: 0 8px 8px 0;
    }
</style>
