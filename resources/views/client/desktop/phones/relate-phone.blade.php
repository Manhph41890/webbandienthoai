<!-- PHẦN SẢN PHẨM LIÊN QUAN - Đã đổi tên class hoàn toàn -->
<section class="rel-p-section mt-5 mb-5">
    <div class="container">
        <div class="rel-p-wrapper shadow-sm">
            <!-- Header -->
            <div class="rel-p-header">
                <div class="rel-p-title-group">
                    <h3 class="rel-p-main-title">SẢN PHẨM TƯƠNG TỰ</h3>
                    <div class="rel-p-underline"></div>
                </div>
                <a href="{{ route('category.show', $phone->category->slug ?? 'all') }}" class="rel-p-view-all">
                    Xem tất cả <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>

            <div class="row g-3 g-lg-4">
                @forelse ($relatedPhones as $relPhone)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="rel-p-card">
                            <!-- Nút yêu thích -->
                            <div class="rel-p-wishlist">
                                <button class="rel-p-heart-btn" title="Thêm vào yêu thích">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </div>

                            <!-- Ảnh sản phẩm -->
                            <div class="rel-p-img-container">
                                <a href="{{ route('phone.detail', $relPhone->slug) }}" class="rel-p-img-link">
                                    <img src="{{ asset('storage/' . $relPhone->main_image) }}"
                                        alt="{{ $relPhone->name }}" class="rel-p-img"
                                        onerror="this.src='{{ asset('images/no-image.png') }}'">
                                </a>
                                <!-- Lớp phủ hiệu ứng khi hover -->
                                <div class="rel-p-overlay"></div>
                            </div>

                            <!-- Nội dung -->
                            <div class="rel-p-body">
                                <span class="rel-p-category">{{ $relPhone->category->name }}</span>
                                <h4 class="rel-p-name">
                                    <a href="{{ route('phone.detail', $relPhone->slug) }}">
                                        {{ $relPhone->name }}
                                    </a>
                                </h4>

                                <div class="rel-p-price-row">
                                    <span class="rel-p-price">
                                        @if ($relPhone->variants->isNotEmpty())
                                            {{ number_format($relPhone->variants->sortBy('price')->first()->price, 0, ',', '.') }}
                                            <span class="rel-p-curr">won</span>
                                        @else
                                            Liên hệ
                                        @endif
                                    </span>
                                </div>

                                <div class="rel-p-footer">
                                    <div class="rel-p-rating">
                                        <i class="fa-solid fa-star"></i>
                                        <span class="rel-p-rating-val">5.0</span>
                                    </div>
                                    <a href="{{ route('phone.detail', $relPhone->slug) }}" class="rel-p-btn-detail">
                                        CHI TIẾT
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Không tìm thấy sản phẩm tương tự.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<style>
    /* Reset & Container */
    .rel-p-section {
        padding-right: 25px !important; 
    }
    .rel-p-wrapper {
        background: #ffffff;
        border-radius: 16px;
        padding: 25px;
        border: 1px solid #f0f0f0;
        min-width: 1200px !important;
    }

    /* Header Style */
    .rel-p-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 30px;
    }

    .rel-p-main-title {
        font-size: 22px;
        font-weight: 800;
        color: #1a1a1a;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .rel-p-underline {
        width: 50px;
        height: 4px;
        background: #b11c44;
        margin-top: 8px;
        border-radius: 2px;
    }

    .rel-p-view-all {
        text-decoration: none;
        color: #b11c44;
        font-size: 14px;
        font-weight: 600;
        transition: 0.3s;
    }

    .rel-p-view-all:hover {
        gap: 10px;
        color: #d70018;
    }

    /* Card Style */
    .rel-p-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #f1f1f1;
        position: relative;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .rel-p-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        border-color: #b11c4433;
    }

    /* Image & Overlay */
    .rel-p-img-container {
        position: relative;
        padding-top: 100%;
        /* Ratio 1:1 */
        overflow: hidden;
        background: #f9f9f9;
    }

    .rel-p-img-link {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 2;
        /* Đảm bảo nằm trên cùng để click */
    }

    .rel-p-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 15px;
        transition: transform 0.6s ease;
    }

    /* Sửa lỗi bị đè: Dùng pointer-events: none cho lớp phủ */
    .rel-p-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(177, 28, 68, 0.05), transparent);
        opacity: 0;
        transition: 0.4s;
        pointer-events: none;
        /* CLICK XUYÊN QUA ĐƯỢC */
        z-index: 1;
    }

    .rel-p-card:hover .rel-p-img {
        transform: scale(1.1);
    }

    .rel-p-card:hover .rel-p-overlay {
        opacity: 1;
    }

    /* Wishlist Button */
    .rel-p-wishlist {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 10;
    }

    .rel-p-heart-btn {
        background: #fff;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        color: #666;
        transition: 0.3s;
    }

    .rel-p-heart-btn:hover {
        background: #b11c44;
        color: #fff;
    }

    /* Content Body */
    .rel-p-body {
        padding: 15px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .rel-p-category {
        font-size: 11px;
        font-weight: 700;
        color: #b11c44;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .rel-p-name {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 10px;
        line-height: 1.4;
        height: 42px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .rel-p-name a {
        text-decoration: none;
        color: #1a1a1a;
        transition: 0.2s;
    }

    .rel-p-name a:hover {
        color: #b11c44;
    }

    .rel-p-price {
        font-size: 18px;
        font-weight: 800;
        color: #d70018;
    }

    .rel-p-curr {
        font-size: 12px;
        text-transform: uppercase;
        margin-left: 2px;
    }

    /* Footer */
    .rel-p-footer {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
    }

    .rel-p-rating {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        color: #ffc107;
    }

    .rel-p-rating-val {
        color: #888;
        font-weight: 600;
    }

    .rel-p-btn-detail {
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        color: #555;
        background: #f5f5f5;
        padding: 6px 12px;
        border-radius: 6px;
        transition: 0.3s;
    }

    .rel-p-btn-detail:hover {
        background: #1a1a1a;
        color: #fff;
    }

    /* Mobile Responsive */
    @media (max-width: 576px) {
        .rel-p-wrapper {
            padding: 15px;
        }

        .rel-p-main-title {
            font-size: 18px;
        }

        .rel-p-price {
            font-size: 16px;
        }

        .rel-p-name {
            font-size: 14px;
        }
    }
</style>
