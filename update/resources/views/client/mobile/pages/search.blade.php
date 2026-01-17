@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Kết quả tìm kiếm cho: "{{ $keyword }}"</h2>

        <!-- Kết quả Điện thoại -->
        <div class="search-results-section mt-4">
            <h3>Điện thoại ({{ $phones->count() }})</h3>
            <div class="row mt-4">
                @forelse($phones as $phone)
                    <div class="col-6 col-md-4 col-lg-3 product-item mb-4">
                        <div class="product-card">
                            <div class="product-badge">
                                <button class="spc-heart-btn {{ $phone->isFavorited() ? 'active' : '' }}"
                                    data-id="{{ $phone->id }}" data-type="phone">
                                    <i class="{{ $phone->isFavorited() ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                </button>
                            </div>

                            <div class="product-image">
                                <a href={{ route('phone.detail', $phone->slug) }}>
                                    <img src="{{ asset('storage/' . $phone->main_image) }}" alt="{{ $phone->name }}"
                                        onerror="this.src=#">
                                </a>
                            </div>

                            <div class="product-content">
                                {{-- <div class="ss-tag" style="color: #b11c44">{{ $phone->category->name }}</div> --}}
                                <h3 class="ss-name" style="min-height: 45px !important;">
                                    <a href="{{ route('phone.detail', $phone->slug) }}"
                                        style="text-decoration: none; color: inherit; font-size: 18px !important;">
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
                                    <span class="rating-count">(99+)</span>
                                </div>

                                <div class="product-actions">
                                    <a href="{{ route('phone.detail', $phone->slug) }}" target="_blank"
                                        class="btn-messenger">
                                        <i class="fa-brands fa-facebook-messenger"></i> MUA NGAY
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Không tìm thấy điện thoại nào.</p>
                @endforelse
            </div>
        </div>

        <hr>

        <!-- Kết quả Gói cước -->
        <div class="search-results-section mt-4">
            <h3>Gói cước / Sim ({{ $packages->count() }})</h3>
            <div class="row" style="margin:0px 10px !important;">
                @forelse($packages as $package)
                    <div class="hpk-card" style="margin-bottom:10px !important;">
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

                        <div class="hpk-card-foot">
                            <button type="button" class="m-btn-primary btn-buy-package" data-name="{{ $package->name }}"
                                data-price="{{ number_format($package->price) }}w"
                                data-duration="{{ $package->duration_days }}"
                                data-carrier="{{ strtoupper($package->carrier) }}"
                                data-sim="{{ $package->sim_type == 'hop_phap' ? 'Hợp pháp' : 'Khác' }}">
                                <i class="fa-brands fa-facebook-messenger"></i> MUA NGAY
                            </button>
                        </div>
                    </div>

                @empty
                    <p>Không tìm thấy gói cước nào.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
@include('client.mobile.home.outstanding-pr-lib')
@include('client.mobile.home.package-lib')
@include('pages.search-lib')
