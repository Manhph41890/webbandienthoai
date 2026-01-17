<div class="hpk-container">
    <div class="hpk-header">
        <h2 class="hpk-title">Gói cước Hot</h2>
        <div class="hpk-underline"></div>
    </div>

    <div class="hpk-slider-viewport">
        <div class="hpk-track" id="hpk-track">
            @foreach ($packages as $package)
                <div class="hpk-card">
                    <!-- Header -->
                    <div class="hpk-card-head">
                        <h3 class="hpk-product-name">{{ $package->name }}</h3>
                        <div class="hpk-meta">
                            <div class="hpk-rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span class="hpk-rating-count">(99+)</span>
                            </div>
                            <button class="spc-heart-btn {{ $package->isFavorited() ? 'active' : '' }}"
                                data-id="{{ $package->id }}" data-type="package">
                                <i class="{{ $package->isFavorited() ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                            </button>
                        </div>
                    </div>

                    <div class="hpk-card-body">
                        <div class="hpk-price-box">
                            <span class="hpk-price-val">
                                {{ number_format($package->price) }}
                                <span class="hpk-currency">w</span>
                            </span>
                            <span class="hpk-duration">/ {{ $package->duration_days }} ngày</span>
                        </div>

                        <div class="hpk-highlights">
                            @if (!empty($package->specifications))
                                @foreach (array_slice($package->specifications, 0, 2) as $spec)
                                    <div class="hpk-feat-item">
                                        <i class="fa-solid {{ $loop->first ? 'fa-bolt' : 'fa-phone' }}"></i>
                                        <span>{{ $spec }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="hpk-specs">
                            <div class="hpk-spec-row">
                                <span class="hpk-label"><i class="fa-solid fa-tower-cell"></i> Nhà mạng:</span>
                                <span class="hpk-value hpk-text-danger">{{ strtoupper($package->carrier) }}</span>
                            </div>
                            <div class="hpk-spec-row">
                                <span class="hpk-label"><i class="fa-solid fa-sim-card"></i> Loại SIM:</span>
                                <span class="hpk-value">
                                    {{ $package->sim_type == 'hop_phap' ? 'Hợp pháp' : 'Khác' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="hpk-card-foot" style="margin-left: 60px;">
                        <button style="background-color: rgb(63, 63, 229); color:white" type="button"
                            class="btn m-btn-primary btn-buy-package" data-name="{{ $package->name }}"
                            data-price="{{ number_format($package->price) }}w"
                            data-duration="{{ $package->duration_days }}"
                            data-carrier="{{ strtoupper($package->carrier) }}"
                            data-sim="{{ $package->sim_type == 'hop_phap' ? 'Hợp pháp' : 'Khác' }}">
                            <i class="fa-brands fa-facebook-messenger"></i> MUA NGAY
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Phân trang -->
    <div class="hpk-dots" id="hpk-dots"></div>
</div>

@include('client.mobile.home.package-lib')
@include('packages.buy-mess')
