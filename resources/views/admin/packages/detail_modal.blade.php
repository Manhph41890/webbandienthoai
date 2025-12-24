{{-- resources/views/admin/packages/detail_modal.blade.php --}}
<div class="modal fade" id="packageDetailModal" tabindex="-1" role="dialog" aria-labelledby="packageDetailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold" id="packageDetailModalLabel">
                    <i class="fas fa-info-circle mr-2"></i> Chi tiết Gói cước
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body bg-light p-4">

                <div class="row">
                    <!-- Cột thông tin cơ bản -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body p-3">
                                <h6 class="font-weight-bold text-primary border-bottom pb-2 mb-3">Thông tin cơ bản</h6>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted small text-uppercase font-weight-bold">Tên gói:</div>
                                    <div class="col-7 text-dark font-weight-bold" id="modal-name"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted small text-uppercase font-weight-bold">Nhà mạng:</div>
                                    <div class="col-7 font-weight-bold text-info" id="modal-carrier"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted small text-uppercase font-weight-bold">Giá cước:</div>
                                    <div class="col-7 text-danger font-weight-bold" id="modal-price"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted small text-uppercase font-weight-bold">Thời hạn:</div>
                                    <div class="col-7" id="modal-duration"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted small text-uppercase font-weight-bold">Loại SIM:</div>
                                    <div class="col-7 text-secondary" id="modal-sim"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 text-muted small text-uppercase font-weight-bold">Thanh toán:
                                    </div>
                                    <div class="col-7" id="modal-payment"></div>
                                </div>  
                                                        <span id="modal-carrier"></span>
                        <!-- Ảnh nhà mạng (Sẽ thay đổi src bằng JS) -->
                        <img id="modal-carrier-img" src="" alt="Carrier Logo" class="ml-2"
                            style="height: 50px; width: auto; display: none;">
                            </div>
                        </div>

                    </div>

                    <!-- Cột kỹ thuật và trạng thái -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm mb-3 h-100">
                            <div class="card-body p-3">
                                <h6 class="font-weight-bold text-primary border-bottom pb-2 mb-3">Hậu cần & Trạng thái
                                </h6>
                                <div class="row mb-3">
                                    <div class="col-5 text-muted small text-uppercase font-weight-bold">Kho hàng:</div>
                                    <div class="col-7" id="modal-inv-status"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-5 text-muted small text-uppercase font-weight-bold">Hiển thị:</div>
                                    <div class="col-7" id="modal-status"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-5 text-muted small text-uppercase font-weight-bold">Ngày tạo:</div>
                                    <div class="col-7 small" id="modal-created"></div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-muted small text-uppercase font-weight-bold mb-1">Thông số
                                        (JSON):</div>
                                    <div class="col-12 border rounded bg-white p-2 small" style="min-height: 80px;">
                                        <ul id="modal-spec" class="mb-0 pl-3"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Khối mô tả -->
                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-header bg-white py-2">
                        <span class="small text-uppercase font-weight-bold text-muted"><i
                                class="fas fa-align-left mr-1"></i> Mô tả chi tiết</span>
                    </div>
                    <div class="card-body p-3">
                        <div id="modal-description" class="text-dark small"
                            style="max-height: 120px; overflow-y: auto; line-height: 1.6;">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer bg-white border-0">
                <button class="btn btn-secondary px-4 shadow-sm" type="button" data-dismiss="modal"
                    style="border-radius: 8px;">Đóng</button>
            </div>
        </div>
    </div>
</div>
