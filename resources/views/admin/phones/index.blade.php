@extends('admin.layouts')

@section('title', 'Quản lý Điện Thoại')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách Điện Thoại</h1>
        <div>
            <a href="{{ route('admin.phones.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Thêm Điện Thoại
            </a>

            <a href="{{ route('admin.phones.trash') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-outline-danger shadow-sm mr-2">
                <i class="fas fa-trash fa-sm"></i> Thùng rác ({{ $trashedCount }})
            </a>

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

    <!-- Search Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tìm kiếm Điện Thoại</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.phones.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search"
                        placeholder="Nhập tên, mô tả hoặc số serial..." value="{{ request('search') }}">
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
            <h6 class="m-0 font-weight-bold text-primary">Dữ liệu Điện Thoại</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 80px;">Ảnh chính</th>
                            <th>Tên Điện Thoại</th>
                            <th>Thương hiệu</th>
                            <th>Giá</th>
                            <th>Dung lượng</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th style="width: 130px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($phones as $phone)
                            <tr>
                                <td>
                                    <img src="{{ $phone->main_image ? asset('storage/' . $phone->main_image) : 'https://via.placeholder.com/80x120?text=No+Image' }}"
                                        alt="{{ $phone->name }}" class="img-fluid"
                                        style="width: 80px; height: 120px; object-fit: cover;">
                                </td>
                                <td>
                                    <strong>{{ $phone->name }}</strong>
                                    <br>
                                    <small class="text-muted">Màu: {{ $phone->color ?? 'N/A' }}</small>
                                    <br>
                                    <small class="text-muted">Ngày tạo:
                                        {{ $phone->created_at->format('d/m/Y') }}</small>
                                </td>
                                <td>{{ $phone->brand->name ?? 'N/A' }}</td>
                                <td>{{ number_format($phone->price, 0, ',', '.') }} VNĐ</td>
                                <td>{{ $phone->storage_capacity }}</td>
                                <td>{{ $phone->quantity }}</td>
                                <td>
                                    @switch($phone->status)
                                        @case('available')
                                            <span class="badge badge-success">Còn hàng</span>
                                        @break

                                        @case('out_of_stock')
                                            <span class="badge badge-danger">Hết hàng</span>
                                        @break

                                        @case('upcoming')
                                            <span class="badge badge-info">Sắp ra mắt</span>
                                        @break

                                        @case('disabled')
                                            <span class="badge badge-warning">Ngừng kinh doanh</span>
                                        @break

                                        @default
                                            <span class="badge badge-secondary">{{ ucfirst($phone->status) }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#phoneDetailModal" data-name="{{ $phone->name }}"
                                        data-main_image="{{ $phone->main_image ? asset('storage/' . $phone->main_image) : 'https://via.placeholder.com/400x600?text=No+Image' }}"
                                        {{-- Mã hóa mô tả ngắn và dài --}} data-short_description="{{ $phone->short_description }}"
                                        data-long_description="{{ $phone->long_description }}"
                                        data-price="{{ number_format($phone->price, 0, ',', '.') }} VNĐ"
                                        data-original_price="{{ number_format($phone->original_price, 0, ',', '.') }} VNĐ"
                                        data-quantity="{{ $phone->quantity }}" data-status="{{ $phone->status }}"
                                        data-brand="{{ $phone->brand->name ?? 'N/A' }}"
                                        data-storage_capacity="{{ $phone->storage_capacity }}"
                                        data-color="{{ $phone->color }}"
                                        data-serial_number="{{ $phone->serial_number ?? 'N/A' }}"
                                        data-specifications="{{ json_encode($phone->specifications ?? []) }}"
                                        data-created_at="{{ $phone->created_at->format('H:i:s d/m/Y') }}"
                                        data-updated_at="{{ $phone->updated_at->format('H:i:s d/m/Y') }}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <a href="{{ route('admin.phones.edit', $phone->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.phones.destroy', $phone->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa điện thoại này vĩnh viễn?');">
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
                                    <td colspan="8" class="text-center">
                                        @if (request('search'))
                                            Không tìm thấy điện thoại nào với từ khóa "{{ request('search') }}".
                                        @else
                                            Chưa có điện thoại nào trong cửa hàng.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $phones->links() }}
                </div>
            </div>
        </div>

        {{-- Include Modal --}}
        @include('admin.phones.detail_modal')

    @endsection

    @push('scripts')
        <script>
            $('#phoneDetailModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);

                var name = button.data('name');
                var main_image = button.data('main_image');
                // Lấy trực tiếp dữ liệu, không cần giải mã
                var short_description = button.data('short_description');
                var long_description = button.data('long_description');

                var price = button.data('price');
                var original_price = button.data('original_price');
                var quantity = button.data('quantity');
                var status = button.data('status');
                var brand = button.data('brand');
                var storage_capacity = button.data('storage_capacity');
                var color = button.data('color');
                var serial_number = button.data('serial_number');
                var specifications = button.data('specifications'); // Đây là JSON string
                console.log('Giá trị specifications nhận được:', specifications);
                var created_at = button.data('created_at');
                var updated_at = button.data('updated_at');

                var modal = $(this);
                modal.find('.modal-title').text('Chi tiết Điện Thoại: ' + name);
                modal.find('#modal-phone-main_image').attr('src', main_image);
                modal.find('#modal-phone-name').text(name);
                modal.find('#modal-phone-short_description').html(short_description); // Dùng .html()
                modal.find('#modal-phone-long_description').html(long_description); // Dùng .html()
                modal.find('#modal-phone-price').text(price);
                modal.find('#modal-phone-original_price').text(original_price);
                modal.find('#modal-phone-quantity').text(quantity);
                modal.find('#modal-phone-brand').text(brand);
                modal.find('#modal-phone-storage_capacity').text(storage_capacity);
                modal.find('#modal-phone-color').text(color);
                modal.find('#modal-phone-serial_number').text(serial_number);
                modal.find('#modal-phone-created_at').text(created_at);
                modal.find('#modal-phone-updated_at').text(updated_at);

                // Xử lý specifications
                var specsHtml = '';
                if (specifications) { // specifications đã là một đối tượng JavaScript
                    var parsedSpecs = specifications; // Sử dụng trực tiếp biến specifications

                    // Kiểm tra xem đối tượng có rỗng không (ví dụ: {})
                    if (Object.keys(parsedSpecs).length > 0) {
                        specsHtml +=
                            '<ul class="list-group list-group-flush">'; // Sử dụng list-group của Bootstrap cho đẹp
                        for (var key in parsedSpecs) {
                            // Đảm bảo chỉ lặp qua các thuộc tính riêng của đối tượng, không phải từ prototype chain
                            if (parsedSpecs.hasOwnProperty(key)) {
                                // Định dạng key cho dễ đọc (ví dụ: 'os' -> 'Hệ điều hành')
                                var displayKey = '';
                                switch (key) {
                                    case 'os':
                                        displayKey = 'Hệ điều hành';
                                        break;
                                    case 'chip':
                                        displayKey = 'Chip xử lý';
                                        break;
                                    case 'camera':
                                        displayKey = 'Camera';
                                        break;
                                    case 'screen':
                                        displayKey = 'Màn hình';
                                        break;
                                    case 'battery':
                                        displayKey = 'Pin';
                                        break;
                                        // Thêm các trường khác nếu có
                                    default:
                                        // Chuyển đổi từ 'some_key' thành 'Some Key'
                                        displayKey = key.replace(/_/g, ' ').replace(/\b\w/g, function(l) {
                                            return l.toUpperCase()
                                        });
                                        break;
                                }
                                specsHtml += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>${displayKey}:</strong>
                                <span>${parsedSpecs[key]}</span>
                              </li>`;
                            }
                        }
                        specsHtml += '</ul>';
                    } else {
                        specsHtml = 'Không có thông số kỹ thuật.';
                    }
                } else {
                    // Điều này sẽ xảy ra nếu specifications là null hoặc undefined
                    specsHtml = 'Không có thông số kỹ thuật.';
                }
                modal.find('#modal-phone-specifications').html(specsHtml);


                // Xử lý badge cho status
                var statusBadge = '';
                switch (status) {
                    case 'available':
                        statusBadge = '<span class="badge badge-success">Còn hàng</span>';
                        break;
                    case 'out_of_stock':
                        statusBadge = '<span class="badge badge-danger">Hết hàng</span>';
                        break;
                    case 'upcoming':
                        statusBadge = '<span class="badge badge-info">Sắp ra mắt</span>';
                        break;
                    case 'disabled':
                        statusBadge = '<span class="badge badge-warning">Ngừng kinh doanh</span>';
                        break;
                    default:
                        statusBadge = '<span class="badge badge-secondary">' + status.charAt(0).toUpperCase() + status
                            .slice(1) + '</span>';
                }
                modal.find('#modal-phone-status').html(statusBadge);
            });
        </script>
    @endpush
