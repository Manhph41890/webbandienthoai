@extends('admin.layouts')

@section('title', 'Quản lý Chuyên mục')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách Chuyên mục</h1>
        <div class="">
            <a href="{{ route('admin.categories.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Thêm Mới
            </a>
            <a href="{{ route('admin.categories.trash') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-outline-danger shadow-sm">
                <i class="fas fa-trash fa-sm"></i> Thùng rác ({{ $trashedCount }})
            </a>
        </div>

    </div>

    {{-- Hiển thị thông báo (Giữ nguyên) --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Dữ liệu Chuyên mục</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Tên Chuyên mục</th>
                            <th>Chuyên mục cha</th>
                            <th>Trạng thái</th>
                            <th style="width: 130px;">Hành động</th> {{-- Tăng chiều rộng cho cột hành động --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    <strong>{{ $category->name }}</strong>
                                    <br>
                                    <small class="text-muted">/{{ $category->slug }}</small>
                                </td>
                                <td>{{ $category->parent->name ?? '—' }}</td>
                                <td>
                                    @if ($category->is_active)
                                        <span class="badge badge-success">Hoạt động</span>
                                    @else
                                        <span class="badge badge-secondary">Tạm ẩn</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- NÚT XEM CHI TIẾT MỚI --}}
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#categoryDetailModal" data-name="{{ $category->name }}"
                                        data-slug="{{ $category->slug }}"
                                        data-description="{{ $category->description ?? 'Không có mô tả.' }}"
                                        data-parent="{{ $category->parent->name ?? '—' }}"
                                        data-status="{{ $category->is_active ? 'Hoạt động' : 'Tạm ẩn' }}"
                                        data-created="{{ $category->created_at->format('H:i:s d/m/Y') }}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    {{-- Nút Sửa --}}
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Nút Xóa --}}
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa chuyên mục này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Chưa có dữ liệu chuyên mục.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $categories->links() }}
            </div>
        </div>
    </div>


    {{-- THÊM MODAL HIỂN THỊ CHI TIẾT VÀO ĐÂY --}}
    @include('admin.categories.detail_modal')

@endsection


{{-- THÊM SCRIPT ĐỂ XỬ LÝ MODAL --}}
@push('scripts')
    <script>
        // Khi modal chuẩn bị được hiển thị
        $('#categoryDetailModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Nút đã được click

            // Trích xuất thông tin từ các thuộc tính data-*
            var name = button.data('name');
            var slug = button.data('slug');
            var description = button.data('description');
            var parent = button.data('parent');
            var status = button.data('status');
            var created = button.data('created');

            // Cập nhật nội dung của modal
            var modal = $(this);
            modal.find('.modal-title').text('Chi tiết chuyên mục: ' + name);
            modal.find('#modal-name').text(name);
            modal.find('#modal-slug').text(slug);
            modal.find('#modal-description').html(description.replace(/\n/g,
                '<br>')); // Dùng .html() và thay a\n bằng <br> để hiển thị xuống dòng
            modal.find('#modal-parent').text(parent);
            modal.find('#modal-status').html(status === 'Hoạt động' ?
                '<span class="badge badge-success">Hoạt động</span>' :
                '<span class="badge badge-secondary">Tạm ẩn</span>');
            modal.find('#modal-created').text(created);
        });
    </script>
@endpush
