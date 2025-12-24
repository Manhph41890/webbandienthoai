<!-- Font Awesome để dùng icon search, user, heart, arrow -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<link rel="stylesheet" href="{{ asset('css/client_styles.css') }}">
<header class="main-header">
    <div class="container">
        <!-- Top Header: Logo, Search, Actions -->
        <div class="header-top">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('logo/logo_remove.png') }}" alt="Toanhong Korea">
                </a>
            </div>

            <div class="search-box">
                <form action="/search" method="GET">
                    <input type="text" name="q" placeholder="Tìm kiếm...">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>

            <div class="header-user-actions">
                <a href="/account" class="action-item">
                    <i class="fa-regular fa-circle-user"></i>
                    <span>Tài khoản</span>
                </a>
                <a href="/wishlist" class="action-item">
                    <i class="fa-regular fa-heart"></i>
                    <span class="badge">+</span>
                    <span>Yêu thích</span>
                </a>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="main-navigation">
            <ul class="nav-list">
                <li><a href="/">Trang Chủ</a></li>
                
                <!-- Menu iPhone với Dropdown đa cấp -->
                <li class="has-dropdown">
                    <a href="/iphone">
                        <img src="{{ asset('logo/logo_apple.png') }}" alt="Apple" class="nav-icon_apple">
                        Iphone <i class="fa-solid fa-chevron-right arrow-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="has-submenu">
                            <a href="/iphone-11-series">iPhone 11 Series <i class="fa-solid fa-chevron-right"></i></a>
                            <ul class="submenu">
                                <li><a href="/iphone-11">iPhone 11</a></li>
                                <li><a href="/iphone-11-pro">iPhone 11 Pro</a></li>
                                <li><a href="/iphone-11-pro-max">iPhone 11 Pro Max</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="/iphone-15-series">iPhone 15 Series <i class="fa-solid fa-chevron-right"></i></a>
                            <ul class="submenu">
                                <li><a href="/iphone-15-pro">iPhone 15 Pro</a></li>
                                <li><a href="/iphone-15-pro-max">iPhone 15 Pro Max</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Menu Samsung -->
                <li class="has-dropdown">
                    <a href="/samsung">
                        <img src="{{ asset('logo/logo_samsung.png') }}" alt="Samsung" class="nav-icon_samsung"> <i class="fa-solid fa-chevron-right arrow-icon" style="margin-top: 6px"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/galaxy-s">Galaxy S Series</a></li>
                        <li><a href="/galaxy-z">Galaxy Z (Fold & Flip)</a></li>
                    </ul>
                </li>

                <li><a href="/dich-vu-sim">Dịch vụ Sim <i class="fa-solid fa-chevron-right arrow-icon"></i></a></li>
                <li><a href="/lien-he">Liên Hệ</a></li>
            </ul>
        </nav>
    </div>
</header>