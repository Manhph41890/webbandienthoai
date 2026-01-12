                <!-- 1. Thanh kích hoạt bộ lọc (Nằm trên danh sách sản phẩm) -->
                <div class="mf-filter-trigger-bar">
                    <div class="mf-trigger-item" id="openSortSheet">
                        <i class="fa-solid fa-arrow-up-wide-short"></i>
                        <span>{{ request('sort') ? 'Đang sắp xếp' : 'Sắp xếp' }}</span>
                    </div>

                    <div class="mf-divider"></div>

                    <div class="mf-trigger-item" id="openPriceSheet">
                        <i class="fa-solid fa-filter"></i>
                        <span>{{ request('price_range') ? 'Đã lọc giá' : 'Lọc giá' }}</span>
                    </div>

                    @if (request()->has('sort') || request()->has('price_range'))
                        <a href="{{ url()->current() }}" class="mf-clear-btn">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    @endif
                </div>

                <!-- Hiển thị số lượng kết quả gọn gàng -->
                <div class="mf-result-info">
                    Hiển thị <b>{{ $iphones->firstItem() }}-{{ $iphones->lastItem() }}</b> trong
                    <b>{{ $iphones->total() }}</b> sản phẩm
                </div>

                <!-- 2. Overlay (Lớp nền mờ) -->
                <div class="mf-sheet-overlay" id="sheetOverlay"></div>

                <!-- 3. Bottom Sheet cho Bộ lọc & Sắp xếp -->
                <div class="mf-bottom-sheet" id="filterSheet">
                    <div class="mf-sheet-header">
                        <div class="mf-sheet-handle"></div> <!-- Thanh gạch nhỏ trên đầu -->
                        <h3 id="sheetTitle">Bộ lọc</h3>
                        <button class="mf-sheet-close" id="closeSheet">&times;</button>
                    </div>

                    <form action="{{ url()->current() }}" method="GET" id="mobile-filter-form">
                        <div class="mf-sheet-content">
                            <!-- Nhóm Sắp xếp (Ẩn/Hiện tùy vào việc bấm nút nào) -->
                            <div class="mf-filter-group" id="sortOptions">
                                <p class="mf-group-label">Sắp xếp theo</p>
                                <div class="mf-options-grid">
                                    <label class="mf-option-item">
                                        <input type="radio" name="sort" value="latest"
                                            {{ request('sort') == 'latest' ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <span>Mới nhất</span>
                                    </label>
                                    <label class="mf-option-item">
                                        <input type="radio" name="sort" value="popular"
                                            {{ request('sort') == 'popular' ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <span>Xem nhiều nhất</span>
                                    </label>
                                    <label class="mf-option-item">
                                        <input type="radio" name="sort" value="price_asc"
                                            {{ request('sort') == 'price_asc' ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <span>Giá: Thấp đến Cao</span>
                                    </label>
                                    <label class="mf-option-item">
                                        <input type="radio" name="sort" value="price_desc"
                                            {{ request('sort') == 'price_desc' ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <span>Giá: Cao đến Thấp</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Nhóm Giá -->
                            <div class="mf-filter-group" id="priceOptions">
                                <p class="mf-group-label">Mức giá (Won)</p>
                                <div class="mf-options-grid">
                                    <label class="mf-option-item">
                                        <input type="radio" name="price_range" value=""
                                            {{ request('price_range') == '' ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <span>Tất cả</span>
                                    </label>
                                    <label class="mf-option-item">
                                        <input type="radio" name="price_range" value="under_500"
                                            {{ request('price_range') == 'under_500' ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <span>Dưới 500k</span>
                                    </label>
                                    <label class="mf-option-item">
                                        <input type="radio" name="price_range" value="500_1000"
                                            {{ request('price_range') == '500_1000' ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <span>500k - 1 triệu</span>
                                    </label>
                                    <label class="mf-option-item">
                                        <input type="radio" name="price_range" value="over_1000"
                                            {{ request('price_range') == 'over_1000' ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <span>Trên 1 triệu</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Giữ lại tham số cũ nếu có (ví dụ search query) -->
                        @if (request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif
                    </form>
                </div>

                <style>
                    /* 1. Trigger Bar */
                    .mf-filter-trigger-bar {
                        display: flex;
                        align-items: center;
                        background: #fff;
                        border: 1px solid #eee;
                        border-radius: 10px;
                        margin: 15px 10px;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
                    }

                    .mf-trigger-item {
                        flex: 1;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 8px;
                        padding: 12px;
                        font-size: 14px;
                        font-weight: 600;
                        color: #444;
                    }

                    .mf-divider {
                        width: 1px;
                        height: 20px;
                        background: #eee;
                    }

                    .mf-clear-btn {
                        padding: 0 15px;
                        color: #ff4d6d;
                        font-size: 18px;
                    }

                    .mf-result-info {
                        text-align: center;
                        font-size: 12px;
                        color: #888;
                        margin-bottom: 15px;
                    }

                    /* 2. Bottom Sheet */
                    .mf-sheet-overlay {
                        position: fixed;
                        inset: 0;
                        background: rgba(0, 0, 0, 0.5);
                        z-index: 10000;
                        opacity: 0;
                        visibility: hidden;
                        transition: 0.3s;
                        backdrop-filter: blur(2px);
                    }

                    .mf-bottom-sheet {
                        position: fixed;
                        bottom: -100%;
                        left: 0;
                        width: 100%;
                        background: #fff;
                        z-index: 10001;
                        border-radius: 20px 20px 0 0;
                        transition: bottom 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                        max-height: 80vh;
                        overflow-y: auto;
                    }

                    .mf-bottom-sheet.active {
                        bottom: 0;
                    }

                    .mf-sheet-overlay.active {
                        opacity: 1;
                        visibility: visible;
                    }

                    /* 3. Sheet Content */
                    .mf-sheet-header {
                        padding: 15px;
                        text-align: center;
                        position: relative;
                        border-bottom: 1px solid #f5f5f5;
                    }

                    .mf-sheet-handle {
                        width: 40px;
                        height: 4px;
                        background: #ddd;
                        border-radius: 2px;
                        margin: 0 auto 10px;
                    }

                    .mf-sheet-header h3 {
                        margin: 0;
                        font-size: 16px;
                        font-weight: bold;
                    }

                    .mf-sheet-close {
                        position: absolute;
                        right: 15px;
                        top: 15px;
                        border: none;
                        background: none;
                        font-size: 24px;
                        color: #999;
                    }

                    .mf-sheet-content {
                        padding: 20px;
                    }

                    .mf-group-label {
                        font-weight: bold;
                        font-size: 14px;
                        margin-bottom: 12px;
                        color: #333;
                    }

                    /* Options Grid */
                    .mf-options-grid {
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        gap: 10px;
                        margin-bottom: 25px;
                    }

                    .mf-option-item {
                        position: relative;
                    }

                    .mf-option-item input {
                        position: absolute;
                        opacity: 0;
                    }

                    .mf-option-item span {
                        display: block;
                        padding: 10px;
                        text-align: center;
                        background: #f8f9fa;
                        border: 1px solid #eee;
                        border-radius: 8px;
                        font-size: 13px;
                        color: #666;
                        transition: 0.2s;
                    }

                    .mf-option-item input:checked+span {
                        background: #fff0f2;
                        border-color: #ff4d6d;
                        color: #ff4d6d;
                        font-weight: bold;
                    }
                </style>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const overlay = document.getElementById('sheetOverlay');
                        const sheet = document.getElementById('filterSheet');
                        const closeBtn = document.getElementById('closeSheet');

                        const openSort = document.getElementById('openSortSheet');
                        const openPrice = document.getElementById('openPriceSheet');

                        const sortGroup = document.getElementById('sortOptions');
                        const priceGroup = document.getElementById('priceOptions');
                        const sheetTitle = document.getElementById('sheetTitle');

                        function openSheet(type) {
                            sheet.classList.add('active');
                            overlay.classList.add('active');
                            document.body.style.overflow = 'hidden'; // Chống cuộn nền

                            if (type === 'sort') {
                                sheetTitle.innerText = 'Sắp xếp theo';
                                sortGroup.style.display = 'block';
                                priceGroup.style.display = 'none';
                            } else {
                                sheetTitle.innerText = 'Lọc theo giá';
                                sortGroup.style.display = 'none';
                                priceGroup.style.display = 'block';
                            }
                        }

                        function closeSheetFunc() {
                            sheet.classList.remove('active');
                            overlay.classList.remove('active');
                            document.body.style.overflow = '';
                        }

                        openSort.addEventListener('click', () => openSheet('sort'));
                        openPrice.addEventListener('click', () => openSheet('price'));
                        closeBtn.addEventListener('click', closeSheetFunc);
                        overlay.addEventListener('click', closeSheetFunc);
                    });
                </script>
