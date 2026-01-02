@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">

            <!-- Danh sách gói cước -->
            <div class="col-md-9">
                <div class="spc-section-container">
                    <div class="spc-section-header">
                        <h2 class="spc-main-title">{{ $currentCategory->name }}</h2>
                        <div class="spc-title-underline"></div>
                    </div>

                    <div class="spc-pagination-outer">
                        <div class="row" id="spc-list-track">
                            @foreach ($packages as $package)
                                <div class="col-md-4 mb-4"> {{-- Thêm grid để chia cột --}}
                                    <div class="spc-card-container">
                                        <!-- Header -->
                                        <div class="spc-card-head">
                                            <h3 class="spc-product-title">{{ $package->name }}</h3>
                                            <div class="spc-meta-row">
                                                <div class="spc-rating-box">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="fa-solid fa-star"></i>
                                                    @endfor
                                                    <span class="spc-rating-text">(12)</span>
                                                </div>
                                                <button class="spc-heart-btn"><i class="fa-regular fa-heart"></i></button>
                                            </div>
                                        </div>

                                        <div class="spc-card-body">
                                            <div class="spc-price-wrapper">
                                                <span class="spc-price-num">
                                                    {{ number_format($package->price) }}
                                                    <span class="spc-unit">đ</span>
                                                </span>
                                                <span class="spc-period">/ {{ $package->duration_days }} ngày</span>
                                            </div>

                                            <div class="spc-highlight-list">
                                                @if (!empty($package->specifications))
                                                    @foreach (array_slice($package->specifications, 0, 2) as $spec)
                                                        <div class="spc-highlight-item">
                                                            <i
                                                                class="fa-solid {{ $loop->first ? 'fa-bolt' : 'fa-phone' }}"></i>
                                                            <span>{{ $spec }}</span>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>

                                            <div class="spc-spec-column">
                                                <div class="spc-spec-entry">
                                                    <span class="spc-spec-key"><i class="fa-solid fa-tower-cell"></i> Nhà
                                                        mạng:</span>
                                                    <span
                                                        class="spc-spec-val spc-brand-color">{{ strtoupper($package->carrier) }}</span>
                                                </div>
                                                <div class="spc-spec-entry">
                                                    <span class="spc-spec-key"><i class="fa-solid fa-sim-card"></i> Loại
                                                        SIM:</span>
                                                    <span class="spc-spec-val">
                                                        {{ $package->sim_type == 'hop_phap' ? 'Hợp pháp' : 'Khác' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="spc-card-foot">
                                            <a href="https://m.me/yourpage" target="_blank" class="spc-btn-buy">
                                                <i class="fa-brands fa-facebook-messenger"></i> MUA NGAY
                                            </a>
                                            <a href="{{ url('chi-tiet-goi/' . $package->slug) }}" class="spc-btn-detail">CHI
                                                TIẾT</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('packages.lib')