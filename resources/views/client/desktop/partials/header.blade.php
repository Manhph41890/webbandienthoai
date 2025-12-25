<!-- Font Awesome để dùng icon search, user, heart, arrow -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<link rel="stylesheet" href="{{ asset('css/client_styles.css') }}">
<script src="{{ asset('js/main.js') }}"></script>
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
                @auth
                    <!-- Hiển thị khi ĐÃ đăng nhập -->
                    <a href="/account" class="action-item">
                        <i class="fa-regular fa-circle-user"></i>
                        <span>{{ auth()->user()->name }}</span>
                    </a>

                    <a href="/wishlist" class="action-item">
                        <i class="fa-regular fa-heart"></i>
                        <span>Yêu thích</span>
                    </a>

                    <!-- Nút Đăng xuất (Laravel yêu cầu dùng POST để an toàn) -->
                    <a href="{{ route('logout') }}" class="action-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span>Đăng xuất</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth

                @guest
                    <!-- Hiển thị khi CHƯA đăng nhập -->
                    <a href="{{ route('login') }}" class="action-item">
                        <i class="fa-regular fa-circle-user"></i>
                        <span>Đăng nhập</span>
                    </a>

                    <a href="/wishlist" class="action-item">
                        <i class="fa-regular fa-heart"></i>
                        <span>Yêu thích</span>
                    </a>
                @endguest
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
                        <img src="{{ asset('logo/logo_samsung.png') }}" alt="Samsung" class="nav-icon_samsung"> <i
                            class="fa-solid fa-chevron-right arrow-icon" style="margin-top: 6px"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/galaxy-s">Galaxy S Series</a></li>
                        <li><a href="/galaxy-z">Galaxy Z (Fold & Flip)</a></li>
                    </ul>
                </li>

                <!-- Menu Dịch vụ Sim với Dropdown đa cấp -->
                <li class="has-dropdown">
                    <a href="/iphone">
                        Dịch vụ Sim <i class="fa-solid fa-chevron-right arrow-icon"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="has-submenu">
                            <a href="/iphone-11-series">Sim Hợp Pháp <i class="fa-solid fa-chevron-right"></i></a>
                            <ul class="submenu">
                                <li><a href="/iphone-11">Sim trả trước</a></li>
                                <li><a href="/iphone-11-pro">Sim trả sau</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="/iphone-15-series">Sim BHP <i class="fa-solid fa-chevron-right"></i></a>
                            <ul class="submenu">
                                <li><a href="/iphone-11">Sim trả trước</a></li>
                                <li><a href="/iphone-11-pro">Sim trả sau</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>



                <li><a href="/lien-he">Liên Hệ</a></li>
            </ul>
        </nav>
    </div>
</header>
