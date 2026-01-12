<section class="samsung-section product-pagination-section">
    <div class="container">
        <div class="ss-content-wrapper shadow-sm">
            <!-- Header Samsung Style -->
            <div class="ss-header d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-4">
                <div class="ss-title-group">
                    <h2 class="ss-title">SAMSUNG GALAXY</h2>
                    <p class="ss-subtitle">Trải nghiệm công nghệ đỉnh cao</p>
                </div>

                <div class="ss-category-tabs">
                    <a href="#" class="ss-tab-item active">Tất cả</a>
                    @foreach ($categories_samsung as $cat)
                        <a href="{{ route('category.show', $cat->slug) }}"
                            class="ss-tab-item {{ request()->is('category/' . $cat->slug) ? 'active' : '' }}"
                            data-filter="cat-{{ $cat->id }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Danh sách sản phẩm Samsung -->
            <div class="row g-4 product-list">
                @foreach ($samsungs as $samsung)
                    <div class="col-6 col-md-4 col-lg-3 product-item">
                        <div class="product-card">
                            {{-- Hiển thị badge 'Mới' nếu sản phẩm mới đăng trong vòng 7 ngày --}}
                            @if ($samsung->created_at >= now()->subDays(7))
                            @endif

                            <div class="product-badge">
                                <button class="spc-heart-btn {{ $samsung->isFavorited() ? 'active' : '' }}"
                                    data-id="{{ $samsung->id }}" data-type="phone">
                                    <i class="{{ $samsung->isFavorited() ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                </button>
                            </div>

                            <div class="product-image">
                                <a href="{{ route('phone.detail', $samsung->slug) }}">
                                    <img src="{{ asset('storage/' . $samsung->main_image) }}" alt="{{ $samsung->name }}"
                                        onerror="this.src=#">
                                </a>
                            </div>

                            <div class="ss-info">
                                {{-- Hiển thị tên danh mục --}}
                                <div class="ss-tag">{{ $samsung->category->name ?? 'Samsung Galaxy' }}</div>

                                <h3 class="ss-name">
                                    <a href="{{ route('phone.detail', $samsung->slug) }}"
                                        style="text-decoration: none; color: inherit;">
                                        {{ $samsung->name }}
                                    </a>
                                </h3>

                                <div class="ss-price">
                                    @if ($samsung->variants->isNotEmpty())
                                        {{ number_format($samsung->variants->first()->price, 0, ',', '.') }}
                                        <span class="ss-currency">won</span>
                                    @else
                                        Liên hệ
                                    @endif
                                </div>

                                <div class="ss-rating">
                                    <div class="stars">
                                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i>
                                    </div>
                                    <span class="count">(99+)</span>
                                </div>

                                <div class="product-actions">
                                    <a href="{{ route('phone.detail', $samsung->slug) }}" target="_blank"
                                        class="btn-messenger">
                                        <i class="fa-brands fa-facebook-messenger"></i> MUA NGAY
                                    </a>
                                    <a href="{{ route('phone.detail', $samsung->slug) }}" class="btn-detail">CHI
                                        TIẾT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination-wrapper d-flex justify-content-center mt-5">
                <nav>
                    <ul class="pagination custom-pagination"></ul>
                </nav>
            </div>
        </div>
    </div>
</section>

@include('client.desktop.home.list-products')
