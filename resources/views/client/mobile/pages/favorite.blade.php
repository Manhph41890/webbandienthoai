@extends('client.mobile.layouts.app')

@section('content')
    <div class="wl-mobile-wrapper">
        <!-- Header Section -->
        <div class="wl-header">
            <div class="wl-header-title">
                <h3>Danh sách yêu thích</h3>
                <span class="wl-count-badge">{{ $items->count() }} mục</span>
            </div>
        </div>

        @if ($items->isEmpty())
            <!-- Empty State chuyên nghiệp -->
            <div class="wl-empty-state" style="{{ $items->isEmpty() ? 'display:block' : 'display:none' }}">
                <div class="wl-empty-icon">
                    <i class="fa-regular fa-heart"></i>
                </div>
                <h4>Chưa có mục yêu thích</h4>
                <p>Hãy thả tim những sản phẩm bạn ưng ý để xem lại sau nhé!</p>
                <a href="/" class="wl-btn-primary">Khám phá ngay</a>
            </div>
        @else
            @php
                $phones = $items->filter(fn($item) => $item instanceof \App\Models\Phone);
                $packages = $items->filter(fn($item) => $item instanceof \App\Models\Package);
            @endphp

            <div class="wl-content">
                {{-- PHẦN 1: ĐIỆN THOẠI (Grid 2 cột) --}}
                @if ($phones->isNotEmpty())
                    <div class="wl-section">
                        <div class="wl-section-header">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                            <span>Điện thoại đã lưu</span>
                        </div>

                        <div class="wl-phone-grid">
                            @foreach ($phones as $item)
                                <div class="wl-phone-card">
                                    <!-- Nút xóa nhanh -->
                                    <button class="wl-remove-btn btn-favorite" data-id="{{ $item->id }}"
                                        data-type="phone">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>

                                    <a href="{{ route('phone.detail', $item->slug) }}" class="wl-card-link">
                                        <div class="wl-card-img">
                                            <img src="{{ asset('storage/' . $item->main_image) }}"
                                                alt="{{ $item->name }}">
                                        </div>
                                        <div class="wl-card-info">
                                            <h4 class="wl-item-name">{{ $item->name }}</h4>
                                            <p class="wl-item-price">
                                                {{ number_format($item->variants->first()->price ?? 0) }} <span>won</span>
                                            </p>
                                        </div>
                                    </a>
                                    <div class="wl-card-footer">
                                        <a href="{{ route('phone.detail', $item->slug) }}" class="wl-btn-detail">Chi
                                            tiết</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- PHẦN 2: GÓI CƯỚC (Dạng List ngang) --}}
                @if ($packages->isNotEmpty())
                    <div class="wl-section mt-4">
                        <div class="wl-section-header">
                            <i class="fa-solid fa-sim-card"></i>
                            <span>Gói cước quan tâm</span>
                        </div>

                        <div class="wl-package-list">
                            @foreach ($packages as $item)
                                <div class="wl-package-item">
                                    <button class="wl-remove-btn btn-favorite" data-id="{{ $item->id }}"
                                        data-type="package">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>

                                    <div class="wl-pkg-icon">
                                        <i class="fa-solid fa-wifi"></i>
                                    </div>

                                    <div class="wl-pkg-info">
                                        <h4 class="wl-pkg-name">{{ $item->name }}</h4>
                                        <p class="wl-pkg-network">{{ $item->network ?? 'Tất cả nhà mạng' }}</p>
                                        <p class="wl-pkg-price">{{ number_format($item->price) }} won/tháng</p>
                                    </div>

                                    <a href="https://m.me/61575141059562?text={{ urlencode('Tôi muốn đăng ký gói cước: ' . $item->name) }}"
                                        class="wl-pkg-chat">
                                        <i class="fa-brands fa-facebook-messenger"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>

    @include('pages.favorite-lib')
@endsection
