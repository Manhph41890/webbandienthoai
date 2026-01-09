@extends('client.mobile.layouts.app')

@section('content')
    <div id="m-pd-wrapper">
        <!-- 1. Hình ảnh: Slider cuộn ngang -->
        <div class="m-pd-image-slider">
            <div class="m-pd-main-track" id="m-pd-slider">
                @foreach ($allImages as $path)
                    <div class="m-pd-slide">
                        <img src="{{ asset('storage/' . $path) }}" alt="{{ $phone->name }}">
                    </div>
                @endforeach
            </div>
            <div class="m-pd-badge-condition" id="ss-pd-current-status">Đang chọn...</div>
            <div class="m-pd-slider-dots">
                @foreach ($allImages as $index => $path)
                    <span class="dot {{ $index == 0 ? 'active' : '' }}"></span>
                @endforeach
            </div>
        </div>

        <!-- 2. Thông tin chính -->
        <div class="m-pd-info-container">
            <nav class="m-pd-breadcrumb">Trang chủ / {{ $phone->category->name }}</nav>
            <div class="d-flex justify-content-between">
                <h1 class="m-pd-title">{{ $phone->name }}</h1>
                <button class="spc-heart-btn {{ $phone->isFavorited() ? 'active' : '' }}" data-id="{{ $phone->id }}"
                    data-type="phone">
                    <i class="{{ $phone->isFavorited() ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                </button>
            </div>


            <div class="m-pd-meta-row">
                <div class="m-pd-rating">
                    <i class="fas fa-star"></i> 5.0 <span>(99+ đánh giá)</span>
                </div>
                <div class="m-pd-sku">SKU: <span id="ss-pd-sku">N/A</span></div>
            </div>

            <div class="m-pd-price-box">
                <span id="ss-pd-main-price" class="m-pd-price-new">0đ</span>
                <span class="m-pd-stock-status" id="ss-pd-stock-status">Đang kiểm tra...</span>
            </div>

            <!-- 3. Bộ chọn biến thể -->
            <div class="m-pd-variants">
                <!-- Tình trạng -->
                <div class="m-v-group">
                    <label>Tình trạng máy:</label>
                    <div class="m-v-list selector-condition">
                        @foreach ($availableConditions as $condition)
                            <button class="ss-pd-v-item" data-type="condition" data-value="{{ $condition }}">
                                {{ $condition == 'new' ? 'Mới 100%' : 'Like New' }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Dung lượng -->
                <div class="m-v-group">
                    <label>Dung lượng:</label>
                    <div class="m-v-list selector-size">
                        @foreach ($availableSizes as $size)
                            <button class="ss-pd-v-item" data-type="size" data-value="{{ $size->id }}">
                                {{ $size->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Màu sắc -->
                <div class="m-v-group">
                    <label>Màu sắc:</label>
                    <div class="m-v-list selector-color">
                        @foreach ($availableColors as $color)
                            <button class="ss-pd-v-item" data-type="color" data-value="{{ $color->id }}">
                                <span class="color-dot" style="background: {{ $color->hex_code }}"></span>
                                {{ $color->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- 4. Thông số máy cũ (Toggle) -->
            <div class="m-pd-used-card" id="ss-pd-used-info" style="display:none;">
                <div class="m-used-item">
                    <i class="fas fa-battery-three-quarters"></i>
                    <span>Pin: <strong id="val-pin">N/A</strong></span>
                </div>
                <div class="m-used-item">
                    <i class="fas fa-bolt"></i>
                    <span>Sạc: <strong id="val-sac">0</strong></span>
                </div>
                <div class="m-used-item">
                    <i class="fas fa-microchip"></i>
                    <span>RAM: <strong id="val-ram">N/A</strong></span>
                </div>
            </div>

            <!-- 5. Ưu đãi -->
            <div class="m-pd-promo">
                <div class="m-promo-header"><i class="fas fa-gift"></i> ĐẶC QUYỀN MUA HÀNG</div>
                <ul class="m-promo-list">
                    <li><i class="fas fa-check-circle"></i> Tặng bộ sạc nhanh & ốp lưng cao cấp.</li>
                    <li><i class="fas fa-check-circle"></i> Bảo hành vàng 12 tháng cả nguồn, màn hình.</li>
                    <li><i class="fas fa-check-circle"></i> Giao hàng hỏa tốc nội thành 1h.</li>
                </ul>
            </div>
        </div>
        <!-- Sản phẩm liên quan -->
        @include('client.mobile.phones.relate-phone')

        <!-- 6. Sticky Footer Actions -->
        <div class="m-pd-sticky-actions">
            <button class="m-btn-contact"><i class="fab fa-facebook-messenger"></i> Tư vấn</button>
            <button class="m-btn-buy" id="btn-add-to-cart"><i class="fab fa-facebook-messenger"></i> MUA NGAY</button>
        </div>
    </div>
@endsection

<script>
    // Đảm bảo dữ liệu variant luôn có sẵn cho cả 2 bản script
    const VARIANT_DATA = @json($variants);
</script>

@include('client.mobile.phones.lib-detail')

@if ($isAndroid)
    @include('client.mobile.phones.phone-post')
@else
    @include('client.mobile.phones.buy-in-iphone')
@endif
