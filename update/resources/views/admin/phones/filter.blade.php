<div class="adm-fl-container shadow-sm">
    <form action="{{ route('admin.phones.index') }}" method="GET" id="filterForm">
        <!-- Hàng hiển thị chính (Primary Row) -->
        <div class="adm-fl-primary-row">
            <div class="adm-fl-search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" placeholder="Tên sản phẩm, SKU hoặc từ khóa..."
                    value="{{ request('search') }}">
            </div>

            <div class="adm-fl-actions">
                <button type="button" class="adm-fl-toggle-btn" id="toggleAdvanced">
                    <i class="fa-solid fa-sliders"></i>
                    <span>Bộ lọc nâng cao</span>
                    <i class="fa-solid fa-chevron-down chevron"></i>
                </button>
                <button type="submit" class="adm-fl-submit-btn">
                    <i class="fa-solid fa-filter"></i> Lọc
                </button>
            </div>
        </div>

        <!-- Khu vực nâng cao (Collapsible Area) -->
        <div class="adm-fl-advanced-box" id="advancedBox">
            <div class="adm-fl-grid">
                <!-- Danh mục -->
                <div class="adm-fl-item">
                    <label>Danh mục sản phẩm</label>
                    <select name="category_id" class="select2-filter"> {{-- Thêm class nếu bạn dùng Select2 --}}
                        <option value="">Tất cả danh mục</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                @if ($cat->parent)
                                    {{ $cat->parent->name }} &raquo; {{ $cat->name }}
                                @else
                                    {{ $cat->name }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Kho hàng -->
                <div class="adm-fl-item">
                    <label>Kho hàng</label>
                    <select name="stock_status">
                        <option value="">Tất cả trạng thái</option>
                        <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>Còn hàng
                        </option>
                        <option value="low_stock" {{ request('stock_status') == 'low_stock' ? 'selected' : '' }}>Sắp hết
                            (≤5)</option>
                        <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>
                            Hết hàng</option>
                    </select>
                </div>

                <!-- Tình trạng -->
                <div class="adm-fl-item">
                    <label>Tình trạng máy</label>
                    <select name="condition">
                        <option value="">Tất cả</option>
                        <option value="new" {{ request('condition') == 'new' ? 'selected' : '' }}>Máy mới (New)
                        </option>
                        <option value="used" {{ request('condition') == 'used' ? 'selected' : '' }}>Máy cũ (Used)
                        </option>
                    </select>
                </div>

                <!-- Sắp xếp -->
                <div class="adm-fl-item">
                    <label>Sắp xếp</label>
                    <select name="sort">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần
                        </option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần
                        </option>
                        <option value="stock_desc" {{ request('sort') == 'stock_desc' ? 'selected' : '' }}>Kho (Giảm
                            dần)</option>
                    </select>
                </div>

                <!-- Khoảng giá -->
                <div class="adm-fl-item">
                    <label>Khoảng giá (Từ - Đến)</label>
                    <div class="adm-fl-range">
                        <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}">
                        <span>-</span>
                        <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}">
                    </div>
                </div>

                <!-- Phân trang -->
                <div class="adm-fl-item">
                    <label>Hiển thị</label>
                    <select name="per_page">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 bản ghi</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 bản ghi</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 bản ghi</option>
                    </select>
                </div>
            </div>

            <div class="adm-fl-footer">
                <a href="{{ route('admin.phones.index') }}" class="adm-fl-reset">
                    <i class="fa-solid fa-arrow-rotate-left"></i> Làm mới bộ lọc
                </a>
            </div>
        </div>
    </form>
</div>
@include('admin.phones.filter-lib')
