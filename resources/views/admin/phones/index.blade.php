@extends('admin.layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách sản phẩm</h1>
        <div>
            <a href="{{ route('admin.products.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Thêm sản phẩm
            </a>
        </div>
    </div>

    {{-- Hiển thị thông báo thành công/lỗi --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tìm kiếm sản phẩm</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-auto">
                    <input type="text" name="search" class="form-control"
                        placeholder="Tìm theo tên sản phẩm, danh mục..." value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
                @if (request('search'))
                    <div class="col-auto">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Xóa tìm kiếm</a>
                    </div>
                @endif
            </form>
        </div> 
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ảnh chính</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Giá từ</th>
                            <th>Tồn kho tổng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if ($product->main_image)
                                        <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->name }}"
                                            width="50">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td>
                                    @if ($product->lowestPriceVariant)
                                        {{ number_format($product->lowestPriceVariant->price, 0, ',', '.') }} VNĐ
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    {{ $product->variants->sum('stock') }}
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm view-product-detail" data-id="{{ $product->id }}"
                                        data-bs-toggle="modal" data-bs-target="#productDetailModal">
                                        <i class="fas fa-eye"></i> Chi tiết
                                    </button>
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không? Tất cả biến thể và hình ảnh liên quan sẽ bị xóa!')">
                                            <i class="fas fa-trash"></i> Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Không có sản phẩm nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <!-- Product Detail Modal -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailModalLabel">Chi tiết sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="productDetailContent">
                    <!-- Nội dung chi tiết sản phẩm sẽ được tải vào đây bằng AJAX -->
                    Đang tải...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Script để xử lý hiển thị modal chi tiết sản phẩm bằng AJAX
            $(document).ready(function() {
                $('.view-product-detail').on('click', function() {
                    const productId = $(this).data('id');
                    const modalBody = $('#productDetailContent');

                    modalBody.html('<p>Đang tải chi tiết sản phẩm...</p>'); // Hiển thị trạng thái tải

                    $.ajax({
                        url: `/products/${productId}`, // Sử dụng route show của ProductController
                        method: 'GET',
                        success: function(response) {
                            // Cập nhật nội dung modal với dữ liệu từ response
                            modalBody.html(response);
                        },
                        error: function(xhr, status, error) {
                            modalBody.html(
                                '<p class="text-danger">Không thể tải chi tiết sản phẩm. Vui lòng thử lại sau.</p>'
                            );
                            console.error("AJAX Error: ", status, error, xhr.responseText);
                        }
                    });
                });
            });
        </script>
    @endpush

@endsection
