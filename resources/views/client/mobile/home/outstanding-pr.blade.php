<div class="hpkg-wrapper">
    <div class="hpkg-container">
        <div class="hpkg-head-group">
            <h2 class="hpkg-main-title">Gói cước Hot</h2>
            <div class="hpkg-title-divider"></div>
        </div>

        <div class="hpkg-slider-outer">
            <div class="hpkg-track-list mb-5" id="hpkg-track-list">
                @foreach ($packages as $package)
                    <div class="hpkg-card-item">
                        <!-- Header: Tên và Nút yêu thích -->
                        <div class="hpkg-card-top">
                            <h3 class="hpkg-package-name">{{ $package->name }}</h3>
                            <div class="hpkg-meta-flex">
                                <div class="hpkg-rating-stars">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <span class="hpkg-rating-count">(12)</span>
                                </div>
                                <button class="hpkg-btn-wishlist" title="Thêm vào yêu thích">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </div>
                        </div>

                        <div class="hpkg-card-mid">
                            <!-- Thông tin giá -->
                            <div class="hpkg-price-area">
                                <span class="hpkg-price-val">
                                    {{ number_format($package->price) }}
                                    <span class="hpkg-currency">w</span>
                                </span>
                                <span class="hpkg-duration">/ {{ $package->duration_days }} ngày</span>
                            </div>

                            <!-- Danh sách nổi bật -->
                            <div class="hpkg-tags-list">
                                @if (!empty($package->specifications))
                                    @foreach (array_slice($package->specifications, 0, 2) as $key => $spec)
                                        <div class="hpkg-tag-item">
                                            <i class="fa-solid {{ $loop->first ? 'fa-bolt' : 'fa-phone' }}"></i>
                                            <span>{{ $spec }}</span>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Chi tiết thông số -->
                            <div class="hpkg-specs-grid">
                                <div class="hpkg-spec-row">
                                    <span class="hpkg-spec-label"><i class="fa-solid fa-tower-cell"></i> Nhà mạng:</span>
                                    <span class="hpkg-spec-value hpkg-text-red">{{ strtoupper($package->carrier) }}</span>
                                </div>
                                <div class="hpkg-spec-row">
                                    <span class="hpkg-spec-label"><i class="fa-solid fa-sim-card"></i> Loại SIM:</span>
                                    <span class="hpkg-spec-value">
                                        {{ $package->sim_type == 'hop_phap' ? 'Hợp pháp' : 'Khác' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Nút hành động -->
                        <div class="hpkg-card-bot">
                            <a href="https://m.me/yourpage" target="_blank" class="hpkg-btn-action hpkg-btn-buy">
                                <i class="fa-brands fa-facebook-messenger"></i> MUA NGAY
                            </a>
                            <a href="#" class="hpkg-btn-action hpkg-btn-info">CHI TIẾT</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Thanh điều hướng --}}
        <div class="hpkg-dots-container" id="hpkg-pagination-dots"></div>
    </div>
</div>

{{-- @include('client.mobile.home.package-lib') --}}