<section class="x-hero-section-wrapper mt-3">
    <div class="x-hero-container">
        <!-- Khối Banner Top: Slider + Banner Phụ -->
        <div class="x-hero-top-layout">
            <!-- Slider chính -->
            <div class="x-hero-main-carousel">
                <!-- Slider main container -->
                <div class="swiper x-hero-swiper-init">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <div class="swiper-slide">
                            <a href="phone/iphone-16-pro-max">
                                <img src="{{ asset('images/banner_1.png') }}" alt="Banner 1">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="phone/samsung-galaxy-s24-ultra">
                                <img src="{{ asset('images/banner_2.png') }}" alt="Banner 2">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="phone/samsung-galaxy-z-flip-6">
                                <img src="{{ asset('images/banner_3.png') }}" alt="Banner 3">
                            </a>
                        </div>
                    </div>

                    <!-- Các nút điều hướng -->
                    <div class="swiper-pagination x-hero-dots"></div>
                    <div class="swiper-button-prev x-hero-prev"></div>
                    <div class="swiper-button-next x-hero-next"></div>
                </div>
            </div>

            <!-- Banner phải cố định -->
            <!-- Banner phải cố định (Premium Version) -->
            <div class="x-hero-static-aside">
                <a href="{{ url('phone/iphone-17-pro-max') }}" class="x-aside-premium">
                    <!-- Lớp chữ nền (Watermark) -->
                    <div class="x-aside-bg-text">IPHONE</div>

                    <!-- Khối chứa ảnh -->
                    <div class="x-aside-img-box" style="border-radius: 5px !important;">
                        <img src="{{ asset('images/banner_right.png') }}" alt="iPhone 17 Pro Max"
                            style="border-radius: 5px !important;">
                        <!-- Lớp phủ ánh sáng (Shine Effect) -->
                        <div class="x-aside-glint"></div>
                    </div>

                    <!-- Lớp nội dung bổ trợ (Glassmorphism) -->
                    <div class="x-aside-overlay">
                        <div class="x-aside-info">
                            <span class="badge-new">NEW GENERATION</span>
                            <h3>TITANIUM ORANGE</h3>
                            <p>Khám phá sức mạnh chip A19 Pro</p>
                        </div>
                    </div>
                </a>

                <a href="{{ url('phone/samsung-galaxy-s25-ultra') }}" class="x-aside-premium1">

                    <!-- Khối chứa ảnh -->
                    <div class="x-aside-img-box" style="width: 310px; height: 146px; margin-top: 7px;">
                        <img src="{{ asset('images/maxresdefault 10.png') }}" alt="iPhone 17 Pro Max"
                            style="border-radius: 5px !important;">
                    </div>

                    <!-- Lớp nội dung bổ trợ (Glassmorphism) -->
                    <div class="x-aside-overlay">
                        <div class="x-aside-info">
                            <span class="badge-new">NEW GENERATION</span>
                            <h3>TITANIUM BLACK</h3>
                            <p>Khám phá sức mạnh chip Snapdragon 8 Gen 4</p>
                        </div>
                    </div>
                </a>

            </div>
        </div>

        <section class="dx-hot-section">
            <div class="dx-container">
                <div class="dx-hot-grid">
                    <!-- Sản phẩm 1 -->
                    <div class="dx-hot-card">
                        <div class="dx-card-badge">HOT</div>
                        <div class="dx-card-inner">
                            <div class="dx-card-thumb">
                                <a href="{{ url('/phone/samsung-galaxy-s24-ultra') }}">
                                    <img src="{{ asset('images/s24_ultra.png') }}" alt="S24 Ultra">
                                </a>
                            </div>
                            <div class="dx-card-desc">
                                <a href="{{ url('/phone/samsung-galaxy-s24-ultra') }}" class="dx-item-title">
                                    Galaxy <span>S24 Ultra</span>
                                </a>
                                <p class="dx-item-price">990.000<span>won</span></p>
                                <a href="{{ url('/phone/samsung-galaxy-s24-ultra') }}" class="dx-btn-view">
                                    Chi tiết <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Sản phẩm 2 -->
                    <div class="dx-hot-card">
                        <div class="dx-card-badge">HOT</div>
                        <div class="dx-card-inner">
                            <div class="dx-card-thumb">
                                <a href="{{ url('/phone/iphone-17-pro-max') }}">
                                    <img src="{{ asset('images/iphone_17.png') }}" alt="Iphone 17">
                                </a>
                            </div>
                            <div class="dx-card-desc">
                                <a href="{{ url('/phone/iphone-17-pro-max') }}" class="dx-item-title">
                                    iPhone <span>17 Pro Max</span>
                                </a>
                                <p class="dx-item-price">1.999.000 <span>won</span></p>
                                <a href="{{ url('/phone/iphone-17-pro-max') }}" class="dx-btn-view">
                                    Chi tiết <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Sản phẩm 3 -->
                    <div class="dx-hot-card">
                        <div class="dx-card-badge">HOT</div>
                        <div class="dx-card-inner">
                            <div class="dx-card-thumb">
                                <a href="{{ url('/phone/samsung-galaxy-z-flip-7') }}">
                                    <img src="{{ asset('images/galaxyflip7.png') }}" alt="Z Flip 7">
                                </a>
                            </div>
                            <div class="dx-card-desc">
                                <a href="{{ url('/phone/samsung-galaxy-z-flip-7') }}" class="dx-item-title">
                                    Galaxy <span>Z Flip 7</span>
                                </a>
                                <p class="dx-item-price">1.099.000 <span>won</span></p>
                                <a href="{{ url('/phone/samsung-galaxy-z-flip-7') }}" class="dx-btn-view">
                                    Chi tiết <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
@include('client.desktop.home.banner-lib')
