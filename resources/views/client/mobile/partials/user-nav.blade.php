<!-- Cấu trúc Header Mobile -->
<div class="mobile-user-actions">
    <a href="{{ route('wishlist.index') }}" class="mobile-action-btn">
        <i class="fa-regular fa-heart"></i>
        <span class="badge">{{ $globalWishlistCount }}</span>
    </a>

    <!-- Nút mở Menu User -->
    <button class="mobile-action-btn" id="openUserMenu">
        <i class="fa-regular fa-circle-user"></i>
    </button>
</div>

<div class="mobile-menu-overlay" id="menuOverlay"></div>

<!-- Sidebar Menu -->
<div class="mobile-user-sidebar" id="userSidebar">
    <div class="sidebar-header">
        <h3>Tài khoản</h3>
        <button class="close-sidebar" id="closeUserMenu">&times;</button>
    </div>

    <div class="sidebar-content">
        @auth
            <div class="user-profile-card">
                <div class="user-avatar">
                    <div class="up-avatar-section">
                        <div class="up-avatar-wrapper">
                            @if (auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" id="avatarPreview"
                                    alt="Avatar">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=ff4d6d&color=fff"
                                    id="avatarPreview" alt="Default Avatar">
                            @endif
                        </div>
                    </div>

                </div>
                <div class="user-details">
                    <span class="user-name">{{ auth()->user()->name }}</span>
                    <span class="user-role">{{ auth()->user()->role_id == 1 ? 'Quản trị viên' : 'Khách hàng' }}</span>
                    <span class="user-email">{{ auth()->user()->email }}</span>
                </div>
            </div>

            <div class="menu-list">
                <a href="{{ route('profile.index') }}" class="menu-link">
                    <i class="fa-solid fa-user-gear"></i> Hồ sơ cá nhân
                </a>

                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                    <a href="{{ route('admin.dashboard') }}" class="menu-link admin-link">
                        <i class="fa-solid fa-gauge-high"></i> Trang quản trị
                    </a>
                @endif

                <a href="{{ route('wishlist.index') }}" class="menu-link">
                    <i class="fa-regular fa-heart"></i> Danh sách yêu thích
                </a>

                <div class="divider"></div>

                <a href="{{ route('logout') }}" class="menu-link logout-link"
                    onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                </a>
                <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
        @endauth

        @guest
            <div class="guest-box">
                <p>Vui lòng đăng nhập để trải nghiệm đầy đủ tính năng</p>
                <a href="{{ route('login') }}" class="login-btn-mobile">Đăng nhập</a>
                <a href="{{ route('register') }}" class="register-link-mobile">Chưa có tài khoản? Đăng ký ngay</a>
            </div>
        @endguest
    </div>
</div>

@include('partials.user-lib')
