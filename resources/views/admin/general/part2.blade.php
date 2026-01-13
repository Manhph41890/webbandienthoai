<div class="row">
    <!-- Biểu đồ cột: Sản phẩm theo chuyên mục -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow border-0 mb-4 rounded-xl">
            <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-boxes mr-1"></i> Thống kê kho hàng theo Chuyên mục
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-area" style="position: relative; height: 350px;">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ tròn: Cơ cấu doanh thu -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow border-0 mb-4 rounded-xl">
            <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-success">
                    <i class="fas fa-hand-holding-usd mr-1"></i> Cơ cấu đơn hàng (Messenger)
                </h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-2 pb-2">
                    <canvas id="revenueChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Điện thoại
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Gói cước
                    </span>
                </div>
                <hr>
                <div class="text-center">
                    <p class="mb-0 text-gray-500 small">Tổng doanh thu dự tính</p>
                    <h4 class="font-weight-bold text-dark">{{ number_format($totalMessengerRevenue) }}đ</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.general.part2-lib')
