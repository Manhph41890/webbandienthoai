@extends('admin.layouts')

@section('title', 'Chi tiết Đơn hàng #' . $bill->id . ' - Admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Chi tiết Đơn hàng #{{ $bill->id }}</h1>
        <a href="{{ route('admin.bills.index') }}" class="btn btn-secondary btn-sm mb-3"><i class="fas fa-arrow-left"></i> Quay
            lại danh sách đơn hàng</a>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Thông tin Đơn hàng</h6>
                    </div>
                    <div class="card-body">
                        <p><strong>Mã đơn hàng:</strong> #{{ $bill->id }}</p>
                        <p><strong>Ngày đặt hàng:</strong> {{ $bill->order_date->format('d/m/Y H:i:s') }}</p>
                        <p><strong>Khách hàng:</strong> {{ $bill->customer_name }} ({{ $bill->user->name ?? 'N/A' }})</p>
                        <p><strong>Số điện thoại:</strong> {{ $bill->customer_phone }}</p>
                        <p><strong>Địa chỉ giao hàng:</strong> {{ $bill->shipping_address }}</p>
                        <p><strong>Phương thức thanh toán:</strong>
                            @if ($bill->payment_method == 'cod')
                                Thanh toán khi nhận hàng
                            @elseif ($bill->payment_method == 'bank_transfer')
                                Chuyển khoản ngân hàng
                            @elseif ($bill->payment_method == 'e_wallet')
                                Ví điện tử
                            @else
                                Chưa xác định
                            @endif
                        </p>
                        <p><strong>Tổng tiền:</strong> <span
                                class="text-danger font-weight-bold">{{ number_format($bill->total_amount, 0, ',', '.') }}
                                VNĐ</span></p>
                        <p><strong>Trạng thái:</strong>
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
                        </p>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Sản phẩm trong đơn hàng</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bill->orderItems as $detail)
                                        <tr>
                                            <td><a
                                                    href="{{ route('admin.phones.show', $detail->phone->id) }}">{{ $detail->phone->title }}</a>
                                            </td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td>{{ number_format($detail->unit_price, 0, ',', '.') }} VNĐ</td>
                                            <td>{{ number_format($detail->subtotal, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-right">Tổng cộng:</th>
                                        <th>{{ number_format($bill->total_amount, 0, ',', '.') }} VNĐ</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Cập nhật Trạng thái</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.bills.updateStatus', $bill->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="status">Trạng thái hiện tại:
                                    <strong>{{ $bill->status_name }}</strong></label>
                                <select name="status" id="status" class="form-control">
                                    @foreach ($statuses as $key => $name)
                                        <option value="{{ $key }}" {{ $bill->status == $key ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
