@extends('admin.layouts')

@section('title', 'Quản lý điện thoại')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Quản lý sản phẩm Điện thoại</h1>
        <div>
            <a href="{{ route('admin.phones.create') }}" class="btn btn-sm btn-primary shadow-sm border-0"
                style="border-radius: 8px;">
                <i class="fas fa-plus fa-sm text-white-50"></i> Thêm sản phẩm mới
            </a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-danger shadow-sm border-0"
                style="border-radius: 8px;">
                <i class="fas fa-trash-alt fa-sm"></i> Thùng rác ({{ $trashedCount }})
            </a>
        </div>
    </div>

    {{-- Thông báo --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Bộ lọc tìm kiếm -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <form action="{{ route('admin.phones.index') }}" method="GET" class="row g-3">
                <div class="col-md-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white border-right-0"><i
                                    class="fas fa-search text-muted"></i></span>
                        </div>
                        <input type="text" name="search" class="form-control border-left-0"
                            placeholder="Tìm kiếm theo tên sản phẩm hoặc danh mục..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bảng danh sách -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header py-3 bg-white border-bottom">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr class="text-secondary small text-uppercase">
                            <th width="5%">STT</th>
                            <th width="10%">Hình ảnh</th>
                            <th width="25%">Sản phẩm</th>
                            <th width="20%">Khoảng giá</th>
                            <th width="15%">Kho hàng</th>
                            <th width="10%">Tình trạng</th>
                            <th width="10%" class="text-center">Hiển thị</th>
                            <th width="15%" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($phones as $phone)
                            <tr>
                                <td class="align-middle font-weight-bold">#{{ $loop->iteration }}</td>
                                <td class="align-middle text-center">
                                    @if ($phone->main_image)
                                        <img src="{{ Storage::url($phone->main_image) }}" alt="{{ $phone->name }}"
                                            width="60" class="rounded shadow-sm">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="width:60px; height:60px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <div class="font-weight-bold text-dark mb-0">{{ $phone->name }}</div>
                                    <small
                                        class="badge badge-light border text-muted">{{ $phone->category->name ?? 'N/A' }}</small>
                                </td>
                                <td class="align-middle">
                                    @if ($phone->variants->count() > 0)
                                        <span class="text-danger font-weight-bold">
                                            {{ number_format($phone->variants->min('price'), 0, ',', '.') }}đ
                                        </span>
                                        @if ($phone->variants->min('price') != $phone->variants->max('price'))
                                            <small class="text-muted">-
                                                {{ number_format($phone->variants->max('price'), 0, ',', '.') }}đ</small>
                                        @endif
                                    @else
                                        <span class="text-muted small italic">Chưa có giá</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @php $totalStock = $phone->variants->sum('stock'); @endphp
                                    <div class="mb-1">Tổng: <strong>{{ $totalStock }}</strong></div>
                                    @if ($totalStock <= 0)
                                        <span class="badge badge-danger">Hết hàng</span>
                                    @elseif($totalStock <= 5)
                                        <span class="badge badge-warning">Sắp hết hàng</span>
                                    @else
                                        <span class="badge badge-success">Còn hàng</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    {{-- Hiển thị tóm tắt tình trạng máy --}}
                                    @php
                                        $hasNew = $phone->variants->where('condition', 'new')->count();
                                        $hasUsed = $phone->variants->where('condition', 'used')->count();
                                    @endphp
                                    @if ($hasNew)
                                        <div class="small text-success"><i class="fas fa-check-circle"></i> Máy mới</div>
                                    @endif
                                    @if ($hasUsed)
                                        <div class="small text-warning"><i class="fas fa-history"></i> Máy cũ</div>
                                    @endif
                                </td>

                                <td class="align-middle text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input change-status"
                                            id="customSwitch{{ $phone->id }}" data-id="{{ $phone->id }}"
                                            {{ $phone->is_active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customSwitch{{ $phone->id }}"></label>
                                    </div>
                                </td>

                                <td class="align-middle text-center">
                                    <div class="btn-group shadow-sm" role="group">
                                        <button class="btn btn-white btn-sm view-phone-detail"
                                            data-id="{{ $phone->id }}" title="Xem chi tiết" data-toggle="modal"
                                            data-target="#phoneDetailModal">
                                            <i class="fas fa-eye text-info"></i>
                                        </button>
                                        <a href="{{ route('admin.phones.edit', $phone->id) }}"
                                            class="btn btn-white btn-sm" title="Chỉnh sửa">
                                            <i class="fas fa-edit text-warning"></i>
                                        </a>
                                        <form action="{{ route('admin.phones.destroy', $phone->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-white btn-sm" title="Xóa"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-box-open fa-3x mb-3"></i>
                                    <p>Không tìm thấy sản phẩm nào.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $phones->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Chi tiết -->
    <div class="modal fade" id="phoneDetailModal" tabindex="-1" role="dialog" aria-labelledby="phoneDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" style="max-width: 70%; min-height: 70%;"
            role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="phoneDetailModalLabel"><i class="fas fa-info-circle mr-2"></i> Chi tiết
                        sản phẩm</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light" id="phoneDetailContent">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Đang tải...</span>
                        </div>
                        <p class="mt-2 text-muted">Đang lấy dữ liệu từ hệ thống...</p>
                    </div>
                </div>
                <div class="modal-footer bg-white border-0">
                    <button type="button" class="btn btn-secondary shadow-sm" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

@endsection

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
        });
    </script>
@endpush
