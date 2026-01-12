<section class="mb-hero-wrapper">
    <!-- Slider chính: Full Width để tối đa hình ảnh -->
    <div class="mb-hero-slider">
        <div class="swiper mb-hero-swiper">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <a href="phone/iphone-16-pro-max">
                        <img src="{{ asset('images/banner_1mb.png') }}" alt="Sale 1" class="mb-hero-img">
                    </a>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <a href="phone/samsung-galaxy-s24-ultra">
                        <img src="{{ asset('images/banner_2mb.png') }}" alt="Sale 2" class="mb-hero-img">
                    </a>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <a href="phone/samsung-galaxy-z-flip-6">
                        <img src="{{ asset('images/banner_3mb.png') }}" alt="Sale 3" class="mb-hero-img">
                    </a>
                </div>
            </div>
            <!-- Chỉ để lại Pagination (chấm tròn), bỏ mũi tên cho gọn -->
            <div class="swiper-pagination mb-hero-dots"></div>
        </div>
    </div>

    <!-- Banner phụ: Chuyển thành dạng "Hot Deal" nằm ngang -->
    <div class="mb-hero-promo-container">
        <a href="{{ url('phone/iphone-17-pro-max') }}" class="mb-promo-card">
            <div class="mb-promo-content">
                <span class="mb-promo-label">HOT DEAL</span>
                <p class="mb-promo-title">iPhone 17 Pro Max</p>
                <span class="mb-promo-btn">Xem ngay <i class="fa-solid fa-chevron-right"></i></span>
            </div>
            <div class="mb-promo-image">
                <img src="{{ asset('images/banner_right.png') }}" alt="Promo Right">
            </div>
        </a>
    </div>
</section>
@include('home.banner-lib')