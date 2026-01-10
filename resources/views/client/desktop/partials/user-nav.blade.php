<div class="header-user-actions">
    @auth
        @include('partials.wishlist')
        <div class="user-dropdown">
            <!-- Nút kích hoạt -->
            <div class="user-trigger">
                <div class="up-avatar-section">
                    <div class="up-avatar-wrapper">
                        @if (auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" id="avatarPreview" alt="Avatar">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=ff4d6d&color=fff"
                                id="avatarPreview" alt="Default Avatar">
                        @endif
                    </div>
                </div>
                <span class="user-name">{{ auth()->user()->name }}</span>
                <i class="fa-solid fa-chevron-down chevron"></i>
            </div>

            <!-- Nội dung sổ xuống -->
            <div class="dropdown-menu-container">
                <div class="dropdown-inner">
                    <div class="user-info-header">
                        <p class="role-badge">{{ auth()->user()->role_id == 1 ? 'Quản trị viên' : 'Khách hàng' }}   </p>
                        <p class="user-email">{{ auth()->user()->email }}</p>
                    </div>

                    <a href="/profile" class="menu-item">
                        <i class="fa-solid fa-user-gear"></i> Hồ sơ cá nhân
                    </a>

                    @if (auth()->user()->role_id == 1)
                        <a href="{{ route('admin.dashboard') }}" class="menu-item admin-btn">
                            <i class="fa-solid fa-gauge-high"></i> Trang quản trị
                        </a>
                    @endif

                    <a href="{{ route('wishlist.index') }}" class="menu-item">
                        <i class="fa-regular fa-heart"></i> Danh sách yêu thích
                    </a>

                    <div class="divider"></div>

                    <a href="{{ route('logout') }}" class="menu-item logout-btn"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </div>
        </div>
    @endauth

    @guest
        @include('partials.wishlist')
        <div class="guest-group">
            <a href="{{ route('login') }}" class="action-item">
                <i class="fa-regular fa-circle-user"></i> Đăng nhập
            </a>
        </div>
    @endguest
</div>

@include('partials.user-lib')
