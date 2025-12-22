{{-- resources/views/admin/categories/detail_modal.blade.php --}}
<div class="modal fade" id="categoryDetailModal" tabindex="-1" role="dialog" aria-labelledby="categoryDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="categoryDetailModalLabel">Chi tiết Chuyên mục</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 150px;">Tên chuyên mục</th>
                            <td id="modal-name"></td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td><code id="modal-slug"></code></td>
                        </tr>
                        <tr>
                            <th>Chuyên mục cha</th>
                            <td id="modal-parent"></td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td id="modal-status"></td>
                        </tr>
                        <tr>
                            <th>Ngày tạo</th>
                            <td id="modal-created"></td>
                        </tr>
                        <tr>
                            <th colspan="2">Mô tả</th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="modal-description" style="max-height: 200px; overflow-y: auto;"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>