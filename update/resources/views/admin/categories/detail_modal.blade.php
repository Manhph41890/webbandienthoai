{{-- resources/views/admin/categories/detail_modal.blade.php --}}
<div class="modal fade" id="categoryDetailModal" tabindex="-1" role="dialog" aria-labelledby="categoryDetailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document"> {{-- Căn giữa màn hình cho đẹp --}}
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold" id="categoryDetailModalLabel">
                    <i class="fas fa-info-circle mr-2"></i> Chi tiết Chuyên mục
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body bg-light p-4">

                <!-- Khối thông tin chính -->
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body p-3">
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted small text-uppercase font-weight-bold">Tên chuyên mục</div>
                            <div class="col-sm-8 text-dark font-weight-bold" id="modal-name"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted small text-uppercase font-weight-bold">Đường dẫn (Slug)
                            </div>
                            <div class="col-sm-8"><code id="modal-slug" class="text-primary font-weight-bold"></code>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted small text-uppercase font-weight-bold">Chuyên mục cha</div>
                            <div class="col-sm-8" id="modal-parent"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted small text-uppercase font-weight-bold">Trạng thái</div>
                            <div class="col-sm-8" id="modal-status"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 text-muted small text-uppercase font-weight-bold">Ngày tạo</div>
                            <div class="col-sm-8 text-secondary" id="modal-created"></div>
                        </div>
                    </div>
                </div>

                <!-- Khối mô tả -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-2">
                        <span class="small text-uppercase font-weight-bold text-muted"><i
                                class="fas fa-align-left mr-1"></i> Mô tả chi tiết</span>
                    </div>
                    <div class="card-body p-3">
                        <div id="modal-description" class="text-dark small"
                            style="max-height: 150px; overflow-y: auto; line-height: 1.6;">
                            <!-- Dữ liệu mô tả đổ vào đây -->
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer bg-white border-0">
                <button class="btn btn-secondary px-4 shadow-sm" type="button" data-dismiss="modal"
                    style="border-radius: 8px;">Đóng</button>
                {{-- Bạn có thể thêm nút Sửa nhanh ở đây nếu muốn --}}
            </div>
        </div>
    </div>
</div>

<style>
    /* Tùy chỉnh thanh cuộn cho phần mô tả */
    #modal-description::-webkit-scrollbar {
        width: 5px;
    }

    #modal-description::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    #modal-description::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }

    #modal-description::-webkit-scrollbar-thumb:hover {
        background: #bbb;
    }

    /* Hiệu ứng mượt cho Modal */
    .modal.fade .modal-dialog {
        transform: scale(0.9);
        transition: transform 0.3s ease-out;
    }

    .modal.show .modal-dialog {
        transform: scale(1);
    }
</style>
