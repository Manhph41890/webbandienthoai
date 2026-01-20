<div class="adm-fl-container shadow-sm mb-4">
    <form action="{{ route('admin.packages.index') }}" method="GET" id="filterForm">
        <!-- Hàng hiển thị chính -->
        <div class="adm-fl-primary-row">
            <div class="adm-fl-search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" placeholder="Tìm tên gói cước, mã hoặc nhà mạng..."
                    value="{{ request('search') }}">
            </div>

            <div class="adm-fl-actions">
                <button type="button" class="adm-fl-toggle-btn" id="toggleAdvanced">
                    <i class="fa-solid fa-sliders"></i>
                    <span>Lọc nâng cao</span>
                    <i class="fa-solid fa-chevron-down chevron"></i>
                </button>
                <button type="submit" class="adm-fl-submit-btn">
                    <i class="fa-solid fa-filter"></i> Lọc
                </button>
            </div>
        </div>

        <!-- Khu vực nâng cao -->
        <div class="adm-fl-advanced-box" id="advancedBox">
            <div class="adm-fl-grid">
                <!-- Nhà mạng -->
                <div class="adm-fl-item">
                    <label>Nhà mạng</label>
                    <select name="carrier">
                        <option value="">Tất cả nhà mạng</option>
                        <option value="sk" {{ request('carrier') == 'sk' ? 'selected' : '' }}>SK Telecom</option>
                        <option value="kt" {{ request('carrier') == 'kt' ? 'selected' : '' }}>KT</option>
                        <option value="lgu" {{ request('carrier') == 'lgu' ? 'selected' : '' }}>LGU+</option>
                    </select>
                </div>

                <!-- Loại thanh toán -->
                <div class="adm-fl-item">
                    <label>Hình thức</label>
                    <select name="payment_type">
                        <option value="">Tất cả</option>
                        <option value="tra_truoc" {{ request('payment_type') == 'tra_truoc' ? 'selected' : '' }}>Trả
                            trước</option>
                        <option value="tra_sau" {{ request('payment_type') == 'tra_sau' ? 'selected' : '' }}>Trả sau
                        </option>
                    </select>
                </div>

                <!-- Loại Sim (Dựa trên Model sim_type) -->
                <div class="adm-fl-item">
                    <label>Phân loại Sim</label>
                    <select name="sim_type">
                        <option value="">Tất cả</option>
                        <option value="hop_phap" {{ request('sim_type') == 'hop_phap' ? 'selected' : '' }}>Sim chính chủ
                        </option>
                        <option value="bat_hop_phap" {{ request('sim_type') == 'bat_hop_phap' ? 'selected' : '' }}>Sim
                            không chính chủ</option>
                    </select>
                </div>

                <!-- Trạng thái -->
                <div class="adm-fl-item">
                    <label>Trạng thái kho</label>
                    <select name="status">
                        <option value="">Tất cả</option>
                        <option value="con_hang" {{ request('status') == 'con_hang' ? 'selected' : '' }}>Còn hàng
                        </option>
                        <option value="het_hang" {{ request('status') == 'het_hang' ? 'selected' : '' }}>Hết hàng
                        </option>
                    </select>
                </div>

                <!-- Danh mục -->
                <div class="adm-fl-item">
                    <label>Nhóm gói cước</label>
                    <select name="category_id">
                        <option value="">Tất cả nhóm</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sắp xếp -->
                <div class="adm-fl-item">
                    <label>Sắp xếp giá</label>
                    <select name="sort">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần
                        </option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần
                        </option>
                    </select>
                </div>

                <!-- Khoảng giá -->
                <div class="adm-fl-item">
                    <label>Giá (Từ - Đến)</label>
                    <div class="adm-fl-range">
                        <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}">
                        <span>-</span>
                        <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}">
                    </div>
                </div>

                <!-- Phân trang -->
                <div class="adm-fl-item">
                    <label>Số lượng hiển thị</label>
                    <select name="per_page">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 bản ghi</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 bản ghi</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 bản ghi</option>
                    </select>
                </div>
            </div>

            <div class="adm-fl-footer">
                <a href="{{ route('admin.packages.index') }}" class="adm-fl-reset">
                    <i class="fa-solid fa-arrow-rotate-left"></i> Xóa bộ lọc
                </a>
            </div>
        </div>
    </form>
