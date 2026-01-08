@extends('admin.layouts')

@section('title', 'Quản lý Liên hệ')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Quản lý Liên hệ</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
    @endif

    <!-- Bộ lọc tìm kiếm -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <form action="{{ route('admin.contact.index') }}" method="GET" class="row g-3">
                <div class="col-md-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white border-right-0"><i
                                    class="fas fa-search text-muted"></i></span>
                        </div>
                        <input type="text" name="search" class="form-control border-left-0"
                            placeholder="Tìm theo tên, email hoặc số điện thoại..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block shadow-sm">Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bảng danh sách Liên hệ -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header py-3 bg-white border-bottom d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách yêu cầu hỗ trợ</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" width="100%" cellspacing="0">
                    <thead class="bg-light text-secondary small text-uppercase">
                        <tr>
                            <th width="5%">STT</th>
                            <th width="20%">Khách hàng</th>
                            <th width="20%">Dịch vụ quan tâm</th>
                            <th width="25%">Yêu cầu</th>
                            <th width="15%">Ngày gửi</th>
                            <th width="15%" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                            <tr>
                                <td class="align-middle font-weight-bold">
                                    #{{ ($contacts->currentPage() - 1) * $contacts->perPage() + $loop->iteration }}</td>
                                <td class="align-middle">
                                    <div class="font-weight-bold text-dark">{{ $contact->name }}</div>
                                    <div class="small text-muted"><i class="fas fa-envelope fa-xs"></i>
                                        {{ $contact->email }}</div>
                                    <div class="small text-muted"><i class="fas fa-phone fa-xs"></i>
                                        {{ $contact->phone_number }}</div>
                                </td>
                                <td class="align-middle">
                                    <span class="badge badge-info px-2 py-1">
                                        {{ $contact->service->value }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <div class="text-truncate" style="max-width: 250px;">
                                        {{ $contact->request }}
                                    </div>
                                </td>
                                <td class="align-middle small">
                                    {{ $contact->created_at->format('H:i d/m/Y') }}
                                </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group shadow-sm">
                                        <button type="button" class="btn btn-white btn-sm" data-toggle="modal"
                                            data-target="#contactDetailModal" data-id="{{ $contact->id }}"
                                            data-name="{{ $contact->name }}" data-email="{{ $contact->email }}"
                                            data-phone="{{ $contact->phone_number }}"
                                            data-service="{{ $contact->service->value }}"
                                            data-request="{{ $contact->request }}"
                                            data-created="{{ $contact->created_at->format('H:i:s d/m/Y') }}"
                                            title="Xem chi tiết">
                                            <i class="fas fa-eye text-info"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-comment-slash fa-3x mb-3"></i>
                                    <p>Chưa có yêu cầu liên hệ nào.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $contacts->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    @include('admin.contacts.detail_modal')
    @include('admin.contacts.reply_modanl')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let currentContactId = null;
            let currentContactEmail = '';
            let currentContactName = '';

            // 1. Khi mở Modal chi tiết
            $('#contactDetailModal').on('show.bs.modal', function(event) {
                // Sử dụng .closest('button') để chắc chắn lấy được đối tượng button dù bấm vào icon bên trong
                var button = $(event.relatedTarget).closest('button');
                var modal = $(this);

                // Lấy ID và kiểm tra
                currentContactId = button.attr(
                'data-id'); // Dùng .attr('data-id') thay vì .data('id') để tránh cache
                currentContactName = button.data('name');
                currentContactEmail = button.data('email');

                // LOG ĐỂ KIỂM TRA (Nhấn F12 trong trình duyệt, chọn tab Console)
                console.log("ID nhận được:", currentContactId);

                // Đổ dữ liệu vào modal chi tiết
                modal.find('.modal-title').html(
                    '<i class="fas fa-user-clock mr-2"></i> Chi tiết liên hệ từ: ' + currentContactName);
                modal.find('#modal-name').text(currentContactName);
                modal.find('#modal-email').text(currentContactEmail);
                modal.find('#modal-phone').text(button.data('phone'));
                modal.find('#modal-service').text(button.data('service'));
                modal.find('#modal-request').text(button.data('request'));
                modal.find('#modal-created').text(button.data('created'));
            });

            // 2. Khi bấm nút "Phản hồi qua Email" từ trong Modal Chi tiết
            $('#btn-open-reply').on('click', function() {
                if (!currentContactId || currentContactId === "undefined") {
                    alert('Lỗi: Không tìm thấy ID liên hệ. Vui lòng thử lại!');
                    return;
                }

                $('#contactDetailModal').modal('hide');

                setTimeout(function() {
                    $('#reply-to-name').text(currentContactName);
                    $('#reply-to-email').val(currentContactEmail);

                    // Xây dựng URL động
                    let routeTemplate = "{{ route('admin.contacts.reply', ':id') }}";
                    let actionUrl = routeTemplate.replace(':id', currentContactId);

                    console.log("Form action URL:",
                    actionUrl); // Kiểm tra URL xem đã hết undefined chưa

                    $('#replyMailForm').attr('action', actionUrl);
                    $('#replyMailModal').modal('show');
                }, 500);
            });

            // 3. Trạng thái loading khi gửi
            $('#replyMailForm').on('submit', function() {
                $(this).find('button[type="submit"]').prop('disabled', true).html(
                    '<i class="fas fa-spinner fa-spin mr-1"></i> Đang gửi...');
            });
        });
    </script>
@endpush
