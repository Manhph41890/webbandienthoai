<div class="row align-items-center mb-4 mt-3">
    <!-- Cột 1: Tiêu đề & Đồng hồ -->
    <div class="col-xl-4 col-lg-12 mb-3 mb-xl-0">
        <h1 class="h3 mb-1 text-gray-800 font-weight-bold">Hệ Thống Quản Trị</h1>
        <div class="text-muted small d-flex align-items-center">
            <i class="fas fa-calendar-alt mr-2"></i>
            <span class="mr-1">Hệ thống:</span>
            <span id="clock" class="font-weight-bold text-primary"></span>
        </div>
    </div>

    <!-- Cột 2: Cụm bộ lọc -->
    <div class="col-xl-8 col-lg-12">
        <form action="" method="GET" id="filterForm"
            class="d-flex flex-wrap justify-content-xl-end align-items-center" style="gap: 10px;">

            <!-- Nhóm 1: Lọc nhanh (Preset) -->
            <div class="st-filter-wrapper bg-white shadow-sm p-2 rounded-pill d-flex align-items-center px-3">
                <i class="fas fa-history text-primary mr-2"></i>
                <label class="mb-0 mr-2 small font-weight-bold text-secondary">Lọc nhanh:</label>
                <select name="time_range" class="st-filter-select border-0 bg-transparent font-weight-bold shadow-none"
                    onchange="this.form.submit()" style="cursor: pointer;">
                    <option value="all"
                        {{ request('time_range') == 'all' || !request('time_range') ? 'selected' : '' }}>Tất cả
                    </option>
                    <option value="today" {{ request('time_range') == 'today' ? 'selected' : '' }}>Hôm nay</option>
                    <option value="month" {{ request('time_range') == 'month' ? 'selected' : '' }}>Tháng này</option>
                    <option value="year" {{ request('time_range') == 'year' ? 'selected' : '' }}>Năm nay</option>
                </select>
            </div>

            <!-- Nhóm 2: Khoảng ngày tùy chọn (Custom) -->
            <div class="st-filter-wrapper bg-white shadow-sm p-2 rounded-pill d-flex align-items-center px-3">
                <i class="fas fa-calendar-day text-success mr-2"></i>
                <label class="mb-0 mr-2 small font-weight-bold text-secondary">Khoảng ngày:</label>
                <div class="d-flex align-items-center">
                    <input type="date" name="from_date" value="{{ request('from_date') }}"
                        class="form-control form-control-sm border-0 bg-transparent p-0"
                        style="width: 115px; font-size: 0.85rem;">
                    <span class="mx-2 text-muted">-</span>
                    <input type="date" name="to_date" value="{{ request('to_date') }}"
                        class="form-control form-control-sm border-0 bg-transparent p-0"
                        style="width: 115px; font-size: 0.85rem;">
                </div>
            </div>

            <!-- Nút bấm -->
            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm font-weight-bold">
                <i class="fas fa-filter mr-1"></i> Lọc
            </button>

            @if (request('from_date') || request('time_range'))
                <a href="{{ request()->url() }}" class="btn btn-light rounded-pill shadow-sm border">
                    <i class="fas fa-sync-alt"></i>
                </a>
            @endif
        </form>
    </div>
</div>


@include('admin.general.part5-lib')
