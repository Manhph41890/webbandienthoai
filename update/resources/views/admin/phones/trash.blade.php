@extends('admin.layouts')

@section('title', 'Thùng rác Điện Thoại')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thùng rác Điện Thoại</h1>
        <a href="{{ route('admin.phones.index') }}" class="btn btn-secondary btn-sm shadow-sm">
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
            <h6 class="m-0 font-weight-bold text-primary">Các điện thoại đã xóa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">STT</th>
                            <th width="10%">Hình ảnh</th>
                            <th width="20%">Sản phẩm</th>
                            <th width="15%">Khoảng giá</th>
                            <th width="10%">Kho hàng</th>
                            <th width="10%">Tình trạng</th>
                            <th width="10%">Ngày xóa</th>
                            <th width="20%">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($trashPhones as $key => $phone)
                            <tr>
                                <td class="text-center">{{ $trashPhones->firstItem() + $key }}</td>
                                <td class="text-center">
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
                                <td>
                                    <strong>{{ $phone->name }}</strong><br>
                                    <small class="text-muted">Danh mục: {{ $phone->category->name ?? 'N/A' }}</small>
                                </td>
                                <td>
                                    @if($phone->variants->count() > 0)
                                        {{ number_format($phone->variants->min('price')) }}w - 
                                        {{ number_format($phone->variants->max('price')) }}w
                                    @else
                                        Liên hệ
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $phone->variants->sum('stock') }} cái
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $phone->is_active ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $phone->is_active ? 'Đang bán' : 'Ngừng bán' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <small>{{ $phone->deleted_at->format('H:i d/m/Y') }}</small>
                                </td>
                                <td class="text-center">
                                    {{-- Nút Khôi phục --}}
                                    <form action="{{ route('admin.phones.restore', $phone->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm" title="Khôi phục">
                                            <i class="fas fa-undo"></i> Khôi phục
                                        </button>
                                    </form>

                                    {{-- Nút Xóa vĩnh viễn --}}
                                    <form action="{{ route('admin.phones.forceDelete', $phone->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('XÓA VĨNH VIỄN điện thoại này? Hành động này không thể hoàn tác!');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Xóa vĩnh viễn">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Thùng rác hiện đang trống.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $trashPhones->links() }}
            </div>
        </div>
    </div>

@endsection