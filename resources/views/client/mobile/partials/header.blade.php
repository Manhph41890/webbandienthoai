<!-- Font Awesome & Bootstrap Icon (nếu cần) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<!-- Dòng này giúp trình duyệt hiểu đây là web mobile và không tự thu nhỏ -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Font Awesome bản mới nhất -->

<link rel="stylesheet" href="{{ asset('css/client_styles_mb.css') }}">
<script src="{{ asset('js/main_mb.js') }}"></script>
<header class="mobile-header">
    <!-- 1. Thanh tìm kiếm trên cùng (Gray bar) -->
    <div class="top-search-bar">
        <form action="{{ route('search') }}" method="GET">
        <div class="search-container">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm kiếm...">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        </form>
    </div>

    <!-- 2. Thanh điều hướng chính (Navy bar) -->
    <div class="main-nav-bar">
        <div class="menu-toggle" id="openMenu">
            <i class="fa-solid fa-bars"></i>
        </div>

        <div class="mobile-logo">
            <a href="/">
                <img src="{{ asset('logo/logo_remove.png') }}" alt="Toanhong Korea">
            </a>
        </div>

        @include('partials.user-nav')
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
            <a href="/lien-he" class="q-link">Liên hệ</a>
        </div>

        <!-- Danh mục chính -->
        <div class="category-section">
            <div class="category-header">DANH MỤC CHÍNH</div>

            <ul class="mobile-accordion-menu">
                <!-- Menu iPhone -->
                @if ($menuIphones->isNotEmpty())
                    <li class="has-dropdown">
                        <div class="nav-link-wrapper">
                            <a href="/iphone" class="main-link">
                                <span>Iphone</span>
                            </a>
                            <span class="arrow-toggle"><i class="fa-solid fa-chevron-right"></i></span>
                        </div>

                        <ul class="dropdown-menu">
                            @foreach ($menuIphones as $series)
                                <li class="{{ $series->children->isNotEmpty() ? 'has-submenu' : '' }}">
                                    <div class="nav-link-wrapper">
                                        <a href="{{ url($series->slug) }}">{{ $series->name }}</a>
                                        @if ($series->children->isNotEmpty())
                                            <span class="arrow-toggle"><i class="fa-solid fa-chevron-right"></i></span>
                                        @endif
                                    </div>
                                    @if ($series->children->isNotEmpty())
                                        <ul class="submenu">
                                            @foreach ($series->children as $model)
                                                <li><a href="{{ url($model->slug) }}">{{ $model->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                <!-- Menu Samsung -->
                @if ($menuSamsungs->isNotEmpty())
                    <li class="has-dropdown">
                        <div class="nav-link-wrapper">
                            <a href="/samsung" class="main-link">
                                <span>Samsung</span>
                            </a>
                            <span class="arrow-toggle"><i class="fa-solid fa-chevron-right"></i></span>
                        </div>
                        <ul class="dropdown-menu">
                            @foreach ($menuSamsungs as $series)
                                <li class="{{ $series->children->isNotEmpty() ? 'has-submenu' : '' }}">
                                    <div class="nav-link-wrapper">
                                        <a href="{{ url($series->slug) }}">{{ $series->name }}</a>
                                        @if ($series->children->isNotEmpty())
                                            <span class="arrow-toggle"><i class="fa-solid fa-chevron-right"></i></span>
                                        @endif
                                    </div>
                                    @if ($series->children->isNotEmpty())
                                        <ul class="submenu">
                                            @foreach ($series->children as $model)
                                                <li><a href="{{ url($model->slug) }}">{{ $model->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                <!-- Menu Dịch vụ Sim -->
                @if ($menuSims->isNotEmpty())
                    <li class="has-dropdown">
                        <div class="nav-link-wrapper">
                            <a href="/goi-cuoc/goi-cuoc" class="main-link">Dịch vụ Sim</a>
                            <span class="arrow-toggle"><i class="fa-solid fa-chevron-right"></i></span>
                        </div>
                        <ul class="dropdown-menu">
                            @foreach ($menuSims as $type)
                                <li class="{{ $type->children->isNotEmpty() ? 'has-submenu' : '' }}">
                                    <div class="nav-link-wrapper">
                                        <a href="{{ route('package.category', $type->slug) }}">
                                            {{ $type->name }}
                                            @if ($type->children->isNotEmpty())
                                                <i class="fa-solid fa-chevron-right"></i>
                                            @endif
                                        </a>
                                    </div>
                                    @if ($type->children->isNotEmpty())
                                        <ul class="submenu">
                                            @foreach ($type->children as $subType)
                                                <li>
                                                    <a href="{{ route('package.category', $subType->slug) }}">
                                                        {{ $subType->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</header>
