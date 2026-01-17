@extends('admin.layouts')

@section('title', 'Danh sách tài khoản nhân viên')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách tài khoản nhân viên</h1>
        <a href="{{ route('admin.accounts.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Thêm tài khoản
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
            <h6 class="m-0 font-weight-bold text-primary">Dữ liệu tài khoản</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 60px;">Avatar</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th style="width: 150px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($accounts as $account)
                            <tr>
                                <td>
                                    @if ($account->avatar)
                                        <img src="{{ asset('storage/' . $account->avatar) }}" alt="{{ $account->name }}"
                                            class="img-fluid rounded-circle"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="img-placeholder rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px; font-weight: bold;">
                                            {{ strtoupper(substr($account->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $account->name }}</td>
                                <td>{{ $account->email }}</td>
                                <td>{{ $account->role->name ?? 'N/A' }}</td>
                                <td>
                                    @if ($account->is_active)
                                        <span class="badge badge-success">Hoạt động</span>
                                    @else
                                        <span class="badge badge-secondary">Bị khóa</span>
                                    @endif
                                </td>
                                <td>{{ $account->created_at->format('d/m/Y') }}</td>
                                <td>
                                    {{-- Nút Xem chi tiết (mở modal) --}}
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#accountDetailModal" data-id="{{ $account->id }}"
                                        data-name="{{ $account->name }}" data-email="{{ $account->email }}"
                                        data-avatar="{{ $account->avatar ? asset('storage/' . $account->avatar) : '' }}"
                                        data-avatar-text="{{ strtoupper(substr($account->name, 0, 1)) }}"
                                        data-phone="{{ $account->phone ?? 'Chưa cập nhật' }}"
                                        data-bio="{{ $account->bio ?? 'Chưa có tiểu sử.' }}"
                                        data-role="{{ $account->role->name ?? 'N/A' }}"
                                        data-status="{{ $account->is_active }}"
                                        data-created="{{ $account->created_at->format('H:i:s d/m/Y') }}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    {{-- Nút Sửa --}}
                                    <a href="{{ route('admin.accounts.edit', $account->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.accounts.toggleStatus', $account->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning btn-sm"
                                            title="{{ $account->is_active ? 'Khóa tài khoản' : 'Kích hoạt tài khoản' }}">
                                            @if ($account->is_active)
                                                <i class="fas fa-lock-open"></i>
                                            @else
                                                <i class="fas fa-lock"></i>
                                            @endif
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Chưa có tài khoản nhân viên nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $accounts->links() }}
            </div>
        </div>
    </div>

    {{-- Include Modal --}}
    @include('admin.account.detail_modal')

@endsection

@push('scripts')
    <script>
        $('#accountDetailModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var modal = $(this);

            // Trích xuất dữ liệu
            var name = button.data('name');
            var avatarUrl = button.data('avatar');
            var avatarText = button.data('avatar-text');

            // Cập nhật modal
            modal.find('.modal-title').text('Chi tiết tài khoản: ' + name);
            modal.find('#modal-account-id').text(button.data('id'));
            modal.find('#modal-account-name').text(name);
            modal.find('#modal-account-email').text(button.data('email'));
            modal.find('#modal-account-phone').text(button.data('phone'));
            modal.find('#modal-account-bio').text(button.data('bio'));
            modal.find('#modal-account-role').text(button.data('role'));
            modal.find('#modal-account-created').text(button.data('created'));

            // Xử lý hiển thị avatar (ảnh hoặc chữ)
            if (avatarUrl) {
                modal.find('#modal-avatar-img').attr('src', avatarUrl).show();
                modal.find('#modal-avatar-text').hide();
            } else {
                modal.find('#modal-avatar-img').hide();
                modal.find('#modal-avatar-text').text(avatarText).show();
            }

            // Xử lý badge cho status
            var status = button.data('status');
            var statusBadge = status ?
                '<span class="badge badge-success">Hoạt động</span>' :
                '<span class="badge badge-secondary">Bị khóa</span>';
            modal.find('#modal-account-status').html(statusBadge);
        });
    </script>
@endpush
