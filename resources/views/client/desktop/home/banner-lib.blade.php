@push('styles')
    <style>
        /* Tùy chỉnh thêm để các nút điều hướng hiển thị đẹp hơn */
        .x-hero-main-carousel {
            position: relative;
            /* Quan trọng để định vị nút điều hướng */
        }

        .x-hero-prev,
        .x-hero-next {
            color: #fff;
            /* Màu nút */
            background: rgba(0, 0, 0, 0.2);
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .x-hero-prev::after,
        .x-hero-next::after {
            font-size: 18px;
            /* Chỉnh kích thước mũi tên */
        }

        .x-hero-dots .swiper-pagination-bullet-active {
            background: #C10000;
            /* Màu của dấu chấm khi đang hoạt động */
        }

        /* =================================================== x-hero-section =============================================== */

        /* Container chung */
        .x-hero-container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .x-hero-section-wrapper {
            padding: 20px 0;
            background-color: #fff;
        }

        /* Layout Banner Top */
        .x-hero-top-layout {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .x-hero-main-carousel {
            flex: 3;
            /* Chiếm 75% */
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .x-hero-main-carousel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .x-hero-static-aside {
            flex: 1;
            /* Chiếm 25% */
        }

        .x-hero-static-aside img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Container chính */
        .x-hero-static-aside {
            height: 100%;
            perspective: 1000px;
        }

        .x-aside-premium {
            position: relative;
            display: block;
            width: 100%;
            height: 100%;
            background: #000;
            /* Nền đen để nổi bật màu cam */
            border-radius: 5px;
            overflow: hidden;
            text-decoration: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .x-aside-premium1 {
            position: relative;
            display: block;
            width: 100%;
            height: 100%;
            /* Nền đen để nổi bật màu cam */
            border-radius: 5px;
            overflow: hidden;
            text-decoration: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }


        /* 1. Lớp chữ nền (Watermark) */
        .x-aside-bg-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-90deg);
            font-size: 100px;
            font-weight: 900;
            color: transparent;
            -webkit-text-stroke: 1px rgba(255, 255, 255, 0.15);
            /* Chữ rỗng chân */
            z-index: 1;
            white-space: nowrap;
            pointer-events: none;
            transition: 0.5s;
        }

        /* 2. Hiệu ứng ảnh */
        .x-aside-img-box {
            width: 100%;
            height: 100%;
            z-index: 2;
            position: relative;
        }

        .x-aside-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.2, 1, 0.3, 1);
        }

        /* 3. Hiệu ứng ánh sáng lướt qua (Glint) */
        .x-aside-glint {
            position: absolute;
            top: 0;
            left: -150%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg,
                    transparent,
                    rgba(255, 255, 255, 0.3),
                    transparent);
            transition: 0.6s;
            z-index: 3;
        }

        /* 4. Lớp phủ thông tin (Glassmorphism) */
        .x-aside-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 30px 20px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            z-index: 4;
            transform: translateY(20px);
            opacity: 0;
            transition: 0.4s;
        }

        .x-aside-info h3 {
            color: #ff9f43;
            /* Màu cam ton-sur-ton với ảnh */
            font-weight: 800;
            margin: 5px 0;
            font-size: 20px;
        }

        .x-aside-info p {
            color: #ddd;
            font-size: 13px;
            margin: 0;
        }

        .badge-new {
            background: #ff4d6d;
            color: #fff;
            font-size: 10px;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: bold;
        }

        /* --- HIỆU ỨNG KHI HOVER --- */

        .x-aside-premium:hover .x-aside-glint {
            left: 150%;
            /* Ánh sáng lướt qua */
        }

        .x-aside-premium:hover .x-aside-bg-text {
            letter-spacing: 15px;
            /* Chữ nền giãn ra */
            opacity: 0.3;
        }

        .x-aside-premium:hover .x-aside-overlay {
            transform: translateY(0);
            opacity: 1;
        }

        /* Đổ bóng rực rỡ màu cam khi hover */
        .x-aside-premium:hover {
            box-shadow: 0 20px 40px rgba(255, 159, 67, 0.3);
        }


        .x-aside-premium1:hover .x-aside-glint {
            left: 150%;
            /* Ánh sáng lướt qua */
        }

        .x-aside-premium1:hover .x-aside-bg-text {
            letter-spacing: 15px;
            /* Chữ nền giãn ra */
            opacity: 0.3;
        }

        .x-aside-premium1:hover .x-aside-overlay {
            transform: translateY(0);
            opacity: 1;
        }

        /* Đổ bóng rực rỡ màu cam khi hover */
        .x-aside-premium1:hover {
            box-shadow: 0 20px 40px rgba(255, 159, 67, 0.3);
        }

        :root {
            --dx-navy: #140000;
            --dx-red: #ff4d6d;
            --dx-gray: #f4f7fa;
            --dx-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .dx-hot-section {
            padding: 10px 0;
            background-color: #fff;
        }

        .dx-container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Header Section */
        .dx-section-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .dx-section-title {
            font-size: 24px;
            font-weight: 800;
            color: var(--dx-navy);
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .dx-title-line {
            width: 60px;
            height: 4px;
            background: var(--dx-red);
            margin: 0 auto;
            border-radius: 10px;
        }

        /* Grid Layout */
        .dx-hot-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        /* Card Design */
        .dx-hot-card {
            position: relative;
            background: #fff;
            border-radius: 10px;
            padding: 25px;
            border: 1px solid #f0f0f0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .dx-hot-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
            border-color: transparent;
        }

        /* Badge HOT */
        .dx-card-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--dx-red);
            color: #fff;
            padding: 4px 12px;
            font-size: 11px;
            font-weight: 800;
            border-radius: 20px;
            z-index: 2;
            box-shadow: 0 4px 10px rgba(255, 77, 109, 0.3);
        }

        /* Inner Layout */
        .dx-card-inner {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .dx-card-thumb {
            flex: 1;
            transition: transform 0.4s ease;
        }

        .dx-hot-card:hover .dx-card-thumb {
            transform: scale(1.08) rotate(-5deg);
        }

        .dx-card-thumb img {
            max-width: 100%;
            height: auto;
            object-fit: contain;
        }

        /* Description */
        .dx-card-desc {
            flex: 1;
        }

        .dx-item-title {
            display: block;
            text-decoration: none;
            font-size: 18px;
            font-weight: 600;
            color: #333;
            line-height: 1.3;
            margin-bottom: 10px;
            transition: color 0.3s;
        }

        .dx-item-title span {
            display: block;
            font-weight: 800;
            color: var(--dx-navy);
        }

        .dx-hot-card:hover .dx-item-title {
            color: var(--dx-red);
        }

        .dx-item-price {
            font-size: 20px;
            font-weight: 800;
            color: var(--dx-red);
            margin-bottom: 15px;
        }

        .dx-item-price span {
            font-size: 12px;
            font-weight: 400;
            color: #888;
            text-transform: uppercase;
        }

        /* Button View */
        .dx-btn-view {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            color: var(--dx-navy);
            transition: all 0.3s;
            opacity: 0;
            transform: translateX(-10px);
        }

        .dx-hot-card:hover .dx-btn-view {
            opacity: 1;
            transform: translateX(0);
        }

        .dx-btn-view:hover {
            color: var(--dx-red);
        }

        .dx-btn-view i {
            font-size: 12px;
        }

        /* Layout Hot Products Grid */
    </style>
@endpush
