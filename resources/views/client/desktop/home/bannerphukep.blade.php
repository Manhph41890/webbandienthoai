<section class="banner-double-wrapper mb-5">
    <div class="container">
        <div class="row g-3">
            {{-- Banner bên trái --}}
            <div class="col-12 col-md-6">
                <div class="swiper banner-sub-swiper shadow-sm">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="#">
                                <img src="{{ asset('images/banner_categori_samsung_1 1.png') }}" alt="Samsung S25 Ultra">
                            </a>
                        </div>
                        {{-- Bạn có thể thêm nhiều slide ảnh khác ở đây để nó tự chạy --}}
                        <div class="swiper-slide">
                            <a href="#">
                                <img src="{{ asset('images/banner_categori_samsung_2 1.png') }}" alt="Galaxy Fold 7">
                            </a>
                        </div>
                    </div>
                    <!-- Nút điều hướng -->
                    <div class="swiper-button-next sub-nav-btn"></div>
                    <div class="swiper-button-prev sub-nav-btn"></div>
                </div>
            </div>

            {{-- Banner bên phải --}}
            <div class="col-12 col-md-6">
                <div class="swiper banner-sub-swiper shadow-sm">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="#">
                                <img src="{{ asset('images/banner_categori_samsung_2 1.png') }}" alt="Galaxy Fold 7">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#">
                                <img src="{{ asset('images/banner_categori_samsung_1 1.png') }}" alt="Samsung S25 Ultra">
                            </a>
                        </div>
                    </div>
                    <!-- Nút điều hướng -->
                    <div class="swiper-button-next sub-nav-btn"></div>
                    <div class="swiper-button-prev sub-nav-btn"></div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')

<style>
    .banner-double-wrapper .container {
        max-width: 1200px;
    }

    .banner-sub-swiper {
        border-radius: 5px;
        overflow: hidden;
        position: relative;
        background: #f0f0f0;
    }

    .banner-sub-swiper img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.5s ease;
    }

    .banner-sub-swiper:hover img {
        transform: scale(1.02); /* Hiệu ứng zoom nhẹ khi di chuột */
    }

    /* Tùy chỉnh nút điều hướng nhỏ giống ảnh mẫu */
    .sub-nav-btn {
        width: 30px !important;
        height: 30px !important;
        background: rgba(255, 255, 255, 0.7);
        border-radius: 50%;
        color: #333 !important;
        transition: all 0.3s;
        opacity: 0; /* Ẩn nút mặc định */
    }

    /* Hiện nút khi di chuột vào banner */
    .banner-sub-swiper:hover .sub-nav-btn {
        opacity: 1;
    }

    .sub-nav-btn::after {
        font-size: 14px !important;
        font-weight: bold;
    }

    .sub-nav-btn:hover {
        background: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    /* Responsive cho mobile */
    @media (max-width: 767px) {
        .sub-nav-btn {
            display: none; /* Mobile thì ẩn nút cho gọn */
        }
    }
</style>
@endpush