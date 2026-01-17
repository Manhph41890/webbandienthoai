<div class="phone-detail-wrapper">
    <div class="row no-gutters"> <!-- Thêm no-gutters để khít hơn -->
        <!-- Bên trái: Thông tin tổng quan (Cố định) -->
        <div class="col-lg-4 col-md-5 border-right sticky-left-column">
            <div class="product-main-preview text-center p-3">
                <div class="main-image-container mb-4">
                    @if ($phone->main_image)
                        <img src="{{ Storage::url($phone->main_image) }}"
                            class="img-fluid rounded-lg shadow-sm main-img-zoom clickable-img" alt="{{ $phone->name }}"
                            onclick="openLightbox(this.src)">
                    @else
                        <div class="no-image-placeholder">
                            <i class="fas fa-image fa-4x text-light"></i>
                        </div>
                    @endif
                </div>

                <h4 class="font-weight-bold text-dark mb-1">{{ $phone->name }}</h4>
                <div class="mb-3">
                    <span class="badge badge-soft-primary px-3 py-2">{{ $phone->category->name ?? 'N/A' }}</span>
                </div>

                <div class="info-card bg-white border rounded-lg p-3 text-left shadow-xs">
                    <h6 class="text-uppercase small font-weight-bold text-muted mb-2">Mô tả tóm tắt</h6>
                    <p class="small text-secondary mb-0" style="line-height: 1.6;">
                        {{ $phone->short_description ?: 'Chưa có mô tả cho sản phẩm này.' }}
                    </p>
                </div>

                <div class="mt-4 d-flex justify-content-around">
                    <div class="text-center">
                        <div class="h5 mb-0 font-weight-bold">{{ $phone->views_count ?? 0 }}</div>
                        <div class="small text-muted">Lượt xem</div>
                    </div>
                    <div class="divider-vertical"></div>
                    <div class="text-center">
                        <div class="h5 mb-0 font-weight-bold text-danger">{{ $phone->variants->count() }}</div>
                        <div class="small text-muted">Phiên bản</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bên phải: Biến thể & Gallery (Có thanh cuộn) -->
        <div class="col-lg-8 col-md-7 bg-white right-scrollable-content">
            <div class="p-3">
                <ul class="nav nav-pills nav-justified mb-4 sticky-top bg-white py-2" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active font-weight-bold" id="pills-variants-tab" data-toggle="pill"
                            href="#pills-variants">
                            <i class="fas fa-layer-group mr-2"></i>Các phiên bản giá
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" id="pills-gallery-tab" data-toggle="pill"
                            href="#pills-gallery">
                            <i class="fas fa-images mr-2"></i>Thư viện ảnh phụ
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <!-- Tab Biến thể -->
                    <div class="tab-pane fade show active" id="pills-variants">
                        @if ($phone->variants->isNotEmpty())
                            @foreach ($phone->variants as $variant)
                                <div
                                    class="variant-item-card border rounded-lg p-3 mb-3 transition-hover {{ $variant->is_default ? 'border-primary bg-light-primary' : '' }}">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="variant-img">
                                                <img src="{{ $variant->image_path ? Storage::url($variant->image_path) : 'https://via.placeholder.com/60' }}"
                                                    class="rounded border clickable-img" width="60"
                                                    onclick="openLightbox(this.src)">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="font-weight-bold mb-1">
                                                        {{ $variant->size->name ?? '' }} |
                                                        {{ $variant->color->name ?? '' }}
                                                    </h6>
                                                    <div class="small text-muted">
                                                        <span class="mr-2"><i
                                                                class="fas fa-microchip mr-1"></i>{{ $variant->general_specs['ram'] ?? 'N/A' }}
                                                            RAM</span>
                                                        <span><i
                                                                class="fas fa-hdd mr-1"></i>{{ $variant->general_specs['storage'] ?? 'N/A' }}</span>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="h5 font-weight-bold text-danger mb-0">
                                                        {{ number_format($variant->price, 0, ',', '.') }}
                                                        <small>w</small>
                                                    </div>
                                                    <div
                                                        class="small {{ $variant->stock > 0 ? 'text-success' : 'text-danger' }}">
                                                        Kho: {{ $variant->stock }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ... (các phần cũ giữ nguyên) ... -->
                                            @if ($variant->condition == 'used')
                                                <div class="used-info-box mt-2 p-2 rounded bg-white border">
                                                    <div class="row no-gutters text-center">
                                                        <div class="col-4 border-right">
                                                            <div class="small text-muted">Tình trạng</div>
                                                            <span class="badge badge-warning">Máy cũ</span>
                                                        </div>
                                                        <div class="col-4 border-right">
                                                            <div class="small text-muted">Pin</div>
                                                            <strong
                                                                class="text-dark">{{ $variant->used_details['battery_health'] ?? 'N/A' }}%</strong>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="small text-muted">Lần sạc</div>
                                                            <strong
                                                                class="text-dark">{{ $variant->used_details['charging_cycles'] ?? 'N/A' }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- Tab Gallery -->
                    <div class="tab-pane fade" id="pills-gallery">
                        @if ($phone->images->isNotEmpty())
                            <div class="row mx-n1">
                                @foreach ($phone->images as $image)
                                    <div class="col-4 col-md-3 p-1">
                                        <div class="gallery-item rounded overflow-hidden border">
                                            <img src="{{ Storage::url($image->image_path) }}"
                                                class="img-fluid gallery-img clickable-img"
                                                onclick="openLightbox(this.src)">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox Modal (Phóng to ảnh) -->
<div id="imageLightbox" class="custom-lightbox" onclick="closeLightbox()">
    <span class="close-lightbox">&times;</span>
    <img class="lightbox-content" id="lightboxImg">
</div>
@include('admin.phones.show_modal_lib')
