@extends('admin.layouts')

@section('title', 'Quản lý gói cước')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Quản lý gói cước</h1>
        <div>
            <a href="{{ route('admin.packages.create') }}" class="btn btn-sm btn-primary shadow-sm border-0"
                style="border-radius: 8px;">
                <i class="fas fa-plus fa-sm text-white-50"></i> Thêm mới gói cước
            </a>
            <a href="{{ route('admin.packages.trash') }}" class="btn btn-sm btn-outline-danger shadow-sm border-0 ml-2"
                style="border-radius: 8px;">
                <i class="fas fa-trash-alt fa-sm"></i> Thùng rác ({{ $trashedCount }})
            </a>
        </div>
    </div>

    {{-- Hiển thị thông báo --}}

    <!-- Bộ lọc tìm kiếm -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <form action="{{ route('admin.packages.index') }}" method="GET" class="row g-3">
                <div class="col-md-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white border-right-0"><i
                                    class="fas fa-search text-muted"></i></span>
                        </div>
                        <input type="text" name="search" class="form-control border-left-0"
                            placeholder="Tìm kiếm theo tên gói cước hoặc nhà mạng..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block shadow-sm">Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bảng danh sách gói cước -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header py-3 bg-white border-bottom d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Dữ liệu gói cước</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light text-secondary small text-uppercase">
                        <tr>
                            <th width="5%">STT</th>
                            <th width="25%">Gói cước</th>
                            <th width="15%">Nhà mạng / Loại</th>
                            <th width="15%">Giá / Hạn</th>
                            <th width="15%">Trạng thái</th>
                            <th width="25%" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($packages as $package)
                            <tr>
                                <td class="align-middle font-weight-bold">#{{ $loop->iteration }}</td>
                                <td class="align-middle">
                                    <div class="font-weight-bold text-dark mb-0">{{ $package->name }}</div>
                                    <small class="text-muted"><i class="fas fa-link fa-xs"></i>
                                        /{{ $package->slug }}</small><br>
                                    <span> {{ $package->category->name }}</span>
                                </td>
                                <td class="align-middle">
                                    @if ($package->carrier)
                                        <img src="{{ asset('carrier/carrier_' . strtolower($package->carrier) . '.png') }}"
                                            alt="{{ $package->carrier }}" title="{{ strtoupper($package->carrier) }}"
                                            style="height: 30px; width: auto; margin-right: 8px;">
                                    @else
                                        <span class="text-muted">Không xác định</span>
                                    @endif
                                    <br>
                                    <small
                                        class="text-dark">{{ $package->payment_type == 'tra_truoc' ? 'Trả trước' : 'Trả sau' }}</small>
                                </td>
                                <td class="align-middle">
                                    <div class="text-danger font-weight-bold">{{ number_format($package->price) }}w</div>
                                    <small class="text-muted">{{ $package->duration_days }} ngày</small>
                                </td>
                                <td class="align-middle">
                                    {{-- Nút Toggle Active --}}
                                    <form action="{{ route('admin.packages.toggleActive', $package->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm p-0 border-0" title="Click để thay đổi">
                                            @if ($package->is_active)
                                                <span class="badge badge-success px-3 py-2"
                                                    style="border-radius: 20px; cursor: pointer;">
                                                    <i class="fas fa-check-circle mr-1"></i> Hoạt động
                                                </span>
                                            @else
                                                <span class="badge badge-secondary px-3 py-2"
                                                    style="border-radius: 20px; cursor: pointer;">
                                                    <i class="fas fa-eye-slash mr-1"></i> Tạm ẩn
                                                </span>
                                            @endif
                                        </button>
                                    </form>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group shadow-sm" role="group">
                                        {{-- Nút Xem chi tiết --}}
                                        <button type="button" class="btn btn-white btn-sm" data-toggle="modal"
                                            data-target="#packageDetailModal" data-name="{{ $package->name }}"
                                            data-slug="{{ $package->slug }}"
                                            data-carrier="{{ strtoupper($package->carrier) }}"
                                            data-price="{{ number_format($package->price) }}đ"
                                            data-duration="{{ $package->duration_days }} ngày"
                                            data-payment="{{ $package->payment_type == 'tra_truoc' ? 'Trả trước' : 'Trả sau' }}"
                                            data-sim="{{ $package->sim_type == 'hop_phap' ? 'Hợp pháp' : 'Bất hợp pháp' }}"
                                            data-inv_status="{{ $package->status == 'con_hang' ? 'Còn hàng' : 'Hết hàng' }}"
                                            data-description="{{ $package->description ?? 'Không có mô tả.' }}"
                                            data-spec="{{ json_encode($package->specifications) }}"
                                            data-status="{{ $package->is_active ? 'Hoạt động' : 'Tạm ẩn' }}"
                                            data-created="{{ $package->created_at->format('H:i:s d/m/Y') }}"
                                            title="Xem chi tiết">
                                            <i class="fas fa-eye text-info"></i>
                                        </button>

                                        {{-- Nút Sửa --}}
                                        <a href="{{ route('admin.packages.edit', $package->id) }}"
                                            class="btn btn-white btn-sm" title="Chỉnh sửa">
                                            <i class="fas fa-edit text-warning"></i>
                                        </a>

                                        {{-- Nút Xóa --}}
                                        <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa gói cước này không?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-white btn-sm" title="Xóa">
                                                <i class="fas fa-trash-alt text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3"></i>
                                    <p>Chưa có dữ liệu gói cước.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $packages->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    {{-- Import Modal chi tiết --}}
    @include('admin.packages.detail_modal')

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#packageDetailModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var modal = $(this);

                var carrierCode = button.data('carrier')
                    .toLowerCase(); // ép về chữ thường: sk, kt, hoặc lgu

                // 1. Cập nhật text tên nhà mạng
                modal.find('#modal-carrier').text(carrierCode.toUpperCase());

                // 2. Cập nhật ảnh nhà mạng
                var imgPath = "{{ asset('carrier/carrier_') }}" + carrierCode + ".png";
                var carrierImg = modal.find('#modal-carrier-img');

                if (carrierCode) {
                    carrierImg.attr('src', imgPath).show(); // Gán src và hiển thị ảnh
                } else {
                    carrierImg.hide(); // Ẩn nếu không có dữ liệu
                }

                modal.find('.modal-title').html('<i class="fas fa-box-open mr-2"></i> Chi tiết: ' + button
                    .data('name'));
                modal.find('#modal-name').text(button.data('name'));
                modal.find('#modal-slug').text(button.data('slug'));
                modal.find('#modal-carrier').text(button.data('carrier'));
                modal.find('#modal-price').text(button.data('price'));
                modal.find('#modal-duration').text(button.data('duration'));
                modal.find('#modal-payment').text(button.data('payment'));
                modal.find('#modal-sim').text(button.data('sim'));
                modal.find('#modal-inv-status').text(button.data('inv_status'));
                modal.find('#modal-description').html(button.data('description').replace(/\n/g, '<br>'));
                modal.find('#modal-created').text(button.data('created'));

                // Hiển thị trạng thái active
                var statusHTML = button.data('status') === 'Hoạt động' ?
                    '<span class="badge badge-success px-3 py-1" style="border-radius:20px;">Hoạt động</span>' :
                    '<span class="badge badge-secondary px-3 py-1" style="border-radius:20px;">Tạm ẩn</span>';
                modal.find('#modal-status').html(statusHTML);

                // Xử lý specifications JSON
                var spec = button.data('spec');
                var specHTML = "";
                if (spec) {
                    if (typeof spec === 'object') {
                        for (const [key, value] of Object.entries(spec)) {
                            specHTML += `<li><strong>${key}:</strong> ${value}</li>`;
                        }
                    } else {
                        specHTML = spec;
                    }
                }
                modal.find('#modal-spec').html(specHTML || 'Không có thông số kỹ thuật.');
            });
        });
    </script>
@endpush
