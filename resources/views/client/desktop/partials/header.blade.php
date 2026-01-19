<header class="th-header">
    <div class="th-container">
        <!-- Tầng 1: Brand & Search & User -->
        <div class="th-header-main">
            <div class="th-logo">
                <a href="/">
                    <img src="{{ asset('logo/logo_remove.png') }}" alt="TuoiDuyen Mobile">
                </a>
            </div>

            <div class="th-search-wrapper">
                <form action="{{ route('search') }}" method="GET" class="th-search-form">
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Bạn tìm gì hôm nay? iPhone 16, Sim 4G...">
                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>

            <div class="th-user-nav">
                @include('partials.user-nav')
            </div>
        </div>

        <!-- Tầng 2: Navigation (Đồng bộ font & gạch chân đỏ từ Footer) -->
        <nav class="th-navigation">
            <ul class="th-nav-list">
                <!-- TRANG CHỦ: Chỉ active khi đường dẫn là '/' -->
                <li class="th-nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a href="/" class="th-nav-link">TRANG CHỦ</a>
                </li>

                <!-- IPHONE: Active khi đường dẫn bắt đầu bằng 'iphone' -->
                @if ($menuIphones->isNotEmpty())
                    <li class="th-nav-item th-has-dropdown {{ request()->is('iphone*') ? 'active' : '' }}">
                        <a href="/iphone" class="th-nav-link">
                            IPHONE <i class="fa-solid fa-chevron-down arrow-icon"></i>
                        </a>
                        <ul class="th-dropdown">
                            @foreach ($menuIphones as $series)
                                <li class="th-drop-item {{ $series->children->isNotEmpty() ? 'th-has-sub' : '' }}">
                                    <a href="{{ url($series->slug) }}">
                                        {{ $series->name }}
                                        @if ($series->children->isNotEmpty())
                                            <i class="fa-solid fa-chevron-right"></i>
                                        @endif
                                    </a>
                                    @if ($series->children->isNotEmpty())
                                        <ul class="th-submenu">
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

                <!-- SAMSUNG: Active khi đường dẫn bắt đầu bằng 'samsung' -->
                @if ($menuSamsungs->isNotEmpty())
                    <li class="th-nav-item th-has-dropdown {{ request()->is('samsung*') ? 'active' : '' }}">
                        <a href="/samsung" class="th-nav-link">
                            SAMSUNG <i class="fa-solid fa-chevron-down arrow-icon"></i>
                        </a>
                        <ul class="th-dropdown">
                            @foreach ($menuSamsungs as $series)
                                <li class="th-drop-item {{ $series->children->isNotEmpty() ? 'th-has-sub' : '' }}">
                                    <a href="{{ url($series->slug) }}">
                                        {{ $series->name }}
                                        @if ($series->children->isNotEmpty())
                                            <i class="fa-solid fa-chevron-right"></i>
                                        @endif
                                    </a>
                                    @if ($series->children->isNotEmpty())
                                        <ul class="th-submenu">
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

                <!-- DỊCH VỤ SIM: Active khi đường dẫn bắt đầu bằng 'goi-cuoc' -->
                @if ($menuSims->isNotEmpty())
                    <li class="th-nav-item th-has-dropdown {{ request()->is('goi-cuoc*') ? 'active' : '' }}">
                        <a href="/goi-cuoc/goi-cuoc" class="th-nav-link">
                            DỊCH VỤ SIM <i class="fa-solid fa-chevron-down arrow-icon"></i>
                        </a>
                        <ul class="th-dropdown">
                            @foreach ($menuSims as $type)
                                <li class="th-drop-item {{ $type->children->isNotEmpty() ? 'th-has-sub' : '' }}">
                                    <a href="{{ route('package.category', $type->slug) }}">
                                        {{ $type->name }}
                                        @if ($type->children->isNotEmpty())
                                            <i class="fa-solid fa-chevron-right"></i>
                                        @endif
                                    </a>
                                    @if ($type->children->isNotEmpty())
                                        <ul class="th-submenu">
                                            @foreach ($type->children as $subType)
                                                <li><a
                                                        href="{{ route('package.category', $subType->slug) }}">{{ $subType->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                <!-- LIÊN HỆ: Active khi đường dẫn là 'lien-he' -->
                <li class="th-nav-item {{ request()->is('lien-he*') ? 'active' : '' }}">
                    <a href="/lien-he" class="th-nav-link">LIÊN HỆ</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
@include('client.desktop.partials.header-lib')
