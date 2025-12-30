<!-- Section Banner Category -->
<section class="th-cat-slider-wrapper">
    <div class="th-cat-slider-container">
        <!-- Main Slider -->
        <div class="th-cat-slider-main" id="thCatSlider">
            <div class="th-cat-slider-track">
                <!-- Slide 1 -->
                <div class="th-cat-slider-item">
                    <img src="{{ asset('images/banner_categori_iphones_1.png') }}" alt="iPhone 17 Pro Banner 1">
                </div>
                <!-- Slide 2 -->
                <div class="th-cat-slider-item">
                    <img src="{{ asset('images/banner_categori_iphones_2.png') }}" alt="iPhone 17 Pro Banner 2">
                </div>
            </div>

            <!-- Nút điều hướng -->
            <button class="th-cat-slider-btn th-prev" id="thPrevBtn">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="th-cat-slider-btn th-next" id="thNextBtn">
                <i class="fa-solid fa-chevron-right"></i>
            </button>

            <!-- Chấm chỉ số (Dots) -->
            <div class="th-cat-slider-dots" id="thSliderDots"></div>
        </div>
    </div>
</section>
@include('client.mobile.phones.categories.categori-lib')