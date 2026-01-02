@extends('client.desktop.layouts.app')

@section('content')
    <!-- Cấu trúc HTML chính trong phone-detail.blade.php -->
    <div id="ss-pd-wrapper">
        <div class="ss-pd-container">
            <div class="ss-pd-row">
                <!-- Cột trái: Hình ảnh -->
                <div class="ss-pd-col-image" style="max-width: 530px">
                    <div class="ss-pd-main-img-box" style="min-height: 600px !important;max-height: 600px !important;">
                        <img id="ss-pd-main-view" src="{{ asset('storage/' . $phone->main_image) }}" alt="{{ $phone->name }}">
                        <span class="ss-pd-badge-condition" id="ss-pd-current-status">Đang chọn...</span>
                    </div>
                    <div class="ss-pd-thumb-list" id="ss-pd-thumbs">
                        @foreach ($allImages as $path)
                            <img class="{{ $loop->first ? 'active' : '' }}" src="{{ asset('storage/' . $path) }}"
                                data-full="{{ asset('storage/' . $path) }}" alt="Thumbnail">
                        @endforeach
                    </div>
                </div>

                <!-- Cột phải: Thông tin -->
                <div class="ss-pd-col-info">
                    <nav class="ss-pd-breadcrumb">Trang chủ / {{ $phone->category->name }} / {{ $phone->name }}</nav>
                    <h1 class="ss-pd-title">{{ $phone->name }}</h1>

                    <!-- SKU & Màn hình hiển thị nhanh -->
                    <div class="ss-pd-quick-meta">
                        <span>SKU: <strong id="ss-pd-sku">N/A</strong></span>
                        <span class="divider">|</span>
                        <span>Màn hình: <strong id="ss-pd-screen">N/A</strong></span>
                    </div>

                    <div class="ss-pd-rating">
                        <div class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <span class="ss-pd-review-count">(5.0/5 - 100% khách hàng hài lòng)</span>
                    </div>

                    <div class="ss-pd-price-area">
                        <span id="ss-pd-main-price"
                            class="ss-pd-price-new">{{ number_format($phone->variants->min('price')) }}đ</span>
                        <span class="ss-pd-stock-label" id="ss-pd-stock-status">Vui lòng chọn biến thể</span>
                    </div>

                    <!-- BỘ CHỌN BIẾN THỂ DYNAMIC -->
                    <div class="ss-pd-variant-section">
                        <!-- 1. Chọn Tình trạng -->
                        <label class="ss-pd-label">Tình trạng máy:</label>
                        <div class="ss-pd-variant-group selector-condition">
                            @foreach ($availableConditions as $condition)
                                <button class="ss-pd-v-item" data-type="condition" data-value="{{ $condition }}">
                                    {{ $condition == 'new' ? 'Máy mới 100%' : 'Máy cũ/Like New' }}
                                </button>
                            @endforeach
                        </div>

                        <!-- 2. Chọn Dung lượng -->
                        <label class="ss-pd-label">Dung lượng:</label>
                        <div class="ss-pd-variant-group selector-size">
                            @foreach ($availableSizes as $size)
                                <button class="ss-pd-v-item" data-type="size" data-value="{{ $size->id }}">
                                    {{ $size->name }}
                                </button>
                            @endforeach
                        </div>

                        <!-- 3. Chọn Màu sắc -->
                        <label class="ss-pd-label">Màu sắc:</label>
                        <div class="ss-pd-variant-group selector-color">
                            @foreach ($availableColors as $color)
                                <button class="ss-pd-v-item" data-type="color" data-value="{{ $color->id }}">
                                    <span class="color-dot" style="background: {{ $color->code }}"></span>
                                    {{ $color->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- THÔNG TIN CHI TIẾT MÁY CŨ (Chỉ hiện khi chọn máy cũ) -->
                    <div class="ss-pd-spec-summary" id="ss-pd-used-info" style="display:none;">
                        <div class="spec-item"><i class="fas fa-battery-half"></i> Pin: <strong id="val-pin">N/A</strong>
                        </div>
                        <div class="spec-item"><i class="fas fa-sync"></i> Sạc: <strong id="val-sac">N/A</strong></div>
                        <div class="spec-item"><i class="fas fa-microchip"></i> RAM: <strong id="val-ram">N/A</strong>
                        </div>
                    </div>

                    <!-- KHỐI ƯU ĐÃI (Giữ nguyên phong cách chuyên nghiệp) -->
                    <div class="ss-pd-promo-box">
                        <div class="promo-title"><i class="fas fa-gift"></i> ĐẶC QUYỀN KHI MUA TẠI STORE</div>
                        <ul class="promo-list">
                            <li><i class="check-icon">✓</i> <strong>Bộ phụ kiện:</strong> Tặng Sạc nhanh, Ốp lưng thời
                                trang, Dán màn hình PPF.</li>
                            <li><i class="check-icon">✓</i> <strong>Vận chuyển:</strong> Giao hàng hỏa tốc từ Hàn Quốc/Nhật
                                Bản về Việt Nam.</li>
                            <li><i class="check-icon">✓</i> <strong>Bảo hành:</strong> Cam kết bảo hành vàng 12 tháng, lỗi
                                đổi mới trong 30 ngày.</li>
                        </ul>
                    </div>

                    <div class="ss-pd-actions mb-2">
                        <!-- Nút chính để gửi Mess -->
                        <button class="ss-pd-btn-buy" id="btn-buy-now">
                            <i class="fab fa-facebook-messenger"></i> MUA NGAY QUA MESSENGER
                        </button>
                        <button class="ss-pd-btn-cart">LIÊN HỆ TƯ VẤN</button>
                    </div>
                    <span id="copy-guide" class="ms-3" style="color: rgb(193, 0, 0); font-weight: 500; display: none;">
                        <i class="fas fa-info-circle"></i> Hệ thống đã tự động sao chép, bạn hãy <strong>Dán
                            (Ctrl+V)</strong> vào khung chat để nhận ưu đãi nhé!
                    </span>
                </div>

            </div>
        </div>
        @include('client.desktop.phones.relate-phone')
    </div>

    <!-- DATA BRIDGE: Truyền dữ liệu sang JS -->
    <script>
        const VARIANT_DATA = @json($variants);
    </script>
@endsection
@include('client.desktop.phones.lib-detail')
@include('client.desktop.phones.phone-post')
