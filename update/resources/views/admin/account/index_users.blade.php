@extends('admin.layouts')

@section('title', 'Danh sách tài khoản người dùng')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách tài khoản người dùng</h1>
    </div>

    {{-- Hiển thị thông báo nếu có --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Form Lọc và Tìm kiếm -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bộ lọc</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.accounts.users.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="search">Tìm kiếm</label>
                            <input type="text" class="form-control" name="search" id="search"
                                placeholder="Nhập tên hoặc email..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="month">Lọc theo tháng đăng ký</label>
                            <input type="month" class="form-control" name="month" id="month"
                                value="{{ request('month') }}">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-group w-100">
                            <button class="btn btn-primary w-100" type="submit">
                                <i class="fas fa-filter fa-sm"></i> Lọc
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bảng dữ liệu -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Dữ liệu tài khoản người dùng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 60px;">Avatar</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Trạng thái</th>
                            <th>Ngày đăng ký</th>
                            <th style="width: 130px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    @if ($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}"
                                            class="img-fluid rounded-circle"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="img-placeholder rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px; font-weight: bold;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->is_active)
                                        <span class="badge badge-success">Hoạt động</span>
                                    @else
                                        <span class="badge badge-secondary">Bị khóa</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                <td>
                                    {{-- Nút Xem chi tiết (có thể tái sử dụng modal cũ) --}}
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#accountDetailModal" data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                        data-avatar="{{ $user->avatar ? asset('storage/' . $user->avatar) : '' }}"
                                        data-avatar-text="{{ strtoupper(substr($user->name, 0, 1)) }}"
                                        data-phone="{{ $user->phone ?? 'Chưa cập nhật' }}"
                                        data-bio="{{ $user->bio ?? 'Chưa có tiểu sử.' }}"
                                        data-role="{{ $user->role->name ?? 'N/A' }}" data-status="{{ $user->is_active }}"
                                        data-created="{{ $user->created_at->format('H:i:s d/m/Y') }}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <form action="{{ route('admin.accounts.toggleStatus', $user->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning btn-sm"
                                            title="{{ $user->is_active ? 'Khóa tài khoản' : 'Kích hoạt tài khoản' }}">
                                            @if ($user->is_active)
                                                <i class="fas fa-lock-open"></i>
                                            @else
                                                <i class="fas fa-lock"></i>
                                            @endif
                                        </button>
                                    </form>

                                    {{-- Nút Xóa (nên là xóa mềm) --}}
                                    {{-- <form action="#" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Xóa tài khoản">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    @if (request('search') || request('month'))
                                        Không tìm thấy tài khoản nào khớp với điều kiện lọc.
                                    @else
                                        Chưa có tài khoản người dùng nào.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{-- Giữ lại các tham số lọc khi chuyển trang --}}
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    {{-- Tái sử dụng Modal chi tiết tài khoản --}}
    @include('admin.account.detail_modal')

@endsection

@push('scripts')
    <script>
        $('#accountDetailModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var modal = $(this);

            var name = button.data('name');
            var avatarUrl = button.data('avatar');
            var avatarText = button.data('avatar-text');

            // Gán các thông tin văn bản cơ bản
            modal.find('#modal-display-name').text(name);
            modal.find('#modal-account-id').text(button.data('id'));
            modal.find('#modal-account-email').text(button.data('email'));
            modal.find('#modal-account-phone').text(button.data('phone'));
            modal.find('#modal-account-bio').text(button.data('bio'));
            modal.find('#modal-account-created').text(button.data('created'));

            // --- XỬ LÝ AVATAR RIÊNG BIỆT ---
            var $imgObj = modal.find('#custom-avatar-image');
            var $txtObj = modal.find('#custom-avatar-placeholder');

            // Reset trạng thái trước khi kiểm tra (ẩn cả hai)
            $imgObj.attr('style', 'display: none !important; width: 150px; height: 150px; object-fit: cover;');
            $txtObj.attr('style',
                'display: none !important; width: 150px; height: 150px; font-size: 60px; font-weight: bold; align-items: center; justify-content: center;'
                );

            // Kiểm tra logic hiển thị
            if (avatarUrl && avatarUrl.trim() !== "" && !avatarUrl.endsWith('/storage/')) {
                // Trường hợp: CÓ ẢNH
                $imgObj.attr('src', avatarUrl);
                $imgObj.css('cssText',
                'display: block !important; width: 150px; height: 150px; object-fit: cover;');
            } else {
                // Trường hợp: KHÔNG CÓ ẢNH (Dùng placeholder)
                $txtObj.text(avatarText);
                // Dùng display: flex để căn giữa chữ cái
                $txtObj.css('cssText',
                    'display: flex !important; width: 150px; height: 150px; font-size: 60px; font-weight: bold; align-items: center; justify-content: center;'
                    );
            }

            // --- CÁC PHẦN KHÁC ---
            var status = button.data('status');
            var statusHtml = status ?
                '<span class="badge badge-success">Hoạt động</span>' :
                '<span class="badge badge-secondary">Bị khóa</span>';
            modal.find('#modal-account-status').html(statusHtml);

            var role = button.data('role');
            var roleBadge = (role === 'Quản trị viên') ?
                '<span class="badge badge-danger">Quản trị viên</span>' :
                '<span class="badge badge-info">Người dùng</span>';
            modal.find('#modal-account-role-badge').html(roleBadge);
        });
    </script>
@endpush
