        <div class="row">
            <!-- Bảng Sản Phẩm Sắp Hết Hàng -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-danger"><i class="fas fa-exclamation-triangle mr-2"></i>Cảnh
                            Báo Hết Hàng (Tồn kho < 10)</h6>
                                <a href="#" class="btn btn-sm btn-outline-danger border-0">Xem tất cả</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 px-4">Sản phẩm</th>
                                        <th class="border-0 text-center">Tồn kho</th>
                                        <th class="border-0">Mức độ</th>
                                        <th class="border-0 text-right px-4">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lowStockPhones as $phone)
                                        <tr>
                                            <td class="px-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle bg-light p-1 mr-3">
                                                        <img src="{{ Storage::url($phone->main_image) }}"
                                                            class="rounded-circle" width="35" height="35"
                                                            style="object-fit: cover;">
                                                    </div>
                                                    <span class="font-weight-bold">{{ $phone->name }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center font-weight-bold text-dark">
                                                {{ $phone->variants_sum_stock }}</td>
                                            <td>
                                                @php $percent = ($phone->variants_sum_stock / 10) * 100; @endphp
                                                <div class="progress progress-sm" style="width: 100px;">
                                                    <div class="progress-bar {{ $phone->variants_sum_stock < 5 ? 'bg-danger' : 'bg-warning' }}"
                                                        role="progressbar" style="width: {{ $percent }}%"></div>
                                                </div>
                                            </td>
                                            <td class="text-right px-4">
                                                <a href="#" class="btn btn-sm btn-light rounded-pill px-3">Nhập
                                                    thêm</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danh sách nhân viên -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-dark">Nhân Viên Trực Tuyến</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @foreach ($employees as $emp)
                                <div class="list-group-item border-0 d-flex align-items-center py-3">
                                    <div class="position-relative mr-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($emp->name) }}&background=random"
                                            class="rounded-circle" width="40">
                                        <span class="position-absolute border border-white rounded-circle bg-success"
                                            style="bottom: 0; right: 0; width: 12px; height: 12px;"></span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 text-sm font-weight-bold">{{ $emp->name }}</h6>
                                        <p class="mb-0 text-xs text-muted">{{ strtoupper($emp->role) }}</p>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-light-primary rounded-circle"><i
                                                class="far fa-comment-dots"></i></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer bg-white text-center border-0">
                        <a href="#" class="text-primary small font-weight-bold">Quản lý nhân sự <i
                                class="fas fa-chevron-right ml-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
