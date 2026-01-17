@extends('admin.layouts')

@section('title', 'Quản lý màu sắc')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">Danh Mục Màu Sắc</h1>
            <p class="text-muted small">Quản lý các tông màu cho biến thể sản phẩm.</p>
        </div>
        <button class="btn btn-primary shadow-sm px-4" style="border-radius: 10px;" data-toggle="modal"
            data-target="#addColorModal">
            <i class="fas fa-plus-circle mr-1"></i> Thêm màu mới
        </button>
    </div>

    {{-- @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger border-0 shadow-sm">{{ session('error') }}</div>
    @endif --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light text-uppercase small font-weight-bold">
                                <tr>
                                    <th class="text-center" width="80">STT</th>
                                    <th>Tên màu</th>
                                    <th>Mã màu</th>
                                    <th class="text-center">Minh họa</th>
                                    <th class="text-center">Sử dụng</th>
                                    <th class="text-center" width="150">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($colors as $color)
                                    <tr>
                                        <td class="text-center text-muted">#{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">{{ $color->name }}</td>
                                        <td><code>{{ strtoupper($color->hex_code) }}</code></td>
                                        <td class="text-center">
                                            <div
                                                style="width: 30px; height: 30px; border-radius: 6px; background-color: {{ $color->hex_code }}; display: inline-block; border: 1px solid #ddd;">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-pill badge-light border text-primary">
                                                {{ $color->variants_count }} sản phẩm
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-light border edit-color"
                                                data-id="{{ $color->id }}" data-name="{{ $color->name }}"
                                                data-hex="{{ $color->hex_code }}" data-toggle="modal"
                                                data-target="#editColorModal">
                                                <i class="fas fa-pen text-warning"></i>
                                            </button>

                                            <form action="{{ route('admin.colors.destroy', $color->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light border"
                                                    onclick="return confirm('Xóa màu này?')">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">Chưa có dữ liệu màu sắc.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3">
                        {{ $colors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Thêm Màu -->
    <div class="modal fade" id="addColorModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow">
                <form action="{{ route('admin.colors.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title font-weight-bold">Thêm màu sắc mới</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Tên màu (VD: Xanh Ocean)</label>
                            <input type="text" name="name" class="form-control" placeholder="Nhập tên màu..."
                                required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Chọn màu hiển thị</label>
                            <input type="color" name="hex_code" class="form-control" style="height: 45px;"
                                value="#000000">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Sửa Màu (Tương tự nhưng có ID động) -->
    <div class="modal fade" id="editColorModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow">
                <form id="editColorForm" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title font-weight-bold">Chỉnh sửa màu sắc</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Tên màu</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Mã màu</label>
                            <input type="color" name="hex_code" id="edit_hex" class="form-control"
                                style="height: 45px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Hủy</button>
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
            $('.edit-color').on('click', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const hex = $(this).data('hex');

                $('#edit_name').val(name);
                $('#edit_hex').val(hex);
                $('#editColorForm').attr('action', `/admin/colors/${id}`);
            });
        });
    </script>
@endpush