</div>

<style>
    /* 1. Container tổng quát */
    .adm-fl-container {
        background: #fff;
        border-radius: 12px;
        padding: 15px;
        border: 1px solid #edf2f9;
        margin-bottom: 20px;
    }

    /* 2. Hàng chính (Search & Nút mở rộng) */
    .adm-fl-primary-row {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .adm-fl-search-box {
        flex: 1;
        position: relative;
        display: flex;
        align-items: center;
    }

    .adm-fl-search-box i {
        position: absolute;
        left: 15px;
        color: #ffffff;
    }

    .adm-fl-search-box input {
        width: 100%;
        padding: 10px 15px 10px 40px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        transition: all 0.3s;
        font-size: 14px;
    }

    .adm-fl-search-box input:focus {
        outline: none;
        background: #fff;
        border-color: #140000;
        box-shadow: 0 0 0 3px rgba(26, 34, 45, 0.1);
    }

    .adm-fl-actions {
        display: flex;
        gap: 10px;
    }

    /* 3. Nút bấm */
    .adm-fl-toggle-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 0 18px;
        height: 42px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        color: #475569;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 14px;
    }

    .adm-fl-toggle-btn:hover {
        background: #f1f5f9;
    }

    .adm-fl-toggle-btn .chevron {
        font-size: 10px;
        transition: transform 0.3s;
    }

    .adm-fl-submit-btn {
        background: #140000;
        color: #fff;
        border: none;
        padding: 0 25px;
        height: 42px;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: opacity 0.3s;
        cursor: pointer;
    }

    .adm-fl-submit-btn:hover {
        opacity: 0.9;
    }

    /* 4. Khu vực bộ lọc nâng cao (Grid) */
    .adm-fl-advanced-box {
        display: none;
        /* Ẩn mặc định */
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px dashed #e2e8f0;
    }

    .adm-fl-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }

    .adm-fl-item {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .adm-fl-item label {
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0;
    }

    .adm-fl-item select,
    .adm-fl-item input {
        height: 40px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 0 12px;
        font-size: 14px;
        color: #1e293b;
        background-color: #fff;
    }

    /* 5. Khoảng giá Min-Max */
    .adm-fl-range {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .adm-fl-range input {
        width: 100%;
    }

    .adm-fl-range span {
        color: #ffffff;
    }

    /* 6. Footer của bộ lọc */
    .adm-fl-footer {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
    }

    .adm-fl-reset {
        font-size: 13px;
        color: #ef4444;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
        font-weight: 600;
    }

    .adm-fl-reset:hover {
        color: #dc2626;
        text-decoration: underline;
    }

    /* Responsive cho mobile */
    @media (max-width: 768px) {
        .adm-fl-primary-row {
            flex-direction: column;
            align-items: stretch;
        }

        .adm-fl-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
    }
</style>

<script>
    document.getElementById('toggleAdvanced').addEventListener('click', function() {
        const box = document.getElementById('advancedBox');
        const chevron = this.querySelector('.chevron');

        if (box.style.display === 'block') {
            box.style.display = 'none';
            chevron.style.transform = 'rotate(0deg)';
        } else {
            box.style.display = 'block';
            chevron.style.transform = 'rotate(180deg)';
        }
    });

    // Tự động mở nếu đang có lọc nâng cao
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const hasAdvanced = ['carrier', 'payment_type', 'sim_type', 'status', 'category_id', 'min_price',
            'max_price'
        ].some(param => urlParams.has(param));

        if (hasAdvanced) {
            document.getElementById('advancedBox').style.display = 'block';
            document.getElementById('toggleAdvanced').querySelector('.chevron').style.transform = 'rotate(180deg)';
        }
    }
</script>
