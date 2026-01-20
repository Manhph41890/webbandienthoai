<style>
    /* Tổng thể */
    .breadcrumb-area {
        background: none;
    }

    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    /* Table Styling */
    .table thead th {
        background-color: #f8f9fc;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1px;
        border-bottom: 2px solid #ebeef5;
        color: #5a5c69;
        font-weight: 700;
    }

    .table tbody tr {
        transition: all 0.2s;
    }

    .table tbody tr:hover {
        background-color: #f1f4f9 !important;
    }

    /* Product Image */
    .img-container {
        width: 60px;
        height: 60px;
        overflow: hidden;
        border: 1px solid #eee;
        transition: transform 0.3s;
    }

    .img-container:hover {
        transform: scale(1.1);
    }

    /* Custom Badges */
    .badge-pro {
        padding: 5px 12px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 11px;
    }

    .badge-stock-in {
        background: #e6fffa;
        color: #047481;
    }

    .badge-stock-low {
        background: #fffaf0;
        color: #9c4221;
    }

    .badge-stock-out {
        background: #fff5f5;
        color: #9b2c2c;
    }

    /* Action Buttons */
    .btn-action {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        margin: 0 2px;
        transition: all 0.3s;
        border: 1px solid #e3e6f0;
        background: #fff;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Custom Switch */
    .custom-control-input:checked~.custom-control-label::before {
        background-color: #ff4d6d;
        /* Màu Red thương hiệu */
        border-color: #ff4d6d;
    }

    /* Price tag */
    .price-text {
        font-size: 14px;
        font-weight: 700;
        color: #140000;
        /* Màu Navy */
    }
</style>
@push('scripts')
    <script>
        $(document).ready(function() {
            // Xử lý click xem chi tiết
            $('.view-phone-detail').on('click', function() {
                const phoneId = $(this).data('id');
                const modalBody = $('#phoneDetailContent');

                // Reset modal về trạng thái loading
                modalBody.html(`
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-2 text-muted">Đang tải chi tiết sản phẩm...</p>
                    </div>
                `);

                // Gọi AJAX
                $.ajax({
                    url: `/admin/phones/${phoneId}`,
                    method: 'GET',
                    success: function(response) {
                        // Chèn HTML nhận được từ server vào modal body
                        modalBody.html(response);
                    },
                    error: function(xhr) {
                        modalBody.html(`
                            <div class="alert alert-danger m-3">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Không thể tải thông tin. Lỗi: ${xhr.status} - ${xhr.statusText}
                            </div>
                        `);
                    }
                });
            });
            $('.change-status').on('change', function() {
                const phoneId = $(this).data('id');
                const isChecked = $(this).is(':checked');

                $.ajax({
                    url: `/admin/phones/${phoneId}/change-status`,
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Hiển thị thông báo nhỏ (Toast) nếu muốn
                            console.log(response.message);
                        }
                    },
                    error: function() {
                        alert('Không thể cập nhật trạng thái. Vui lòng thử lại!');
                        // Trả lại trạng thái cũ nếu lỗi
                        $(this).prop('checked', !isChecked);
                    }
                });
            });

            $('.toggle-featured').change(function() {
                let is_featured = $(this).prop('checked') ? 1 : 0;
                let phone_id = $(this).data('id');
                let label = $(this).siblings('label').find('i');
                let url = "{{ route('admin.phones.toggle-featured', ':id') }}".replace(':id', phone_id);

                $.ajax({
                    type: "PATCH",
                    url: url,
                    data: {
                        _token: "{{ csrf_token() }}",
                        is_featured: is_featured
                    },
                    success: function(data) {
                        // Hiệu ứng đổi màu ngôi sao ngay lập tức
                        if (is_featured) {
                            label.removeClass('text-light').addClass('text-warning');
                        } else {
                            label.removeClass('text-warning').addClass('text-light');
                        }
                    },
                    error: function() {
                        alert('Có lỗi xảy ra!');
                        $(this).prop('checked', !is_featured);
                    }
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
