@extends('admin.layouts')

@section('title', 'Thùng rác Bài viết')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thùng rác Bài viết</h1>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Quay lại danh sách
        </a>
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

    <!-- Bảng dữ liệu -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Các bài viết đã xóa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Tác giả</th>
                            <th>Chuyên mục</th>
                            <th>Ngày xóa</th>
                            <th style="width: 130px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($trashedPosts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->author->name ?? 'N/A' }}</td>
                                <td>{{ $post->category->name ?? 'N/A' }}</td>
                                <td>{{ $post->deleted_at->format('H:i d/m/Y') }}</td>
                                <td>
                                    {{-- Nút Khôi phục --}}
                                    <form action="{{ route('posts.restore', $post->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm" title="Khôi phục">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>

                                    {{-- Nút Xóa vĩnh viễn --}}
                                    <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn XÓA VĨNH VIỄN bài viết này không? Hành động này không thể hoàn tác.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Xóa vĩnh viễn">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Thùng rác trống.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $trashedPosts->links() }}
            </div>
        </div>
    </div>

@endsection
