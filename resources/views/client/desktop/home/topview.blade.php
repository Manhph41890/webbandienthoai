<section class="top-selling-section mt-5">
    <div class="container">
        <div class="top-selling-container shadow-sm">
            <!-- Header đỏ rực rỡ -->
            <div class="top-selling-header">
                <h2 class="header-title">TOP SẢN PHẨM BÁN CHẠY</h2>
            </div>

            <div class="top-selling-body">
                <!-- Danh mục Tab -->
                <div class="top-category-tabs">
                    <a href="#" class="top-tab-item active">Tất cả</a>

                    @foreach ($categories as $cat)
                        <a href="{{ route('category.show', $cat->slug) }}"
                            class="top-tab-item {{ request()->is('category/' . $cat->slug) ? 'active' : '' }}"
                            data-filter="cat-{{ $cat->id }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>

                <!-- Lưới sản phẩm (4 cái 1 dòng trên màn hình lớn) -->
                <div class="row g-3">
                    @foreach ($topSellingPhones as $phone)
                        @php
                            // Lấy biến thể đầu tiên để hiển thị thông tin
                            $variant = $phone->variants->first();
                            $currentPrice = $variant ? $variant->price : 0;
                            $oldPrice = $currentPrice * 1.15; // Giả định giá cũ cao hơn 15%
                            $salePercent = 15;
                        @endphp

                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="top-product-card">
                                <!-- Banner nhỏ đè lên ảnh -->
                                <div class="card-image-wrapper">
                                    <a href="{{ route('phone.detail', $phone->slug) }}">
                                        <img src="{{ asset('storage/' . $phone->main_image) }}"
                                            alt="{{ $phone->name }}" class="img-fluid" onerror="this.src='#'">
                                    </a>
                                    <div class="promo-banner-bottom">

                                    </div>
                                </div>

                                <div class="card-info">
                                    <h3 class="card-name">
                                        <a href="{{ route('phone.detail', $phone->slug) }}"
                                            style="text-decoration: none; color: inherit;">
                                            {{ $phone->name }}
                                            {{ $variant && $variant->size ? $variant->size->name : '' }}
                                        </a>
                                    </h3>
                                    <div class="card-price-main">
                                        {{ number_format($currentPrice, 0, ',', '.') }} won
                                    </div>
                                    <div class="card-price-sub">
                                        <span class="old-price">{{ number_format($oldPrice, 0, ',', '.') }}w</span>
                                        <span class="sale-percent">-{{ $salePercent }}%</span>
                                        <button class="spc-heart-btn {{ $phone->isFavorited() ? 'active' : '' }}"
                                            data-id="{{ $phone->id }}" data-type="phone"
                                            style="padding-left: 100px">
                                            <i
                                                class="{{ $phone->isFavorited() ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        /* Bọc toàn bộ section */
        .top-selling-container {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }

        /* Header màu đỏ rực rỡ */
        .top-selling-header {
            background: linear-gradient(180deg, #000000 30%, #7e0e28 100%);
            padding: 15px;
            text-align: center;
            border-bottom: 3px solid #efeef2;
        }

        .header-title {
            color: #fff;
            font-weight: 800;
            font-size: 24px;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: 1px;
        }

        .top-selling-body {
            padding: 15px;
        }

        /* Tabs phong cách nút trắng */
        .top-category-tabs {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding-bottom: 12px;
            margin-bottom: 20px;
            scrollbar-width: thin;
        }

        .top-category-tabs::-webkit-scrollbar {
            height: 4px;
        }

        .top-category-tabs::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 5px !important;
        }

        .top-tab-item {
            padding: 8px 16px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            white-space: nowrap;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: 0.3s;
            background: #fff;
        }

        .top-tab-item:hover {
            border-color: #d71921;
            color: #d71921;
        }

        .top-tab-item.active {
            background: #d71921;
            color: #fff;
            border-color: #d71921;
        }

        /* Card sản phẩm */
        .top-product-card {
            border: 1px solid #f1f1f1;
            border-radius: 8px;
            padding: 10px;
            height: 100%;
            transition: 0.3s;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .top-product-card:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-color: #d71921;
        }

        /* Ảnh và Banner quảng cáo */
        .card-image-wrapper {
            position: relative;
            text-align: center;
            margin-bottom: 10px;
        }

        .card-image-wrapper img {
            max-height: 180px;
            object-fit: contain;
        }

        .promo-banner-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .promo-banner-bottom img {
            width: 100%;
            height: auto;
        }

        /* Thông tin giá và tên */
        .card-name {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            height: 40px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            margin-bottom: 10px;
        }

        .card-price-main {
            color: #d71921;
            font-weight: 800;
            font-size: 17px;
            margin-bottom: 4px;
        }

        .card-price-sub {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .old-price {
            color: #888;
            text-decoration: line-through;
            font-size: 13px;
        }

        .sale-percent {
            background: #d71921;
            color: #fff;
            font-size: 11px;
            font-weight: bold;
            padding: 1px 5px;
            border-radius: 4px;
        }

        /* Responsive cho mobile */
        @media (max-width: 768px) {
            .header-title {
                font-size: 18px;
            }

            .top-product-card {
                padding: 5px;
            }

            .card-price-main {
                font-size: 15px;
            }
        }

        /* 1. Bọc toàn bộ container */

        @keyframes shimmerHeader {
            to {
                background-position: 200% center;
            }
        }

        .header-title {
            color: #fff;
            font-weight: 800;
            font-size: 26px;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .top-selling-body {
            padding: 20px;
        }


        /* 5. Ảnh: Zoom + Vệt sáng Shine */
        .card-image-wrapper {
            position: relative;
            text-align: center;
            margin-bottom: 15px;
            overflow: hidden;
            /* Để không tràn ảnh khi zoom */
            border-radius: 8px;
        }

        .card-image-wrapper img.img-fluid {
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            max-height: 180px;
            min-height: 180px !important;
        }

        /* Hiệu ứng vệt sáng */
        .card-image-wrapper::after {
            content: '';
            position: absolute;
            top: 0;
            left: -150%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0) 100%);
            transform: skewX(-20deg);
            transition: 0.6s;
        }

        .top-product-card:hover .card-image-wrapper img.img-fluid {
            transform: scale(1.1);
            /* Zoom ảnh nhẹ */
        }

        .top-product-card:hover .card-image-wrapper::after {
            left: 150%;
            /* Vệt sáng chạy qua */
        }

        /* Banner "Big Bang" nảy nhẹ */
        .promo-banner-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 3;
        }

        .top-product-card:hover .promo-banner-bottom {
            animation: pulseBanner 1s infinite alternate;
        }

        @keyframes pulseBanner {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.03);
            }
        }

        /* 6. Text và Giá */
        .card-name {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            height: 40px;
            margin-bottom: 10px;
            transition: color 0.3s;
        }

        .top-product-card:hover .card-name {
            color: #d71921;
            /* Đổi màu tên khi hover card */
        }

        .card-price-main {
            color: #d71921;
            font-weight: 800;
            font-size: 18px;
            margin-bottom: 5px;
            transition: transform 0.3s;
        }

        .top-product-card:hover .card-price-main {
            transform: scale(1.05);
            /* Giá to nhẹ khi hover */
            transform-origin: left;
        }

        .sale-percent {
            background: linear-gradient(135deg, #d71921 0%, #f39c12 100%);
            border-radius: 4px 10px 4px 10px;
            /* Kiểu cắt góc xéo */
        }

        /* Mobile mượt hơn */
        @media (max-width: 768px) {
            .top-selling-container {
                border-radius: 0;
                border: none;
            }

            .top-product-card:hover {
                transform: translateY(-3px);
            }
        }
    </style>
@endpush
