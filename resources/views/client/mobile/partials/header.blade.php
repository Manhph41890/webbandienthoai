<!-- Font Awesome & Bootstrap Icon (nếu cần) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<header class="mobile-header">
    <!-- 1. Thanh tìm kiếm trên cùng (Gray bar) -->
    <div class="top-search-bar">
        <div class="search-container">
            <input type="text" placeholder="Tìm kiếm...">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>

    <!-- 2. Thanh điều hướng chính (Navy bar) -->
    <div class="main-nav-bar">
        <div class="menu-toggle" id="openMenu">
            <i class="fa-solid fa-bars"></i>
        </div>
        
        <div class="mobile-logo">
            <a href="/">
                <img src="{{ asset('logo/logo_th_korea.png') }}" alt="Toanhong Korea">
            </a>
        </div>

        <div class="mobile-actions">
            <a href="/account" class="action-item">
                <i class="fa-regular fa-circle-user"></i>
                <span>Tài khoản</span>
            </a>
            <a href="/wishlist" class="action-item">
                <i class="fa-regular fa-heart"></i>
                <span>Yêu thích</span>
            </a>
        </div>
    </div>

    <!-- 3. Overlay & Drawer Menu -->
    <div class="menu-overlay" id="menuOverlay"></div>
    
    <div class="side-drawer" id="sideDrawer">
        <!-- Header của Menu -->
        <div class="drawer-header">
            <div class="header-left">
                <i class="fa-solid fa-bars"></i>
                <span class="menu-title">MENU</span>
            </div>
            <div class="close-btn" id="closeMenu">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>

        <!-- Các nút chức năng nhanh (Grid 2x2) -->
        <div class="quick-links">
            <a href="/" class="q-link">Trang chủ</a>
            <a href="/dien-thoai" class="q-link">Điện thoại</a>
            <a href="/sim" class="q-link">Sim-Gói cước</a>
            <a href="/lien-he" class="q-link">Liên hệ</a>
        </div>

        <!-- Danh mục chính -->
        <div class="category-section">
            <div class="category-header">Danh Mục Chính</div>
            <ul class="category-list">
                <li><a href="/iphone">Iphone</a></li>
                <li><a href="/samsung">SamSung</a></li>
                <li><a href="/dich-vu-sim">Dịch vụ Sim</a></li>
            </ul>
        </div>
    </div>
</header>