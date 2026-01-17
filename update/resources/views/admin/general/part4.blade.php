<div class="row">
    <!-- Cột 1: Kho hàng -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="st-card st-grad-1 shadow-sm h-100">
            <div class="st-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="st-label">Thiết bị trong kho</div>
                        <div class="st-value">{{ number_format($totalVariants) }} <small>mẫu</small></div>
                    </div>
                    <i class="fas fa-boxes st-icon-bg"></i>
                </div>
                <div class="mt-3">
                    <!-- Dùng data-custom-target thay vì data-target của BS -->
                    <button class="st-detail-btn" type="button" data-custom-target="#st-dt-1">
                        Xem chi tiết <i class="fas fa-chevron-down ml-1 st-chevron"></i>
                    </button>
                </div>
            </div>
            <div class="st-collapse-content" id="st-dt-1">
                <div class="st-padding">
                    <div><i class="fas fa-warehouse mr-2"></i> Tổng tồn kho:
                        <strong>{{ number_format($totalStock) }}</strong>
                    </div>
                    <div><i class="fas fa-sync-alt mr-2"></i> Trạng thái: <strong>Đang cập nhật</strong></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cột 2: Gói cước -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="st-card st-grad-2 shadow-sm h-100">
            <div class="st-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="st-label">Gói cước hoạt động</div>
                        <div class="st-value">{{ $packagesCount }}</div>
                    </div>
                    <i class="fas fa-sim-card st-icon-bg"></i>
                </div>
                <div class="mt-3">
                    <button class="st-detail-btn" type="button" data-custom-target="#st-dt-2">
                        Chi tiết nhà mạng <i class="fas fa-chevron-down ml-1 st-chevron"></i>
                    </button>
                </div>
            </div>
            <div class="st-collapse-content" id="st-dt-2">
                <div class="st-padding">
                    @php $carriers = ['SK' => 'sk', 'KT' => 'kt', 'LG' => 'lgu']; @endphp
                    @foreach ($carriers as $name => $code)
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span><i class="fas fa-signal mr-2"></i> {{ $name }}:</span>
                            <strong>{{ \App\Models\Package::where('carrier', $code)->count() }}</strong>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Cột 3: Nhân sự -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="st-card st-grad-3 shadow-sm h-100">
            <div class="st-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="st-label">Nhân sự & Khách</div>
                        <div class="st-value-sm">{{ $employeesCount }} NV / {{ $usersCount }} User</div>
                    </div>
                    <i class="fas fa-users st-icon-bg"></i>
                </div>
                <div class="mt-3">
                    <button class="st-detail-btn" type="button" data-custom-target="#st-dt-3">
                        Trạng thái Online <i class="fas fa-chevron-down ml-1 st-chevron"></i>
                    </button>
                </div>
            </div>
            <div class="st-collapse-content" id="st-dt-3">
                <div class="st-padding">
                    <div class="d-flex align-items-center text-success"><i class="fas fa-circle mr-2 st-blink"></i> Đang
                        Online: <strong class="ml-1">{{ $employees->count() }}</strong></div>
                    <div class="d-flex align-items-center mt-2"><i class="fas fa-user-cog mr-2"></i> <a
                            href="{{ route('admin.accounts.index') }}" class="text-white border-bottom">Quản lý</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cột 4: Lượt xem -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="st-card st-grad-4 shadow-sm h-100">
            <div class="st-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="st-label">Lượt xem sản phẩm</div>
                        <div class="st-value">{{ number_format($totalProductViews) }}</div>
                    </div>
                    <i class="fas fa-eye st-icon-bg"></i>
                </div>
                <div class="mt-3">
                    <button class="st-detail-btn" type="button" data-custom-target="#st-dt-4">
                        Xem Top SP <i class="fas fa-chevron-down ml-1 st-chevron"></i>
                    </button>
                </div>
            </div>
            <div class="st-collapse-content" id="st-dt-4">
                <div class="st-padding">
                    @foreach ($topPhones as $tp)
                        <div class="text-truncate mb-1"><i class="fas fa-star mr-2 text-warning"></i>
                            {{ $tp->name }} ({{ $tp->views_count }})</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Cột 5: Đơn hàng -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="st-card st-grad-5 shadow-sm h-100">
            <div class="st-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="st-label">ĐƠN MESSENGER</div>
                        <div class="st-value">{{ number_format($totalMessengerOrders) }}</div>
                    </div>
                    <!-- Đổi sang icon Messenger cho đúng ngữ cảnh -->
                    <i class="fab fa-facebook-messenger st-icon-bg"></i>
                </div>
                <div class="mt-3">
                    <button class="st-detail-btn" type="button" data-custom-target="#st-dt-5">
                        Xem chi tiết <i class="fas fa-chevron-down ml-1 st-chevron"></i>
                    </button>
                </div>
            </div>
            <div class="st-collapse-content" id="st-dt-5">
                <div class="st-padding">
                    <!-- Hiển thị doanh thu dự tính -->
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-money-bill-wave mr-2 text-success"></i>
                        Dự thu: <strong class="ml-1 text-white">{{ number_format($totalMessengerRevenue) }}w</strong>
                    </div>
                    <hr style="border-top: 1px solid rgba(255,255,255,0.2); margin: 5px 0;">
                    <!-- Hiển thị phân loại -->
                    <div class="d-flex justify-content-between">
                        <span><i class="fas fa-mobile-alt mr-1"></i> Điện thoại:</span>
                        <strong>{{ $phoneMessCount }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <span><i class="fas fa-sim-card mr-1"></i> Gói cước:</span>
                        <strong>{{ $packageMessCount }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cột 6: Website -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="st-card st-grad-6 shadow-sm h-100">
            <div class="st-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="st-label">Truy cập Website</div>
                        <!-- Hiển thị tổng số lượt truy cập -->
                        <div class="st-value">{{ number_format($webVisits ?? 0) }}</div>
                    </div>
                    <i class="fas fa-globe st-icon-bg"></i>
                </div>
                <div class="mt-3">
                    <button class="st-detail-btn" type="button" data-custom-target="#st-dt-6">
                        Thiết bị <i class="fas fa-chevron-down ml-1 st-chevron"></i>
                    </button>
                </div>
            </div>
            <div class="st-collapse-content" id="st-dt-6">
                <div class="st-padding">
                    <!-- Hiển thị chi tiết Mobile -->
                    <div class="d-flex align-items-center mb-1">
                        <i class="fas fa-mobile-alt mr-2"></i>
                        Mobile: {{ $mobileRate }}% ({{ number_format($mobileHits) }})
                    </div>
                    <!-- Hiển thị chi tiết Desktop -->
                    <div class="d-flex align-items-center">
                        <i class="fas fa-desktop mr-2"></i>
                        Desktop: {{ $desktopRate }}% ({{ number_format($desktopHits) }})
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cột 7: Yêu thích -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="st-card st-grad-7 shadow-sm h-100">
            <div class="st-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="st-label">Lượt yêu thích SP</div>
                        <div class="st-value">{{ number_format($totalFavorites ?? 0) }}</div>
                    </div>
                    <i class="fas fa-heart st-icon-bg"></i>
                </div>
                <div class="mt-3">
                    <button class="st-detail-btn" type="button" data-custom-target="#st-dt-7">
                        Tỉ lệ quan tâm <i class="fas fa-chevron-down ml-1 st-chevron"></i>
                    </button>
                </div>
            </div>
            <div class="st-collapse-content" id="st-dt-7">
                <div class="st-padding">
                    <div class="d-flex align-items-center"><i class="fas fa-chart-line mr-2"></i> Tăng 12% tháng này
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cột 8: Hết hàng -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="st-card st-grad-8 shadow-sm h-100">
            <div class="st-card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="st-label">Cần nhập kho</div>
                        <div class="st-value st-text-warn">{{ $outOfStockCount ?? 0 }} <small>mẫu</small></div>
                    </div>
                    <i class="fas fa-exclamation-triangle st-icon-bg"></i>
                </div>
                <div class="mt-3">
                    <button class="st-detail-btn" type="button" data-custom-target="#st-dt-8">
                        Xem danh sách <i class="fas fa-chevron-down ml-1 st-chevron"></i>
                    </button>
                </div>
            </div>
            <div class="st-collapse-content" id="st-dt-8">
                <div class="st-padding">
                    @foreach ($lowStockPhones as $lp)
                        <div class="text-truncate d-flex justify-content-between mb-1">
                            <span><i class="fas fa-angle-right mr-1"></i> {{ $lp->name }}</span>
                            <strong class="st-text-warn">({{ $lp->variants_sum_stock }})</strong>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.general.part4-lib')
