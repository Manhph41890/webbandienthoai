@extends('admin.layouts')

@section('title', 'Quản lý điện thoại')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">Kho Sản Phẩm</h1>
            <p class="text-muted small">Quản lý kho hàng và trạng thái hiển thị của các dòng điện thoại.</p>
        </div>
        <div>
            <a href="{{ route('admin.phones.trash') }}" class="btn btn-sm btn-light border text-danger mr-2">
                <i class="fas fa-trash-alt mr-1"></i> Thùng rác ({{ $trashedCount }})
            </a>
            <a href="{{ route('admin.phones.create') }}" class="btn btn-sm btn-primary shadow-sm px-3"
                style="border-radius: 10px; background: #140000; border: none;">
                <i class="fas fa-plus-circle mr-1"></i> Thêm sản phẩm mới
            </a>
        </div>
    </div>

    {{-- Bộ lọc (Đảm bảo file filter cũng được làm lại cho gọn) --}}
    @include('admin.phones.filter')

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th>Sản phẩm</th>
                            <th class="text-center">Thống kê</th>
                            <th>Giá niêm yết</th>
                            <th>Kho hàng</th>
                            <th>Phân loại</th>
                            <th class="text-center">Hiển thị</th>
                            <th class="text-center">Nổi bật</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($phones as $phone)
                            <tr>
                                <td class="text-center text-muted small">#{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="img-container mr-3 shadow-sm">
                                            <img src="{{ $phone->main_image ? Storage::url($phone->main_image) : asset('images/default-phone.png') }}"
                                                class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div>
                                            <div class="font-weight-bold text-dark">{{ $phone->name }}</div>
                                            <span class="text-muted" style="font-size: 13px;">
                                                <i class="fas fa-tag mr-1"></i>{{ $phone->category->name ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="small font-weight-bold text-primary">
                                        <i class="fas fa-eye mr-1"></i>{{ number_format($phone->views_count ?? 0) }}
                                    </div>
                                    <div class="small text-muted" style="font-size: 12px;">Lượt xem</div>
                                </td>
                                <td>
                                    @if ($phone->variants->count() > 0)
                                        <div class="price-text text-danger">
                                            {{ number_format($phone->variants->min('price'), 0, ',', '.') }}
                                            <small>w</small>
                                        </div>
                                        @if ($phone->variants->min('price') != $phone->variants->max('price'))
                                            <div class="text-muted small" style="font-size: 10px;">đến
                                                {{ number_format($phone->variants->max('price'), 0, ',', '.') }} w</div>
                                        @endif
                                    @else
                                        <span class="text-muted small"><em>Liên hệ</em></span>
                                    @endif
                                </td>
                                <td>
                                    @php $totalStock = $phone->total_stock ?? 0; @endphp
                                    <div class="small mb-1">Tồn kho: <strong>{{ $totalStock }}</strong></div>
                                    @if ($totalStock <= 0)
                                        <span class="badge-pro badge-stock-out">Hết hàng</span>
                                    @elseif($totalStock <= 5)
                                        <span class="badge-pro badge-stock-low">Sắp hết</span>
                                    @else
                                        <span class="badge-pro badge-stock-in">Sẵn có</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $hasNew = $phone->variants->where('condition', 'new')->count();
                                        $hasUsed = $phone->variants->where('condition', 'used')->count();
                                    @endphp
                                    <div class="d-flex flex-column gap-1">
                                        @if ($hasNew)
                                            <span class="text-success" style="font-size: 11px;"><i
                                                    class="fas fa-check-circle mr-1"></i>Máy mới</span>
                                        @endif
                                        @if ($hasUsed)
                                            <span class="text-warning" style="font-size: 11px;"><i
                                                    class="fas fa-history mr-1"></i>Máy cũ</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input change-status"
                                            id="status{{ $phone->id }}" data-id="{{ $phone->id }}"
                                            {{ $phone->is_active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status{{ $phone->id }}"></label>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input toggle-featured"
                                            id="feat{{ $phone->id }}" data-id="{{ $phone->id }}"
                                            {{ $phone->is_featured ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="feat{{ $phone->id }}">
                                            <i
                                                class="fas fa-star {{ $phone->is_featured ? 'text-warning' : 'text-light' }}"></i>
                                        </label>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        {{-- <button class="btn-action view-phone-detail" data-id="{{ $phone->id }}"
                                            title="Xem nhanh" data-toggle="modal" data-target="#phoneDetailModal">
                                            <i class="fas fa-eye text-info"></i>
                                        </button> --}}
                                        <button class="btn-action view-phone-detail" data-id="{{ $phone->id }}"
                                            title="Xem chi tiết" data-toggle="modal" data-target="#phoneDetailModal">
                                            <i class="fas fa-eye text-info"></i>
                                        </button>
                                        <a href="{{ route('admin.phones.edit', $phone->id) }}" class="btn-action"
                                            title="Sửa">
                                            <i class="fas fa-pen text-warning"></i>
                                        </a>
                                        <form action="{{ route('admin.phones.destroy', $phone->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-action" title="Xóa"
                                                onclick="return confirm('Đưa sản phẩm vào thùng rác?')">
                                                <i class="fas fa-trash-alt text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <img src="{{ asset('images/empty-box.png') }}" width="80" class="mb-3 opacity-50">
                                    <p class="text-muted">Chưa có sản phẩm nào được đăng tải.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($phones->hasPages())
                <div class="card-footer bg-white border-0 py-4">
                    {{ $phones->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
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
@include('admin.phones.index-lib')
