<section class="hot-sale-wrapper">
    <div class="container">
        <div class="hot-sale-box">
            <!-- Header tiêu đề -->
            <div class="hot-sale-header text-center">
                <h2 class="title">
                    <i class="fas fa-fire-alt"></i> SẢN PHẨM <span>NỔI BẬT</span>
                </h2>
            </div>

            <!-- Danh sách sản phẩm -->
            <div class="product-slider-container swiper product-swiper">
                <!-- Nút điều hướng -->
                <button class="slider-nav prev"><i class="fas fa-chevron-left"></i></button>

                <div class="product-grid swiper-wrapper">
                    @foreach ($featuredPhones as $phone)
                        @php
                            // Lấy biến thể đầu tiên (đã được sắp xếp theo giá thấp nhất ở controller)
                            $defaultVariant = $phone->variants->first();
                            // Lấy giá
                            $price = $defaultVariant ? $defaultVariant->price : 0;
                            // Giả định giá cũ bằng giá hiện tại + 20% (vì DB bạn chưa có giá cũ)
                            $oldPrice = $price * 1.2; 
                        @endphp

                        <div class="product-items swiper-slide">
                            <div class="badge-container">
                                <span class="badge-sale">Giảm 20%</span>
                                <span class="badge-installment">Trả góp 0%</span>
                            </div>

                            <a href="{{ route('phone.detail', $phone->slug) }}" class="product-img">
                                <img src="{{ asset('storage/' . $phone->main_image) }}"
                                    alt="{{ $phone->name }}"
                                    onerror="this.src='#'">
                            </a>

                            <div class="product-info">
                                <h3 class="product-name">
                                    <a href="{{ route('phone.detail', $phone->slug) }}">
                                        {{ $phone->name }} 
                                        {{ $defaultVariant && $defaultVariant->size ? ' ' . $defaultVariant->size->name : '' }}
                                    </a>
                                </h3>
                                <div class="price-group">
                                    <span class="price-now">{{ number_format($price, 0, ',', '.') }} won</span>
                                    <span class="price-old">{{ number_format($oldPrice, 0, ',', '.') }} won</span>
                                </div>
                                <div class="product-footer">
                                    <!-- Phần rating bạn có thể làm động sau nếu có bảng reviews -->
                                    <span class="rating"><i class="fas fa-star"></i> 5.0</span>
                                    <button class="btn-favorite" data-id="{{ $phone->id }}">
                                        <i class="far fa-heart"></i> Yêu thích
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="slider-nav next"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
</section>
@push('styles')
    <style>
        /* Màu nền chủ đạo */
        .hot-sale-box {
            background: linear-gradient(180deg, #1E293C 0%, #be5466 100%);
            border-radius: 15px;
            padding: 20px 10px;
            position: relative;
            /* margin-top: 30px; */
        }

        /* Tiêu đề Sản Phẩm Nổi Bật */
        .hot-sale-header .title {
            color: #fff;
            font-weight: 800;
            font-size: 28px;
            text-transform: uppercase;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .hot-sale-header .title span {
            color: #fff;
            /* Hiệu ứng viền chữ nếu muốn giống ảnh */
            text-shadow: 1px 1px 0px rgba(0, 0, 0, 0.1);
        }

        .hot-sale-header .title i {
            color: #fff;
        }

        /* Container cho Grid */
        .product-slider-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .product-grid {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            scrollbar-width: none;
            /* Ẩn scrollbar Firefox */
            padding: 10px 5px;
        }

        .product-grid::-webkit-scrollbar {
            display: none;
        }

        /* Ẩn scrollbar Chrome */

        /* Thẻ sản phẩm trắng */
        .product-items {
            background: #fff;
            border-radius: 12px;
            min-width: 215px;
            flex: 0 0 auto;
            padding: 12px;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s;
        }

        .product-items:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Nhãn Giảm giá & Trả góp */
        .badge-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .badge-sale {
            background: #d71921;
            color: #fff;
            font-size: 11px;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .badge-installment {
            background: #eef5ff;
            color: #0065ff;
            font-size: 11px;
            border-radius: 4px;
            padding: 2px 6px;
            border: 1px solid #cce2ff;
        }

        /* Ảnh sản phẩm */
        /* 1. Sửa lại container ảnh để cắt phần dư khi phóng to */
        .product-img {
            display: block;
            text-align: center;
            margin-bottom: 10px;
            overflow: hidden;
            /* Quan trọng: Để ảnh không tràn ra ngoài khi zoom */
            border-radius: 8px;
            position: relative;
            /* Để làm lớp vệt sáng */
        }

        /* 2. Cấu hình ảnh ban đầu */
        .product-img img {
            max-width: 100%;
            height: 160px;
            object-fit: contain;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            /* Chuyển động mượt */
            filter: brightness(1);
        }

        /* 3. Hiệu ứng vệt sáng lướt qua (Shine) */
        .product-img::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right,
                    rgba(255, 255, 255, 0) 0%,
                    rgba(255, 255, 255, 0.3) 100%);
            transform: skewX(-25deg);
            transition: none;
        }

        /* 4. Hiệu ứng khi di chuột vào Thẻ sản phẩm */
        .product-items:hover .product-img img {
            transform: scale(1.1);
            /* Phóng to ảnh 10% */
            filter: brightness(1.1);
            /* Làm ảnh sáng hơn chút */
        }

        .product-items:hover .product-img::after {
            left: 150%;
            transition: all 0.7s;
            /* Vệt sáng chạy qua trong 0.7 giây */
        }

        /* 5. Thêm một chút đổ bóng nhẹ cho ảnh khi hover */
        .product-items:hover .product-img {
            filter: drop-shadow(0 10px 10px rgba(0, 0, 0, 0.1));
        }

        /* Thông tin chữ */
        .product-name a {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            text-decoration: none;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 40px;
        }

        .price-group {
            margin: 10px 0;
        }

        .price-now {
            color: #d71921;
            font-weight: 800;
            font-size: 16px;
            display: block;
        }

        .price-old {
            color: #888;
            text-decoration: line-through;
            font-size: 12px;
        }

        /* Footer thẻ: Sao & Yêu thích */
        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .rating {
            font-size: 13px;
            font-weight: bold;
            color: #444;
        }

        .rating i {
            color: #ffbf00;
        }

        .btn-favorite {
            background: none;
            border: none;
            color: #2b80ff;
            font-size: 13px;
            cursor: pointer;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Nút điều hướng Slider */
        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #fff;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            z-index: 5;
            cursor: pointer;
        }

        .slider-nav.prev {
            left: -17px;
        }

        .slider-nav.next {
            right: -17px;
        }

        /* Ghi đè lại các thuộc tính Flexbox cũ để Swiper quản lý */
        .product-grid.swiper-wrapper {
            display: flex;
            overflow: visible;
            /* Swiper cần overflow visible để slide hoạt động */
            gap: 0;
            /* Dùng spaceBetween trong JS thay vì gap */
        }

        .product-items.swiper-slide {
            min-width: unset;
            /* Bỏ min-width cũ để Swiper tự tính toán */
            height: auto;
            /* Để các card cao bằng nhau */
        }

        /* Ẩn nút điều hướng khi hết slide */
        .slider-nav.swiper-button-disabled {
            opacity: 0.3;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>
@endpush
