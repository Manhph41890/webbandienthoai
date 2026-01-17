<section class="ms-mid-section">
    <div class="ms-mid-container">
        <div class="swiper ms-mid-swiper">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <a href="#" class="ms-banner-link">
                        <img src="{{ asset('images/banner_categori_samsung_2 1.png') }}" alt="Samsung A" class="ms-banner-img">
                    </a>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <a href="#" class="ms-banner-link">
                        <img src="{{ asset('images/banner_categori_samsung_1 1.png') }}" alt="Samsung FF" class="ms-banner-img">
                    </a>
                </div>
                {{-- <!-- Slide 3 -->
                <div class="swiper-slide">
                    <a href="#" class="ms-banner-link">
                        <img src="{{ asset('images/samsung-ads-t12---s25-615x104.png') }}" alt="Samsung S25" class="ms-banner-img">
                    </a>
                </div> --}}
            </div>
            
            <!-- Thanh tiến trình (Progress Bar) siêu mỏng phía dưới -->
            <div class="ms-swiper-progress">
                <div class="ms-progress-inner"></div>
            </div>
        </div>
    </div>
</section>
@include('home.bannerphu-lib')