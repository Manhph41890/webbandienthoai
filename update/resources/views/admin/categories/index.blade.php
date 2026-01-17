@extends('admin.layouts')

@section('title', 'Quản lý Chuyên mục')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Quản lý Chuyên mục</h1>
        <div>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary shadow-sm border-0"
                style="border-radius: 8px;">
                <i class="fas fa-plus fa-sm text-white-50"></i> Thêm mới chuyên mục
            </a>
            <a href="{{ route('admin.categories.trash') }}" class="btn btn-sm btn-outline-danger shadow-sm border-0"
                style="border-radius: 8px;">
                <i class="fas fa-trash-alt fa-sm"></i> Thùng rác ({{ $trashedCount }})
            </a>
        </div>
    </div>

    {{-- Hiển thị thông báo thành công/lỗi --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Bộ lọc tìm kiếm (Đồng bộ với trang Phones) -->
    @include('admin.categories.filter')

    <!-- Bảng danh sách Chuyên mục -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header py-3 bg-white border-bottom d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Dữ liệu Chuyên mục</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light text-secondary small text-uppercase">
                        <tr>
                            <th width="5%">STT</th>
                            <th width="35%">Chuyên mục</th>
                            <th width="25%">Chuyên mục cha</th>
                            <th width="15%">Trạng thái</th>
                            <th width="20%" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td class="align-middle font-weight-bold">#{{ $loop->iteration }}</td>
                                <td class="align-middle">
                                    <div class="font-weight-bold text-dark mb-0">{{ $category->name }}</div>
                                    <small class="text-muted"><i class="fas fa-link fa-xs"></i>
                                        /{{ $category->slug }}</small>
                                </td>
                                <td class="align-middle">
                                    @if ($category->parent)
                                        <span class="badge badge-light border px-2 py-1">
                                            <i class="fas fa-level-up-alt fa-rotate-90 text-primary mr-1"></i>
                                            {{ $category->parent->name }}
                                        </span>
                                    @else
                                        <span class="text-muted small italic">Không có (Cấp cha)</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if ($category->is_active)
                                        <span class="badge badge-success px-3 py-2" style="border-radius: 20px;">
                                            <i class="fas fa-check-circle mr-1"></i> Hoạt động
                                        </span>
                                    @else
                                        <span class="badge badge-secondary px-3 py-2" style="border-radius: 20px;">
                                            <i class="fas fa-eye-slash mr-1"></i> Tạm ẩn
                                        </span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group shadow-sm" role="group">
                                        {{-- Nút Xem chi tiết --}}
                                        <button type="button" class="btn btn-white btn-sm" data-toggle="modal"
                                            data-target="#categoryDetailModal" data-name="{{ $category->name }}"
                                            data-slug="{{ $category->slug }}"
                                            data-description="{{ $category->description ?? 'Không có mô tả.' }}"
                                            data-parent="{{ $category->parent->name ?? '—' }}"
                                            data-status="{{ $category->is_active ? 'Hoạt động' : 'Tạm ẩn' }}"
                                            data-created="{{ $category->created_at->format('H:i:s d/m/Y') }}"
                                            title="Xem chi tiết">
                                            <i class="fas fa-eye text-info"></i>
                                        </button>

                                        {{-- Nút Sửa --}}
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="btn btn-white btn-sm" title="Chỉnh sửa">
                                            <i class="fas fa-edit text-warning"></i>
                                        </a>

                                        {{-- Nút Xóa --}}
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa chuyên mục này không?');">
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
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3"></i>
                                    <p>Chưa có dữ liệu chuyên mục.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $categories->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    {{-- Import Modal chi tiết --}}
    @include('admin.categories.detail_modal')

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Xử lý dữ liệu đổ vào Modal
            $('#categoryDetailModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var modal = $(this);

                modal.find('.modal-title').html('<i class="fas fa-folder-open mr-2"></i> Chi tiết: ' +
                    button.data('name'));
                modal.find('#modal-name').text(button.data('name'));
                modal.find('#modal-slug').text(button.data('slug'));
                modal.find('#modal-description').html(button.data('description').replace(/\n/g, '<br>'));
                modal.find('#modal-parent').text(button.data('parent'));

                var statusHTML = button.data('status') === 'Hoạt động' ?
                    '<span class="badge badge-success px-3 py-2" style="border-radius:20px;">Hoạt động</span>' :
                    '<span class="badge badge-secondary px-3 py-2" style="border-radius:20px;">Tạm ẩn</span>';

                modal.find('#modal-status').html(statusHTML);
                modal.find('#modal-created').text(button.data('created'));
            });
        });
    </script>
@endpush
