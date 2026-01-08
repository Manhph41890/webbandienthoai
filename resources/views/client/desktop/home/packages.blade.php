<div class="spc-section-container">
    <div class="spc-section-header">
        <h2 class="spc-main-title">Gói cước Hot</h2>
        <div class="spc-title-underline"></div>
    </div>

    <div class="spc-pagination-outer">
        <div class="spc-list-wrapper mb-5" id="spc-list-track">
            @foreach ($packages as $package)
                <div class="spc-card-container">
                    <!-- Header: Tên và Nút yêu thích -->
                    <div class="spc-card-head">
                        <h3 class="spc-product-title">{{ $package->name }}</h3>
                        <div class="spc-meta-row">
                            <div class="spc-rating-box">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span class="spc-rating-text">(12)</span>
                            </div>
                            <button class="spc-heart-btn" title="Thêm vào yêu thích">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </div>
                    </div>

                    <div class="spc-card-body">
                        <!-- Thông tin giá -->
                        <div class="spc-price-wrapper">
                            <span class="spc-price-num">
                                {{ number_format($package->price) }}
                                <span class="spc-unit">w</span>
                            </span>
                            <span class="spc-period">/ {{ $package->duration_days }} ngày</span>
                        </div>

                        <!-- Danh sách nổi bật (Lấy từ mảng specifications) -->
                        <div class="spc-highlight-list">
                            @if (!empty($package->specifications))
                                {{-- Hiển thị 2 thông số đầu tiên làm highlight --}}
                                @foreach (array_slice($package->specifications, 0, 2) as $key => $spec)
                                    <div class="spc-highlight-item">
                                        <i class="fa-solid {{ $loop->first ? 'fa-bolt' : 'fa-phone' }}"></i>
                                        <span>{{ $spec }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Chi tiết thông số -->
                        <div class="spc-spec-column">
                            <div class="spc-spec-entry">
                                <span class="spc-spec-key"><i class="fa-solid fa-tower-cell"></i> Nhà mạng:</span>
                                <span class="spc-spec-val spc-brand-color">{{ strtoupper($package->carrier) }}</span>
                            </div>
                            <div class="spc-spec-entry">
                                <span class="spc-spec-key"><i class="fa-solid fa-sim-card"></i> Loại SIM:</span>
                                <span class="spc-spec-val">
                                    {{ $package->sim_type == 'hop_phap' ? 'Hợp pháp' : 'Khác' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Nút hành động -->
                    <div class="spc-card-foot">
                        <button type="button" class="spc-btn-buy btn-buy-package" data-name="{{ $package->name }}"
                            data-price="{{ number_format($package->price) }}đ"
                            data-duration="{{ $package->duration_days }}"
                            data-carrier="{{ strtoupper($package->carrier) }}"
                            data-sim="{{ $package->sim_type == 'hop_phap' ? 'Hợp pháp' : 'Khác' }}"
                            style="border: 1px solid white !important">
                            <i class="fa-brands fa-facebook-messenger"></i> MUA NGAY
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="spc-pagination-controls" id="spc-pagination-dots"></div>
</div>

@include('client.desktop.home.package-lib')
@include('client.desktop.packages.buy-mess')
