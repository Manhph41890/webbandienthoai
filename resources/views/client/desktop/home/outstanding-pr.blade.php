<section class="featured-products">
    <div class="container ">
        <div class="products-content-wrapper ss-content-wrapper shadow-sm"
            style="background-color: #ffffff; border-top: 5px solid #b11c44;">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <div class="ss-header d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-4">
                    <div class="ss-title-group">
                        <h2 class="ss-title mt-2" style="color: #b11c44 !important">IPHONE CHÍNH HÃNG</h2>
                        <p class="ss-subtitle">Trải nghiệm công nghệ đỉnh cao</p>
                    </div>
                </div>

                <div class="category-tabs-wrapper d-flex align-items-center">
                    <button class="nav-tag-btn left"><i class="fa-solid fa-chevron-left"></i></button>
                    <div class="category-tabs" id="category-tabs">
                        <a href="#" class="tab-item active" data-filter="all">Nổi bật</a>

                        @foreach ($categories_iphone as $cat)
                            <a href="#" class="tab-item" data-filter="cat-{{ $cat->id }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                    <button class="nav-tag-btn right"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>

            <!-- Danh sách sản phẩm -->
            <div class="row g-4" id="product-list">
                @foreach ($iphones as $phone)
                    <div class="col-6 col-md-4 col-lg-3 product-item">
                        <div class="product-card">
                            <div class="product-badge">
                                <button class="spc-heart-btn" title="Thêm vào yêu thích">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </div>

                            <div class="product-image">
                                <a href="{{ route('phone.detail', $phone->slug) }}"> {{-- Giả sử bạn có route này --}}
                                    <img src="{{ asset('storage/' . $phone->main_image) }}" alt="{{ $phone->name }}"
                                        onerror="this.src=#">
                                </a>
                            </div>

                            <div class="product-content">
                                <div class="ss-tag" style="color: #b11c44">{{ $phone->category->name }}</div>
                                <h3 class="ss-name">
                                    <a href="{{ route('phone.detail', $phone->slug) }}" style="text-decoration: none; color: inherit;">
                                        {{ $phone->name }}
                                    </a>
                                </h3>

                                <div class="product-price">
                                    {{-- Lấy giá của biến thể đầu tiên (vì đã sắp xếp asc trong controller) --}}
                                    @if ($phone->variants->isNotEmpty())
                                        {{ number_format($phone->variants->first()->price, 0, ',', '.') }}
                                        <span class="currency">won</span>
                                    @else
                                        Liên hệ
                                    @endif
                                </div>

                                <div class="product-rating">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <span class="rating-count">(12)</span>
                                </div>

                                <div class="product-actions">
                                    <a href="{{ route('phone.detail', $phone->slug) }}" target="_blank" class="btn-messenger">
                                        <i class="fa-brands fa-facebook-messenger"></i> MUA NGAY
                                    </a>
                                    <a href="{{ route('phone.detail', $phone->slug) }}" class="btn-detail">CHI TIẾT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination-wrapper d-flex justify-content-center mt-5">
                <nav>
                    <ul class="pagination custom-pagination" id="pagination">
                        <!-- JS sẽ tự đổ nút vào đây -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

@include('client.desktop.home.outstanding-pr-lib')
