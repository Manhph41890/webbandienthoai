<header class="mh-container">
    <!-- 1. Thanh tìm kiếm (Thiết kế lại hiện đại hơn) -->
    <div class="mh-search-bar">
        <form action="{{ route('search') }}" method="GET" class="mh-search-form">
            <div class="mh-search-inner">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Bạn tìm gì hôm nay?">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </div>

    <!-- 2. Thanh chính (Navy Bar) -->
    <div class="mh-main-nav">
        <div class="mh-nav-left">
            <button class="mh-icon-btn" id="mhOpenDrawer" aria-label="Mở menu">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
        </div>

        <div class="mh-logo">
            <a href="/">
                <img src="{{ asset('logo/logo_remove.png') }}" alt="TuoiDuyen Mobile">
            </a>
        </div>

        <div class="mh-nav-right">
            <!-- Tận dụng lại phần User/Wishlist đã làm ở bước trước -->
            @include('partials.user-nav')
        </div>
    </div>

    <!-- 3. Drawer Menu (Cánh gà bên trái) -->
    <div class="mh-overlay" id="mhOverlay"></div>

    <aside class="mh-drawer" id="mhDrawer">
        <div class="mh-drawer-header">
            <div class="mh-drawer-title">
                <i class="fa-solid fa-circle-chevron-right"></i>
                <span>KHÁM PHÁ</span>
            </div>
            <button class="mh-close-btn" id="mhCloseDrawer">&times;</button>
        </div>

        <div class="mh-drawer-body">
            <!-- Nút chức năng nhanh -->
            <div class="mh-quick-grid">
                <a href="/" class="mh-q-item">
                    <i class="fa-solid fa-house"></i>
                    <span>Trang chủ</span>
                </a>
                <a href="/lien-he" class="mh-q-item">
                    <i class="fa-solid fa-headset"></i>
                    <span>Liên hệ</span>
                </a>
                <a href="/tin-tuc" class="mh-q-item">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Tin tức</span>
                </a>
                <a href="/khuyen-mai" class="mh-q-item">
                    <i class="fa-solid fa-tags"></i>
                    <span>Ưu đãi</span>
                </a>
            </div>

            <div class="mh-divider-text">DANH MỤC SẢN PHẨM</div>

            <nav class="mh-accordion">
                <!-- iPhone -->
                @if ($menuIphones->isNotEmpty())
                    <div class="mh-acc-item">
                        <div class="mh-acc-header">
                            <a href="/iphone" class="mh-acc-link">iPhone</a>
                            <span class="mh-acc-trigger"><i class="fa-solid fa-chevron-down"></i></span>
                        </div>
                        <div class="mh-acc-content">
                            @foreach ($menuIphones as $series)
                                <div class="mh-sub-acc">
                                    <div class="mh-sub-header">
                                        <a href="{{ url($series->slug) }}">{{ $series->name }}</a>
                                        @if ($series->children->isNotEmpty())
                                            <span class="mh-sub-trigger"><i class="fa-solid fa-plus"></i></span>
                                        @endif
                                    </div>
                                    @if ($series->children->isNotEmpty())
                                        <div class="mh-sub-content">
                                            @foreach ($series->children as $model)
                                                <a href="{{ url($model->slug) }}">{{ $model->name }}</a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Samsung -->
                @if ($menuSamsungs->isNotEmpty())
                    <div class="mh-acc-item">
                        <div class="mh-acc-header">
                            <a href="/samsung" class="mh-acc-link">Samsung Galaxy</a>
                            <span class="mh-acc-trigger"><i class="fa-solid fa-chevron-down"></i></span>
                        </div>
                        <div class="mh-acc-content">
                            @foreach ($menuSamsungs as $series)
                                <div class="mh-sub-acc">
                                    <div class="mh-sub-header">
                                        <a href="{{ url($series->slug) }}">{{ $series->name }}</a>
                                        @if ($series->children->isNotEmpty())
                                            <span class="mh-sub-trigger"><i class="fa-solid fa-plus"></i></span>
                                        @endif
                                    </div>
                                    @if ($series->children->isNotEmpty())
                                        <div class="mh-sub-content">
                                            @foreach ($series->children as $model)
                                                <a href="{{ url($model->slug) }}">{{ $model->name }}</a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Dịch vụ Sim -->
                @if ($menuSims->isNotEmpty())
                    <div class="mh-acc-item">
                        <div class="mh-acc-header">
                            <a href="/goi-cuoc/goi-cuoc" class="mh-acc-link">Dịch vụ Sim</a>
                            <span class="mh-acc-trigger"><i class="fa-solid fa-chevron-down"></i></span>
                        </div>
                        <div class="mh-acc-content">
                            @foreach ($menuSims as $type)
                                <div class="mh-sub-acc">
                                    <div class="mh-sub-header">
                                        <a href="{{ route('package.category', $type->slug) }}">{{ $type->name }}</a>
                                        @if ($type->children->isNotEmpty())
                                            <span class="mh-sub-trigger"><i class="fa-solid fa-plus"></i></span>
                                        @endif
                                    </div>
                                    @if ($type->children->isNotEmpty())
                                        <div class="mh-sub-content">
                                            @foreach ($type->children as $subType)
                                                <a
                                                    href="{{ route('package.category', $subType->slug) }}">{{ $subType->name }}</a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </nav>
        </div>

        <div class="mh-drawer-footer">
            <p>© 2026 TuoiDuyen Mobile - Mobile App Version</p>
        </div>
    </aside>
</header>
@include('partials.header-lib')
