{{-- resources/views/admin/account/detail_modal.blade.php --}}
<div class="modal fade" id="accountDetailModal" tabindex="-1" role="dialog" aria-labelledby="accountDetailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> {{-- Thêm modal-dialog-centered để căn giữa màn hình --}}
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold text-primary" id="accountDetailModalLabel">
                    <i class="fas fa-user-circle mr-2"></i>Chi tiết tài khoản
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Cột bên trái: Avatar & Thông tin cơ bản -->
                    <div class="col-md-4 text-center border-right">
                        <div class="avatar-container mb-3 d-flex align-items-center justify-content-center"
                            style="height: 160px;">
                            {{-- 1. Thẻ ảnh: Mặc định ẩn --}}
                            <img id="modal-avatar-img" src="" alt="Avatar"
                                class="rounded-circle shadow-sm border"
                                style="width: 150px; height: 150px; object-fit: cover; display: none;">

                            {{-- 2. Thẻ Placeholder: Mặc định ẩn --}}
                                                      <div id="custom-avatar-placeholder" class="rounded-circle bg-primary text-white shadow-sm"
                                style="width: 150px; height: 150px; font-size: 60px; font-weight: bold; display: none !important; align-items: center; justify-content: center;">
                            </div>
                        </div>
                        <h5 id="modal-display-name" class="font-weight-bold mb-1"></h5>
                        <div id="modal-account-role-badge"></div>
                    </div>

                    <!-- Cột bên phải: Chi tiết -->
                    <div class="col-md-8">
                        <table class="table table-sm table-borderless">
                            <tbody>
                                <tr>
                                    <th class="text-muted" style="width: 140px;">ID hệ thống:</th>
                                    <td id="modal-account-id" class="font-weight-bold text-dark"></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Email:</th>
                                    <td id="modal-account-email"></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Số điện thoại:</th>
                                    <td id="modal-account-phone"></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Trạng thái:</th>
                                    <td id="modal-account-status"></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Ngày tạo:</th>
                                    <td id="modal-account-created"></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Mật khẩu:</th>
                                    <td class="text-italic text-secondary"><small>(Đã mã hóa bảo mật)</small></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="mt-3 p-3 bg-light rounded">
                            <h6 class="font-weight-bold text-primary mb-2"><i class="fas fa-info-circle mr-1"></i> Tiểu
                                sử (Bio)</h6>
                            <p id="modal-account-bio" class="mb-0 text-dark" style="white-space: pre-wrap;"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button class="btn btn-secondary px-4" type="button" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
