@extends('client.desktop.layouts.app')

@section('content')
    <div class="dp-container">
        <div class="container py-5">
            <div class="row g-4">
                <!-- Cột trái: Sidebar điều hướng -->
                <div class="col-lg-3">
                    <div class="dp-sidebar shadow-sm">
                        <div class="dp-sidebar-header">
                            <div class="dp-avatar-box">
                                @if ($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" id="sidebarAvatar" alt="Avatar">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ff4d6d&color=fff"
                                        alt="Default Avatar">
                                @endif
                            </div>
                            <h5 class="mt-3 mb-0 fw-bold">{{ $user->name }}</h5>
                            <p class="text-muted small" style="color: #ffff !important">{{ $user->email }}</p>
                        </div>

                        <div class="dp-menu">
                            <a href="{{ route('profile.index') }}" class="dp-menu-item active">
                                <i class="fa-solid fa-user-gear"></i> Thông tin cá nhân
                            </a>
                            <a href="{{ route('wishlist.index') }}" class="dp-menu-item">
                                <i class="fa-solid fa-heart"></i> Sản phẩm yêu thích
                            </a>
                            <a href="#" class="dp-menu-item">
                                <i class="fa-solid fa-clock-rotate-left"></i> Lịch sử đơn hàng
                            </a>

                            @if ($user->role_id == 1 || $user->role_id == 2)
                                <div class="dp-divider"></div>
                                <a href="{{ route('admin.dashboard') }}" class="dp-menu-item admin-link">
                                    <i class="fa-solid fa-gauge-high"></i> Trang quản trị (Admin)
                                </a>
                            @endif

                            <div class="dp-divider"></div>
                            <a href="{{ route('logout') }}" class="dp-menu-item logout-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form-desktop').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                            </a>
                            <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf</form>
                        </div>
                    </div>
                </div>

                <!-- Cột phải: Form cập nhật thông tin -->
                <div class="col-lg-9">
                    <div class="dp-main-card shadow-sm">
                        <div class="dp-card-header">
                            <h4>Cài đặt tài khoản</h4>
                            <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Khu vực đổi Avatar -->
                                <div class="col-md-4 text-center border-end">
                                    <div class="dp-upload-box">
                                        <div class="dp-preview-wrapper">
                                            @if ($user->avatar)
                                                <img src="{{ asset('storage/' . $user->avatar) }}" id="mainAvatarPreview"
                                                    alt="Avatar">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ff4d6d&color=fff"
                                                    id="mainAvatarPreview" alt="Default Avatar">
                                            @endif
                                        </div>
                                        <label for="avatarInputDesktop" class="btn btn-sm btn-outline-secondary mt-3">
                                            <i class="fa-solid fa-camera me-1"></i> Đổi ảnh đại diện
                                        </label>
                                        <input type="file" name="avatar" id="avatarInputDesktop" hidden
                                            accept="image/*">
                                        <p class="text-muted mt-2 small">Định dạng: .JPG, .PNG. Tối đa 2MB</p>
                                    </div>
                                </div>

                                <!-- Khu vực điền thông tin -->
                                <div class="col-md-8 px-4">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="dp-label">Họ và tên</label>
                                            <input type="text" name="name" class="form-control dp-input"
                                                value="{{ old('name', $user->name) }}" required>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="dp-label">Địa chỉ Email</label>
                                            <input type="email" class="form-control dp-input" value="{{ $user->email }}"
                                                disabled>
                                            <small class="text-muted">Liên hệ quản trị viên để thay đổi email.</small>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="dp-label">Số điện thoại</label>
                                            <input type="text" name="phone_number" class="form-control dp-input"
                                                value="{{ old('phone_number', $user->phone_number) }}"
                                                placeholder="010-xxxx-xxxx">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="dp-label">Vai trò</label>
                                            <div class="dp-role-badge">
                                                {{ $user->role_id == 1 ? 'Quản trị viên' : ($user->role_id == 2 ? 'Nhân viên' : 'Khách hàng') }}
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="dp-label">Địa chỉ cư trú (Hàn Quốc)</label>
                                            <textarea name="address" class="form-control dp-input" rows="3" placeholder="Nhập địa chỉ chi tiết...">{{ old('address', $user->address) }}</textarea>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <button type="submit" class="btn dp-btn-save">
                                                <i class="fa-solid fa-floppy-disk me-2"></i> Cập nhật hồ sơ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* CSS cho Desktop Profile */
        .dp-container {
            background-color: #f4f7f9;
            min-height: 80vh;
        }

        /* Sidebar Styling */
        .dp-sidebar {
            background: #fff;
            border-radius: 5px;
            overflow: hidden;
        }

        .dp-sidebar-header {
            padding: 30px 20px;
            text-align: center;
            background: linear-gradient(135deg, #140000 0%, #2c3e50 100%);
            color: white;
        }

        .dp-avatar-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }

        .dp-avatar-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .dp-menu {
            padding: 15px 0;
        }

        .dp-menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 25px;
            color: #555;
            text-decoration: none;
            transition: 0.3s;
            font-weight: 500;
        }

        .dp-menu-item i {
            width: 20px;
            font-size: 18px;
            color: #888;
        }

        .dp-menu-item:hover,
        .dp-menu-item.active {
            background: #fdf2f4;
            color: #ff4d6d;
            border-right: 3px solid #ff4d6d;
        }

        .dp-menu-item:hover i,
        .dp-menu-item.active i {
            color: #ff4d6d;
        }

        .dp-divider {
            height: 1px;
            background: #eee;
            margin: 10px 25px;
        }

        .admin-link {
            color: #ffc107 !important;
        }

        .logout-link {
            color: #dc3545 !important;
        }

        /* Main Card Styling */
        .dp-main-card {
            background: #fff;
            border-radius: 5px;
            padding: 30px;
        }

        .dp-card-header {
            border-bottom: 1px solid #eee;
            margin-bottom: 30px;
            padding-bottom: 15px;
        }

        .dp-card-header h4 {
            font-weight: 700;
            color: #140000;
            margin-bottom: 5px;
        }

        .dp-label {
            font-size: 14px;
            font-weight: 600;
            color: #666;
            margin-bottom: 8px;
        }

        .dp-input {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #ddd;
            background: #fafafa;
        }

        .dp-input:focus {
            background: #fff;
            border-color: #ff4d6d;
            box-shadow: 0 0 0 0.25rem rgba(255, 77, 109, 0.1);
        }

        .dp-role-badge {
            display: inline-block;
            padding: 10px 15px;
            background: #e9ecef;
            border-radius: 8px;
            font-weight: 700;
            color: #495057;
            width: 100%;
        }

        .dp-preview-wrapper {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto;
            overflow: hidden;
            border: 5px solid #f8f9fa;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .dp-preview-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .dp-btn-save {
            background: #140000;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }

        .dp-btn-save:hover {
            background: #2c3e50;
            color: white;
            transform: translateY(-2px);
        }
    </style>

    <script>
        // Logic xem trước ảnh đại diện cho Desktop
        document.getElementById('avatarInputDesktop').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(val) {
                    document.getElementById('mainAvatarPreview').src = val.target.result;
                    // Cập nhật cả avatar nhỏ bên sidebar nếu có
                    const sidebarAvatar = document.getElementById('sidebarAvatar');
                    if (sidebarAvatar) sidebarAvatar.src = val.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
@endsection
