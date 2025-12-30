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

                <!-- Header -->
                <div
                    class="filter-bar d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded shadow-sm">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="fw-bold text-muted"><i class="fa-solid fa-filter"></i> Bộ lọc:</span>

                        <!-- Form này sẽ tự gửi dữ liệu khi thay đổi select -->
                        <form action="{{ url()->current() }}" method="GET" id="filter-form" class="d-flex gap-2">

                            <!-- Sắp xếp theo tiêu chí -->
                            <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất</option>
                                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Xem nhiều nhất
                                </option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá: Thấp
                                    đến Cao</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá: Cao
                                    đến Thấp</option>
                            </select>

                            <!-- Lọc theo giá -->
                            <select name="price_range" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">Tất cả mức giá</option>
                                <option value="under_500" {{ request('price_range') == 'under_500' ? 'selected' : '' }}>Dưới
                                    500k won</option>
                                <option value="500_1000" {{ request('price_range') == '500_1000' ? 'selected' : '' }}>500k -
                                    1 triệu won</option>
                                <option value="over_1000" {{ request('price_range') == 'over_1000' ? 'selected' : '' }}>Trên
                                    1 triệu won</option>
                            </select>

                            @if (request()->has('sort') || request()->has('price_range'))
                                <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-danger">Xóa lọc</a>
                            @endif
                        </form>
                    </div>

                    <div class="result-count text-muted small">
                        Hiển thị {{ $iphones->firstItem() }}-{{ $iphones->lastItem() }} của {{ $iphones->total() }} sản
                        phẩm
                    </div>
                </div>


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
                                            style="text-decoration: none; color: inherit; font-size: 20px !important;">
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
                                        <span class="rating-count">(12)</span>
                                    </div>

                                    <div class="product-actions">
                                        <a href="https://m.me/yourpage" target="_blank" class="btn-messenger">
                                            <i class="fa-brands fa-facebook-messenger"  style="margin-left: 5px !important"></i> MUA NGAY
                                        </a>
                                        <a href={{ route('phone.detail', $phone->slug) }} class="btn-detail" style="padding-left: 15px;">CHI TIẾT</a>
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

@push('styles')
@endpush

@include('client.mobile.home.product-list')
@include('client.mobile.home.package-lib')
