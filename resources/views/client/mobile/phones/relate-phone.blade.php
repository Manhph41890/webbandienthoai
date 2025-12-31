<!-- PHẦN SẢN PHẨM LIÊN QUAN - PHIÊN BẢN MOBILE CHUYÊN NGHIỆP -->
<section class="m-rel-p-section">
    <div class="m-rel-p-header">
        <div class="m-rel-p-title-group">
            <h3 class="m-rel-p-main-title">SẢN PHẨM TƯƠNG TỰ</h3>
            <div class="m-rel-p-underline"></div>
        </div>
        <a href="{{ route('category.show', $phone->category->slug ?? 'all') }}" class="m-rel-p-view-all">
            Xem tất cả <i class="fa-solid fa-chevron-right"></i>
        </a>
    </div>

    <div class="m-rel-p-scroll-container">
        @forelse ($relatedPhones as $relPhone)
            <div class="m-rel-p-card">
                <!-- Nút yêu thích -->
                <button class="m-rel-p-heart-btn">
                    <i class="fa-regular fa-heart"></i>
                </button>

                <!-- Ảnh sản phẩm -->
                <div class="m-rel-p-img-box">
                    <a href="{{ route('phone.detail', $relPhone->slug) }}">
                        <img src="{{ asset('storage/' . $relPhone->main_image) }}" alt="{{ $relPhone->name }}"
                            class="m-rel-p-img" onerror="this.src='{{ asset('images/no-image.png') }}'">
                    </a>
                </div>

                <!-- Nội dung -->
                <div class="m-rel-p-body">
                    <span class="m-rel-p-cat">{{ $relPhone->category->name }}</span>
                    <h4 class="m-rel-p-name">
                        <a href="{{ route('phone.detail', $relPhone->slug) }}">
                            {{ $relPhone->name }}
                        </a>
                    </h4>

                    <div class="m-rel-p-price-box">
                        <span class="m-rel-p-price">
                            @if ($relPhone->variants->isNotEmpty())
                                {{ number_format($relPhone->variants->sortBy('price')->first()->price, 0, ',', '.') }}
                                <small>won</small>
                            @else
                                Liên hệ
                            @endif
                        </span>
                    </div>

                    <div class="m-rel-p-footer">
                        <div class="m-rel-p-rating">
                            <i class="fa-solid fa-star"></i> 5.0
                        </div>
                        <div class="m-rel-p-sold">Đã bán 1.2k</div>
                    </div>
                </div>
            </div>
        @empty
            <div class="m-rel-p-empty">
                Không có sản phẩm tương tự.
            </div>
        @endforelse
    </div>
</section>

<style>
    /* Section Container */
    .m-rel-p-section {
        padding: 25px 0;
        background: #fff;
        margin-top: 10px;
        border-top: 8px solid #f2f2f2;
        /* Tạo khoảng cách giữa các phần */
    }

    /* Header */
    .m-rel-p-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 15px 15px 15px;
    }

    .m-rel-p-main-title {
        font-size: 16px;
        font-weight: 800;
        color: #222;
        margin: 0;
        text-transform: uppercase;
    }

    .m-rel-p-underline {
        width: 40px;
        height: 3px;
        background: #d70018;
        margin-top: 4px;
        border-radius: 2px;
    }

    .m-rel-p-view-all {
        font-size: 13px;
        color: #d70018;
        text-decoration: none;
        font-weight: 600;
    }

    /* Scroll Container - Quan trọng nhất cho Mobile UX */
    .m-rel-p-scroll-container {
        display: flex;
        overflow-x: auto;
        gap: 12px;
        padding: 5px 15px 15px 15px;
        scroll-snap-type: x mandatory;
        scrollbar-width: none;
        /* Ẩn scrollbar Firefox */
    }

    .m-rel-p-scroll-container::-webkit-scrollbar {
        display: none;
        /* Ẩn scrollbar Chrome/Safari */
    }

    /* Card Style */
    .m-rel-p-card {
        min-width: 160px;
        /* Độ rộng cố định để lướt ngang */
        max-width: 160px;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #f0f0f0;
        position: relative;
        scroll-snap-align: start;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    /* Heart Button */
    .m-rel-p-heart-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        z-index: 5;
        background: rgba(255, 255, 255, 0.8);
        border: none;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        font-size: 14px;
        color: #999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Image */
    .m-rel-p-img-box {
        width: 100%;
        height: 150px;
        padding: 10px;
        background: #fff;
        border-radius: 12px 12px 0 0;
    }

    .m-rel-p-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    /* Body */
    .m-rel-p-body {
        padding: 10px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .m-rel-p-cat {
        font-size: 10px;
        color: #d70018;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .m-rel-p-name {
        font-size: 13px;
        font-weight: 600;
        line-height: 1.4;
        margin-bottom: 8px;
        height: 36px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .m-rel-p-name a {
        color: #333;
        text-decoration: none;
    }

    .m-rel-p-price {
        font-size: 15px;
        font-weight: 800;
        color: #d70018;
    }

    .m-rel-p-price small {
        font-size: 10px;
        font-weight: normal;
    }

    /* Footer */
    .m-rel-p-footer {
        margin-top: auto;
        padding-top: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 11px;
        border-top: 1px solid #f9f9f9;
    }

    .m-rel-p-rating {
        color: #ffc107;
        font-weight: bold;
    }

    .m-rel-p-sold {
        color: #888;
    }

    .m-rel-p-empty {
        width: 100%;
        text-align: center;
        padding: 30px;
        color: #999;
        font-size: 14px;
    }
</style>
