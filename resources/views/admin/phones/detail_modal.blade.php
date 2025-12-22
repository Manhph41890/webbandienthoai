<div class="modal fade" id="phoneDetailModal" tabindex="-1" role="dialog" aria-labelledby="phoneDetailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary" id="phoneDetailModalLabel">Chi tiết Điện Thoại
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img id="modal-phone-main_image" src="" class="img-fluid rounded mb-3"
                            alt="Ảnh điện thoại" style="width: 100%; height: auto; object-fit: cover;">
                        <table class="table table-sm table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 120px;">Thương hiệu</th>
                                    <td id="modal-phone-brand"></td>
                                </tr>
                                <tr>
                                    <th>Giá bán</th>
                                    <td id="modal-phone-price"></td>
                                </tr>
                                <tr>
                                    <th>Giá gốc</th>
                                    <td id="modal-phone-original_price"></td>
                                </tr>
                                <tr>
                                    <th>Dung lượng</th>
                                    <td id="modal-phone-storage_capacity"></td>
                                </tr>
                                <tr>
                                    <th>Màu sắc</th>
                                    <td id="modal-phone-color"></td>
                                </tr>
                                <tr>
                                    <th>Số lượng tồn</th>
                                    <td id="modal-phone-quantity"></td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td id="modal-phone-status"></td>
                                </tr>
                                <tr>
                                    <th>Số serial</th>
                                    <td id="modal-phone-serial_number"></td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td id="modal-phone-created_at"></td>
                                </tr>
                                <tr>
                                    <th>Cập nhật cuối</th>
                                    <td id="modal-phone-updated_at"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-8">
                        <h4 id="modal-phone-name" class="font-weight-bold"></h4>
                        <p class="text-muted" id="modal-phone-short_description"></p>
                        <hr>
                        <h6 class="font-weight-bold">Mô tả chi tiết:</h6>
                        <div id="modal-phone-long_description"
                            style="max-height: 200px; overflow-y: auto; margin-bottom: 1rem;">
                            {{-- Mô tả chi tiết sẽ được chèn vào đây bởi JavaScript --}}
                        </div>
                        <h6 class="font-weight-bold">Thông số kỹ thuật:</h6>
                        <div id="modal-phone-specifications" style="max-height: 200px; overflow-y: auto;">
                            {{-- Thông số kỹ thuật sẽ được chèn vào đây bởi JavaScript --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
