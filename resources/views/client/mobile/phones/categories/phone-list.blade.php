@extends('client.mobile.layouts.app')

@section('content')
    <section class="featured-products">
        <div class="container ">

            @if ($isIphone)
                @include('client.mobile.phones.categories.banner-cateip')
            @else
                @include('client.mobile.phones.categories.banner-catess')
            @endif
            <div class="products-content-wrapper ss-content-wrapper shadow-sm"
                style="background-color: #ffffff; border-top: 5px solid #b11c44;">

                @include('phones.lib.phonelist-lib')

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
                                    <a href={{ route('phone.detail', $phone->slug) }}>
                                        <img src="{{ asset('storage/' . $phone->main_image) }}" alt="{{ $phone->name }}"
                                            onerror="this.src=#">
                                    </a>
                                </div>

                                <div class="product-content">
                                    {{-- <div class="ss-tag" style="color: #b11c44">{{ $phone->category->name }}</div> --}}
                                    <h3 class="ss-name" style="min-height: 50px">
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
                                            <i class="fa-brands fa-facebook-messenger"
                                                style="margin-left: 5px !important"></i> MUA NGAY
                                        </a>
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
@endsection

@include('client.mobile.home.outstanding-pr-lib')
@include('client.mobile.home.package-lib')
