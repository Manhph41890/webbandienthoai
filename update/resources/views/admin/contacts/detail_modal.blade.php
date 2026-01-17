<div class="modal fade" id="contactDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold">Chi tiết liên hệ</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small text-uppercase font-weight-bold">Khách hàng</label>
                        <p id="modal-name" class="font-weight-bold text-dark h5"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small text-uppercase font-weight-bold">Ngày gửi</label>
                        <p id="modal-created" class="text-dark"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small text-uppercase font-weight-bold">Email</label>
                        <p id="modal-email" class="text-primary"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small text-uppercase font-weight-bold">Số điện thoại</label>
                        <p id="modal-phone" class="text-dark"></p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="text-muted small text-uppercase font-weight-bold">Dịch vụ quan tâm</label>
                        <div><span id="modal-service" class="badge badge-info px-3 py-2"></span></div>
                    </div>
                    <div class="col-md-12">
                        <label class="text-muted small text-uppercase font-weight-bold">Nội dung yêu cầu</label>
                        <div id="modal-request" class="p-3 bg-light rounded shadow-sm border" style="min-height: 100px; white-space: pre-wrap;"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-secondary shadow-sm" data-dismiss="modal">Đóng</button>
                <button type="button" id="btn-open-reply" class="btn btn-primary shadow-sm">Phản hồi qua Email</button>
            </div>  
        </div>
    </div>
</div>