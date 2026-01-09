@extends('client.mobile.layouts.app')

@section('content')
<div class="up-container">
    <!-- Header Profile -->
    <div class="up-header">
        <div class="up-header-top">
            <a href="javascript:history.back()" class="up-back-btn"><i class="fa-solid fa-chevron-left"></i></a>
            <h3>Hồ sơ cá nhân</h3>
            <div style="width: 40px;"></div>
        </div>

        <div class="up-avatar-section">
            <div class="up-avatar-wrapper">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" id="avatarPreview" alt="Avatar">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ff4d6d&color=fff" id="avatarPreview" alt="Default Avatar">
                @endif
                <label for="avatarInput" class="up-edit-avatar">
                    <i class="fa-solid fa-camera"></i>
                </label>
            </div>
            <h4 class="up-user-name">{{ $user->name }}</h4>
            <span class="up-user-badge">{{ $user->role_id == 1 ? 'Quản trị viên' : 'Khách hàng' }}</span>
        </div>
    </div>

    <!-- Menu nhanh (Quick Links) -->
    <div class="up-quick-nav">
        @if($user->role_id == 1)
            <a href="{{ route('admin.dashboard') }}" class="up-nav-item admin">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Quản trị</span>
            </a>
        @endif
        <a href="{{ route('wishlist.index') }}" class="up-nav-item">
            <i class="fa-solid fa-heart"></i>
            <span>Yêu thích</span>
        </a>
        <a href="#" class="up-nav-item">
            <i class="fa-solid fa-box-open"></i>
            <span>Đơn hàng</span>
        </a>
    </div>

    <!-- Form cập nhật -->
    <div class="up-content">
        @if(session('success'))
            <div class="up-alert success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="up-form">
            @csrf
            <input type="file" name="avatar" id="avatarInput" hidden accept="image/*">

            <div class="up-input-group">
                <label><i class="fa-solid fa-user"></i> Họ và tên</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Nhập họ tên...">
            </div>

            <div class="up-input-group">
                <label><i class="fa-solid fa-envelope"></i> Email (Không thể đổi)</label>
                <input type="email" value="{{ $user->email }}" disabled style="background: #f0f0f0; color: #888;">
            </div>

            <div class="up-input-group">
                <label><i class="fa-solid fa-phone"></i> Số điện thoại</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="010-xxxx-xxxx">
            </div>

            <div class="up-input-group">
                <label><i class="fa-solid fa-location-dot"></i> Địa chỉ tại Hàn Quốc</label>
                <textarea name="address" rows="2" placeholder="Nhập địa chỉ nhận hàng...">{{ old('address', $user->address) }}</textarea>
            </div>

            <button type="submit" class="up-submit-btn">Lưu thay đổi</button>
        </form>

        <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <button type="submit" class="up-logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất tài khoản
            </button>
        </form>
    </div>
</div>

<style>
:root {
    --up-navy: #1a222d;
    --up-accent: #ff4d6d;
    --up-gray: #f8f9fa;
}

.up-container { background: #fff; min-height: 100vh; padding-bottom: 30px; }

/* Header & Avatar */
.up-header {
    background: var(--up-navy);
    padding: 20px 15px 40px;
    border-radius: 0 0 30px 30px;
    text-align: center;
    color: white;
}
.up-header-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
.up-header-top h3 { font-size: 18px; margin: 0; font-weight: 700; }
.up-back-btn { color: white; font-size: 20px; }

.up-avatar-section { position: relative; }
.up-avatar-wrapper {
    position: relative;
    width: 100px;
    height: 100px;
    margin: 0 auto 15px;
}
.up-avatar-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid rgba(255,255,255,0.2);
}
.up-edit-avatar {
    position: absolute;
    bottom: 0;
    right: 0;
    background: var(--up-accent);
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    border: 3px solid var(--up-navy);
}

.up-user-name { margin: 0; font-size: 20px; font-weight: 700; }
.up-user-badge {
    display: inline-block;
    background: rgba(255,255,255,0.1);
    padding: 3px 12px;
    border-radius: 15px;
    font-size: 11px;
    margin-top: 5px;
    color: #ffc107;
}

/* Quick Nav */
.up-quick-nav {
    display: flex;
    justify-content: space-around;
    padding: 0 20px;
    margin-top: -25px;
}
.up-nav-item {
    background: white;
    width: 90px;
    height: 80px;
    border-radius: 15px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    text-decoration: none;
    color: var(--up-navy);
}
.up-nav-item i { font-size: 20px; color: var(--up-accent); }
.up-nav-item span { font-size: 12px; font-weight: 600; }
.up-nav-item.admin i { color: #ffc107; }

/* Form Content */
.up-content { padding: 30px 20px; }
.up-alert {
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 14px;
}
.up-alert.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }

.up-input-group { margin-bottom: 20px; }
.up-input-group label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    color: #666;
    margin-bottom: 8px;
}
.up-input-group label i { margin-right: 5px; color: var(--up-navy); }
.up-input-group input, .up-input-group textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #eee;
    border-radius: 12px;
    background: var(--up-gray);
    font-size: 15px;
    outline: none;
    transition: 0.3s;
}
.up-input-group input:focus { border-color: var(--up-accent); background: #fff; }

.up-submit-btn {
    width: 100%;
    background: var(--up-navy);
    color: white;
    border: none;
    padding: 15px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 16px;
    margin-top: 10px;
}

.up-logout-btn {
    width: 100%;
    background: none;
    border: 1px solid #eee;
    color: #ff5e5e;
    padding: 12px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 14px;
}
</style>

<script>
// Xem trước ảnh khi chọn file
document.getElementById('avatarInput').addEventListener('change', function(e) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('avatarPreview').src = reader.result;
    }
    reader.readAsDataURL(e.target.files[0]);
});
</script>
@endsection