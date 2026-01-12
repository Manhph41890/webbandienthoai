<!-- Admin Header Bar Container -->
<header class="adm-hb-navbar">
    <!-- Nút Toggle Sidebar cho Mobile -->
    <div class="adm-hb-left">
        <button id="admSidebarToggle" class="adm-hb-toggle-btn">
            <i class="fa-solid fa-bars-staggered"></i>
        </button>
        <div class="adm-hb-welcome d-none d-md-block">
            Xin chào, <span>{{ Auth::user()->name }}</span>!
        </div>
    </div>

    <!-- Right Side Actions -->
    <div class="adm-hb-right">
        
        <!-- Nút quay về trang chủ (Rất hữu ích cho Admin) -->
        <a href="/" class="adm-hb-icon-link" title="Xem trang chủ">
            <i class="fa-solid fa-house-chimney"></i>
        </a>

        <!-- Thông báo (Alerts) -->
        <div class="adm-hb-dropdown">
            <div class="adm-hb-icon-link adm-hb-trigger" id="alertTrigger">
                <i class="fa-solid fa-bell"></i>
                <span class="adm-hb-badge">1</span>
            </div>
            
            <div class="adm-hb-dropdown-menu adm-hb-menu-right" id="alertMenu">
                <div class="adm-hb-menu-header">Thông báo</div>
                <div class="adm-hb-menu-body">
                    <a href="#" class="adm-hb-menu-item unread">
                        <div class="adm-hb-item-icon warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="adm-hb-item-content">
                            <p class="adm-hb-item-text">Chào mừng đến với trang quản trị <b>Toàn Hồng Korea</b>!</p>
                            <span class="adm-hb-item-time">{{ date('d/m/Y') }}</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="adm-hb-divider"></div>

        <!-- Thông tin User -->
        @auth
        <div class="adm-hb-dropdown">
            <div class="adm-hb-user-trigger adm-hb-trigger" id="userTrigger">
                <div class="adm-hb-user-info d-none d-lg-block">
                    <span class="adm-hb-user-name">{{ Auth::user()->name }}</span>
                    <span class="adm-hb-user-role">Quản trị viên</span>
                </div>
                <div class="adm-hb-user-avatar">
                    @if (Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1a222d&color=fff" alt="Default">
                    @endif
                </div>
            </div>

            <div class="adm-hb-dropdown-menu adm-hb-menu-right" id="userMenu">
                <div class="adm-hb-menu-inner">
                    <a href="{{ route('profile.index') }}" class="adm-hb-menu-link">
                        <i class="fa-solid fa-user-circle"></i> Hồ sơ cá nhân
                    </a>
                    <a href="#" class="adm-hb-menu-link">
                        <i class="fa-solid fa-gear"></i> Cài đặt hệ thống
                    </a>
                    <div class="adm-hb-menu-divider"></div>
                    <a href="#" class="adm-hb-menu-link logout" id="admLogoutTrigger">
                        <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                    </a>
                </div>
            </div>
        </div>
        @endauth
    </div>
</header>

<!-- Modal Đăng xuất (Custom Design) -->
<div class="adm-hb-modal-overlay" id="admLogoutModal">
    <div class="adm-hb-modal">
        <div class="adm-hb-modal-icon">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </div>
        <h3>Bạn muốn đăng xuất?</h3>
        <p>Phiên làm việc của bạn sẽ kết thúc. Hãy đảm bảo các thay đổi đã được lưu.</p>
        <div class="adm-hb-modal-actions">
            <button class="adm-hb-btn-cancel" id="admCancelLogout">Hủy bỏ</button>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="adm-hb-btn-confirm">Đăng xuất ngay</button>
            </form>
        </div>
    </div>
</div>
@include('admin.partials.lib.header-lib')
<div class="mb-4"></div>