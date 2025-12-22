@extends('admin.layouts')

@section('title', 'Quản lý Thương hiệu Điện thoại')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách Thương hiệu</h1>
        <div>
            {{-- <a href="{{ route('admin.categories.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Thêm Thương hiệu
            </a> --}}
        </div>
    </div>

    {{-- Hiển thị thông báo --}}
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

    <!-- Search Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tìm kiếm Thương hiệu</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Nhập tên hoặc mô tả thương hiệu..."
                        value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i> Tìm kiếm
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Dữ liệu Thương hiệu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 50px;">ID</th>
                            <th>Tên Thương hiệu</th>
                            <th>Mô tả</th>
                            <th>Số lượng Điện thoại</th>
                            <th>Ngày tạo</th>
                            <th style="width: 130px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $categorie)
                            <tr>
                                <td>{{ $categorie->id }}</td>
                                <td>
                                    <strong>{{ $categorie->name }}</strong>
                                </td>
                                <td>{{ Str::limit($categorie->description, 100) }}</td> {{-- Giới hạn độ dài mô tả --}}
                                <td>{{ $categorie->phones_count ?? 0 }}</td>
                                <td>{{ $categorie->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $categorie->id) }}"
                                        class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $categorie->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này? Tất cả điện thoại thuộc thương hiệu này cũng sẽ bị xóa (do onDelete cascade).');">
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
                                <td colspan="6" class="text-center">
                                    @if (request('search'))
                                        Không tìm thấy thương hiệu nào với từ khóa "{{ request('search') }}".
                                    @else
                                        Chưa có thương hiệu nào.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{-- {{ $categories->links() }} --}}
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{-- Có thể thêm JS riêng cho trang này nếu cần --}}
@endpush