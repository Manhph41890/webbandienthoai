<!-- Modal Phản hồi Mail -->
<div class="modal fade" id="replyMailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog border-0 shadow-lg" role="document">
        <div class="modal-content">
            <form id="replyMailForm" action="" method="POST">
                @csrf
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">Soạn phản hồi tới: <span id="reply-to-name"></span></h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Tới Email:</label>
                        <input type="text" id="reply-to-email" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Nội dung phản hồi:</label>
                        <textarea name="message" class="form-control" rows="6" placeholder="Nhập nội dung gửi khách hàng..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-paper-plane mr-1"></i> Gửi Mail ngay
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>  