@extends('admin.layouts')

@section('title', 'Quản lý dung lượng')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">Quản Lý Dung Lượng</h1>
            <p class="text-muted small">Quản lý các mức RAM/Bộ nhớ trong (VD: 8GB/128GB).</p>
        </div>
        <button class="btn btn-primary shadow-sm px-4" style="border-radius: 10px;" data-toggle="modal"
            data-target="#addSizeModal">
            <i class="fas fa-plus-circle mr-1"></i> Thêm mới
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light text-uppercase small font-weight-bold">
                        <tr>
                            <th class="text-center" width="80">STT</th>
                            <th>Dung lượng</th>
                            <th>Mô tả</th>
                            <th class="text-center">Số sản phẩm</th>
                            <th class="text-center" width="150">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sizes as $size)
                            <tr>
                                <td class="text-center text-muted">#{{ $loop->iteration }}</td>
                                <td class="font-weight-bold text-primary">{{ $size->name }}</td>
                                <td class="text-muted small">{{ $size->description ?: '---' }}</td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-light border">{{ $size->variants_count }}</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light border edit-size" data-id="{{ $size->id }}"
                                        data-name="{{ $size->name }}" data-desc="{{ $size->description }}"
                                        data-toggle="modal" data-target="#editSizeModal">
                                        <i class="fas fa-pen text-warning"></i>
                                    </button>
                                    <form action="{{ route('admin.sizes.destroy', $size->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light border"
                                            onclick="return confirm('Xóa mục này?')">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">Chưa có dữ liệu.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Thêm -->
    <div class="modal fade" id="addSizeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <form action="{{ route('admin.sizes.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title font-weight-bold">Thêm dung lượng</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tên dung lượng (VD: 12GB/256GB)</label>
                            <input type="text" name="name" class="form-control" required placeholder="Nhập tên...">
                        </div>
                        <div class="form-group">
                            <label>Ghi chú / Mô tả</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Sửa -->
    <div class="modal fade" id="editSizeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <form id="editSizeForm" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title font-weight-bold">Sửa dung lượng</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tên dung lượng</label>
                            <input type="text" name="name" id="edit_size_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea name="description" id="edit_size_desc" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.edit-size').on('click', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const desc = $(this).data('desc');

                $('#edit_size_name').val(name);
                $('#edit_size_desc').val(desc);
                $('#editSizeForm').attr('action', `/admin/sizes/${id}`);
            });
        });
    </script>
@endpush
