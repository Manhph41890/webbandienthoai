        <div class="row">
            <!-- Tổng Sản Phẩm -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-gradient-primary border-0 shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-white-50 text-xs font-weight-bold text-uppercase mb-1">Thiết bị trong
                                    kho
                                </div>
                                <div class="h3 mb-0 font-weight-bold text-white">{{ number_format($phonesCount) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-mobile-alt fa-2x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tổng Gói Cước -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-gradient-success border-0 shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-white-50 text-xs font-weight-bold text-uppercase mb-1">Gói cước hoạt
                                    động
                                </div>
                                <div class="h3 mb-0 font-weight-bold text-white">{{ $packagesCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sim-card fa-2x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nhân viên & User -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-gradient-warning border-0 shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-white-50 text-xs font-weight-bold text-uppercase mb-1">Nhân sự hệ thống
                                </div>
                                <div class="h3 mb-0 font-weight-bold text-white">{{ $employeesCount }} <small
                                        style="font-size: 14px">NV</small> / {{ $usersCount }} <small
                                        style="font-size: 14px">User</small></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-tie fa-2x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lượt xem -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-gradient-info border-0 shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-white-50 text-xs font-weight-bold text-uppercase mb-1">Lượt tương tác
                                </div>
                                <div class="h3 mb-0 font-weight-bold text-white">{{ number_format($totalViews) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-line fa-2x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
