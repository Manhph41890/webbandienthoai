@extends('client.desktop.layouts.app')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Danh sách yêu thích của bạn</h3>
            <span class="badge bg-danger rounded-pill">{{ $items->count() }} sản phẩm</span>
        </div>

        @if ($items->isEmpty())
            <div class="text-center py-5 shadow-sm bg-white rounded-3">
                <img src="https://cdn-icons-png.flaticon.com/512/10542/10542152.png" width="100" class="mb-3"
                    alt="Empty">
                <p class="text-muted">Danh sách yêu thích đang trống.</p>
                <a href="/" class="btn btn-primary px-4">Tiếp tục khám phá</a>
            </div>
        @else
            {{-- LỌC DỮ LIỆU --}}
            @php
                // Lọc ra các sản phẩm là Điện thoại (Phone)
                $phones = $items->filter(function ($item) {
                    return $item instanceof \App\Models\Phone;
                });

                // Lọc ra các sản phẩm là Gói cước (Package)
                $packages = $items->filter(function ($item) {
                    return $item instanceof \App\Models\Package;
                });
            @endphp

            {{-- PHẦN 1: THIẾT BỊ ĐIỆN THOẠI --}}
            @if ($phones->isNotEmpty())
                <div class="wishlist-section mb-5">
                    <h4 class="section-title mb-3"><i class="fa-solid fa-mobile-screen-button me-2"></i> Điện thoại </h4>
                    <div class="row g-3">
                        @foreach ($phones as $item)
                            <div class="col-md-3 product-item">
                                <div class="card h-100 border-0 shadow-sm position-relative">
                                    {{-- Nút xóa nhanh --}}
                                    <button class="btn-favorite btn-remove" data-id="{{ $item->id }}" data-type="phone">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </button>
                                    <a href="{{ route('phone.detail', $item->slug) }}">
                                        <img src="{{ asset('storage/' . $item->main_image) }}" class="card-img p-3"
                                            alt="{{ $item->name }}" style="object-fit: contain; height: 200px;"></a>

                                    <div class="card-body">
                                        <h6 class="card-title fw-bold text-truncate">{{ $item->name }}</h6>
                                        <p class="text-danger fw-bold mb-3">
                                            {{ number_format($item->variants->first()->price ?? 0) }} WON</p>

                                        <a href="https://m.me/YOUR_PAGE_ID?text={{ urlencode('Tôi quan tâm đến điện thoại: ' . $item->name) }}"
                                            class="btn btn-outline-primary w-100 btn-sm rounded-pill">
                                            <i class="fab fa-facebook-messenger me-1"></i> Tư vấn máy
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- PHẦN 2: GÓI CƯỚC DI ĐỘNG --}}
            @if ($packages->isNotEmpty())
                <div class="wishlist-section mt-5">
                    <h4 class="section-title mb-3"><i class="fa-solid fa-sim-card me-2"></i> Gói cước</h4>
                    <div class="row g-3">
                        @foreach ($packages as $item)
                            <div class="col-md-4 product-item">
                                <div class="card h-100 border-0 shadow-sm bg-light-blue position-relative overflow-hidden">
                                    {{-- Nút xóa nhanh --}}
                                    <button class="btn-favorite btn-remove" data-id="{{ $item->id }}"
                                        data-type="package">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </button>

                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex-shrink-0 bg-white p-2 rounded-3 shadow-sm">
                                            <i class="fa-solid fa-wifi text-primary fa-2x"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0 fw-bold">{{ $item->name }}</h6>
                                            <small class="text-muted">{{ $item->network ?? 'Tất cả nhà mạng' }}</small>
                                            <div class="text-primary fw-bold">{{ number_format($item->price) }} WON/Tháng
                                            </div>
                                        </div>
                                        <a href="https://m.me/YOUR_PAGE_ID?text={{ urlencode('Tôi muốn đăng ký gói cước: ' . $item->name) }}"
                                            class="btn btn-primary btn-sm rounded-circle shadow">
                                            <i class="fab fa-facebook-messenger"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        @endif
    </div>

    <style>
        .bg-light-blue {
            background-color: #f0f7ff;
            border: 1px solid #d0e8ff;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #333;
            border-left: 4px solid #d70018;
            padding-left: 15px;
        }

        .btn-remove {
            position: absolute;
            top: 8px;
            right: 8px;
            background: transparent;
            border: none;
            color: #ccc;
            font-size: 20px;
            z-index: 10;
            transition: color 0.3s;
        }

        .btn-remove:hover {
            color: #ff4757;
        }

        .product-item .card {
            transition: transform 0.3s;
        }

        .product-item .card:hover {
            transform: translateY(-5px);
        }
    </style>
@endsection
