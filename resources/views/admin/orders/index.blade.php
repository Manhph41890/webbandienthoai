@extends('admin.layouts')
@section('title', 'Quản lý Đơn hàng - Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Quản lý Đơn hàng</h1>
        <p class="mb-4">Danh sách tất cả các đơn hàng trong hệ thống.</p>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách Đơn hàng</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã ĐH</th>
                                <th>Khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>PT Thanh toán</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bills as $bill)
                                <tr>
                                    <td>#{{ $bill->id }}</td>
                                    <td>{{ $bill->customer_name }} ({{ $bill->user->name ?? 'N/A' }})</td>
                                    <td>{{ number_format($bill->total_amount, 0, ',', '.') }} VNĐ</td>
                                    <td>{{ $bill->order_date->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $bill->status == \App\Models\Order::STATUS_PENDING
                                                ? 'badge-warning'
                                                : ($bill->status == \App\Models\Order::STATUS_PROCESSING
                                                    ? 'badge-info'
                                                    : ($bill->status == \App\Models\Order::STATUS_SHIPPED
                                                        ? 'badge-primary'
                                                        : ($bill->status == \App\Models\Order::STATUS_DELIVERED
                                                            ? 'badge-success'
                                                            : 'badge-danger'))) }}">
                                            {{ $bill->status_name }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($bill->payment_method == 'cod')
                                            Thanh toán khi nhận hàng
                                        @elseif ($bill->payment_method == 'bank_transfer')
                                            Chuyển khoản ngân hàng
                                        @elseif ($bill->payment_method == 'e_wallet')
                                            Ví điện tử
                                        @else
                                            Chưa xác định
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.bills.show', $bill->id) }}" class="btn btn-info btn-sm">Chi
                                            tiết</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Không có đơn hàng nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $bills->links('pagination::bootstrap-4') }} {{-- Sử dụng phân trang Bootstrap 4 --}}
                </div>
            </div>
        </div>

    </div>
@endsection
