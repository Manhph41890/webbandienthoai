<div class="row">
    <!-- Biểu đồ cột: Sản phẩm theo chuyên mục -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow-sm border-0 mb-4 rounded-xl">
            <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Thống kê kho hàng theo Chuyên mục</h6>
            </div>
            <div class="card-body">
                <div class="chart-area" style="height: 350px;">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ tròn: Nhà mạng Gói cước -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow-sm border-0 mb-4 rounded-xl">
            <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Thị phần Nhà mạng</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2" style="height: 300px;">
                    <canvas id="carrierChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2"><i class="fas fa-circle text-primary"></i> SK</span>
                    <span class="mr-2"><i class="fas fa-circle text-success"></i> KT</span>
                    <span class="mr-2"><i class="fas fa-circle text-info"></i> LGU+</span>
                </div>
            </div>
        </div>
    </div>
</div>
