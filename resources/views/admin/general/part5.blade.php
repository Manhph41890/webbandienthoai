        <div class="row align-items-center mb-4 mt-3">
            <div class="col-md-6">
                <h1 class="h3 mb-1 text-gray-800 font-weight-bold">Hệ Thống Quản Trị</h1>
                <p class="text-muted small"><i class="fas fa-calendar-alt mr-1"></i> Dữ liệu cập nhật đến:
                    {{ now()->format('d/m/Y H:i') }}</p>
            </div>
            <div class="col-md-6">
                <!-- Advanced Filter -->
                <form action="" method="GET"
                    class="dashboard-filter-modern bg-white shadow-sm p-2 rounded-pill d-flex align-items-center float-right">
                    <div class="filter-group d-flex align-items-center px-3 border-right">
                        <i class="fas fa-filter text-muted mr-2"></i>
                        <select name="time_range"
                            class="form-control-sm border-0 bg-transparent font-weight-bold shadow-none">
                            <option value="today">Hôm nay</option>
                            <option value="month" selected>Tháng này</option>
                            <option value="year">Năm nay</option>
                        </select>
                    </div>
                    <div class="filter-group d-flex align-items-center px-3">
                        <select name="cat_id"
                            class="form-control-sm border-0 bg-transparent font-weight-bold shadow-none">
                            <option value="">Tất cả danh mục</option>
                            @foreach ($categoriesLevel2 as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm transition-all">
                        <i class="fas fa-sync-alt"></i> Lọc
                    </button>
                </form>
            </div>
        </div>
