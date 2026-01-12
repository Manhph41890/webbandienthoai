@extends('layouts.app')

@section('content')
    <div class="m-spc-container">
        <!-- Header Section -->
        <div class="m-spc-header">
            <h2 class="m-spc-title">{{ $currentCategory->name }}</h2>
            <div class="m-spc-divider"></div>
        </div>

        <!-- Package List -->
        <div class="m-spc-list" id="spc-list-track">
            @foreach ($packages as $package)
                <div class="m-spc-card">
                    <!-- Heart Button (Top Right) -->
                    <button class="m-spc-heart spc-heart-btn {{ $package->isFavorited() ? 'active' : '' }}" data-id="{{ $package->id }}"
                        data-type="package">
                        <i class="{{ $package->isFavorited() ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                    </button>

                    <div class="m-spc-card-body">
                        <!-- Package Name & Rating -->
                        <div class="m-spc-top-row">
                            <h3 class="m-spc-package-name">{{ $package->name }}</h3>
                            <div class="m-spc-rating">
                                <i class="fa-solid fa-star"></i>
                                <span>(99+)</span>
                            </div>
                        </div>

                        <!-- Price & Duration -->
                        <div class="m-spc-price-box">
                            <div class="m-spc-price-val">
                                {{ number_format($package->price) }}<span class="m-spc-currency">w</span>
                            </div>
                            <div class="m-spc-duration">/ {{ $package->duration_days }} ngày</div>
                        </div>

                        <!-- Highlights (Badges) -->
                        <div class="m-spc-tags">
                            @if (!empty($package->specifications))
                                @foreach (array_slice($package->specifications, 0, 2) as $spec)
                                    <span class="m-spc-tag">
                                        <i class="fa-solid {{ $loop->first ? 'fa-bolt' : 'fa-phone' }}"></i>
                                        {{ $spec }}
                                    </span>
                                @endforeach
                            @endif
                        </div>

                        <!-- Technical Specs -->
                        <div class="m-spc-meta">
                            <div class="m-spc-meta-item">
                                <span class="label"><i class="fa-solid fa-tower-cell"></i> Nhà mạng:</span>
                                <span class="value brand">{{ strtoupper($package->carrier) }}</span>
                            </div>
                            <div class="m-spc-meta-item">
                                <span class="label"><i class="fa-solid fa-sim-card"></i> Loại SIM:</span>
                                <span class="value">{{ $package->sim_type == 'hop_phap' ? 'Hợp pháp' : 'Khác' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="m-spc-actions">
                        <button type="button" class="m-btn-primary btn-buy-package" data-name="{{ $package->name }}"
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
@endsection

@include('packages.lib')
@include('packages.buy-mess')
