{{-- resources/views/admin/account/detail_modal.blade.php --}}
<div class="modal fade" id="accountDetailModal" tabindex="-1" role="dialog" aria-labelledby="accountDetailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="accountDetailModalLabel">Chi tiết tài khoản
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        {{-- Vùng hiển thị Avatar --}}
                        <img id="modal-avatar-img" src="" alt="Avatar" class="img-fluid rounded-circle mb-3"
                            style="width: 150px; height: 150px; object-fit: cover;">
                        <div id="modal-avatar-text"
                            class="img-placeholder rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 150px; height: 150px; font-size: 50px; font-weight: bold;">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 150px;">ID</th>
                                    <td id="modal-account-id"></td>
                                </tr>
                                <tr>
                                    <th>Họ và tên</th>
                                    <td id="modal-account-name"></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td id="modal-account-email"></td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại</th>
                                    <td id="modal-account-phone"></td>
                                </tr>
                                <tr>
                                    <th>Vai trò</th>
                                    <td id="modal-account-role"></td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td id="modal-account-status"></td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td id="modal-account-created"></td>
                                </tr>
                                <tr>
                                    <th>Mật khẩu</th>
                                    <td><em>(Đã mã hóa)</em></td>
                                </tr>
                                <tr>
                                    <th colspan="2">Tiểu sử (Bio)</th>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p id="modal-account-bio" class="mb-0"></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
