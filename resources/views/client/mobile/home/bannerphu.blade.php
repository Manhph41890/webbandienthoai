<div class="mid-banner-section mb-4">
    <div class="container">
        <div class="swiper mid-banner-swiper">
            <div class="swiper-wrapper">
                <!-- Banner 1 -->
                <div class="swiper-slide">
                    <a href="#">
                        <img src="{{ asset('images/samsung-ads-t12---a56-a36-615x104.png') }}" alt="Samsung A56 A36" class="w-100">
                    </a>
                </div>
                <!-- Banner 2 -->
                <div class="swiper-slide">
                    <a href="#">
                        <img src="{{ asset('images/samsung-ads-t12---ff7-615x104.png') }}" alt="Samsung FF7" class="w-100">
                    </a>
                </div>
                <!-- Banner 3 -->
                <div class="swiper-slide">
                    <a href="#">
                        <img src="{{ asset('images/samsung-ads-t12---s25-615x104.png') }}" alt="Samsung S25" class="w-100">
                    </a>
                </div>
            </div>

            <!-- Nút điều hướng -->
            <div class="swiper-button-prev mid-banner-prev"></div>
            <div class="swiper-button-next mid-banner-next"></div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .mid-banner-section .mid-banner-swiper {
    border-radius: 8px; /* Bo góc nhẹ cho banner */
    overflow: hidden;
    position: relative;
}

.mid-banner-section img {
    display: block;
    height: auto;
    object-fit: cover;
}

/* Tùy chỉnh nút điều hướng giống ảnh mẫu */
.mid-banner-prev, .mid-banner-next {
    width: 35px !important;
    height: 35px !important;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.mid-banner-prev::after, .mid-banner-next::after {
    font-size: 14px !important; /* Mũi tên nhỏ lại */
    font-weight: bold;
    color: #333;
}

/* Ẩn nút trên Mobile cho đỡ rối, hiện trên Desktop */
@media (max-width: 768px) {
    .mid-banner-prev, .mid-banner-next {
        display: none;
    }
}
</style>
@endpush