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
                    <form action="{{ route('search') }}" method="GET">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm kiếm...">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>

                @include('partials.user-nav')
            </div>

            <!-- Navigation Menu -->
            <nav class="main-navigation">
                <ul class="nav-list">
                    <li><a href="/">Trang Chủ</a></li>

                    <!-- Menu iPhone -->
                    <!-- Menu iPhone -->
                    @if ($menuIphones->isNotEmpty())
                        <li class="has-dropdown">
                            <a href="/iphone"> <!-- Giữ link tổng cho iPhone -->
                                <img src="{{ asset('logo/logo_apple.png') }}" alt="Apple" class="nav-icon_apple">
                                iPhone <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($menuIphones as $series)
                                    <!-- Lúc này $series đã là iPhone 16, 15... -->
                                    <li class="{{ $series->children->isNotEmpty() ? 'has-submenu' : '' }}">
                                        <a href="{{ url($series->slug) }}">
                                            {{ $series->name }}
                                            @if ($series->children->isNotEmpty())
                                                <i class="fa-solid fa-chevron-right"></i>
                                            @endif
                                        </a>
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

                    <!-- Menu Samsung (Tương tự) -->
                    @if ($menuSamsungs->isNotEmpty())
                        <li class="has-dropdown">
                            <a href="/samsung">
                                <img src="{{ asset('logo/logo_samsung.png') }}" alt="Samsung" class="nav-icon_samsung">
                                <i class="fa-solid fa-chevron-right arrow-icon" style="margin-top: 6px"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($menuSamsungs as $series)
                                    <li class="{{ $series->children->isNotEmpty() ? 'has-submenu' : '' }}">
                                        <a href="{{ url($series->slug) }}">
                                            {{ $series->name }}
                                            @if ($series->children->isNotEmpty())
                                                <i class="fa-solid fa-chevron-right"></i>
                                            @endif
                                        </a>
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
                            <a href="/goi-cuoc/goi-cuoc"> <!-- Link này có thể trỏ về trang tổng hợp gói cước -->
                                Dịch vụ Sim <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($menuSims as $type)
                                    {{-- Cấp 1: Vina, Viettel... --}}
                                    <li class="{{ $type->children->isNotEmpty() ? 'has-submenu' : '' }}">
                                        {{-- SỬA Ở ĐÂY: Thêm tiền tố /goi-cuoc/ --}}
                                        <a href="{{ route('package.category', $type->slug) }}">
                                            {{ $type->name }}
                                            @if ($type->children->isNotEmpty())
                                                <i class="fa-solid fa-chevron-right"></i>
                                            @endif
                                        </a>

                                        @if ($type->children->isNotEmpty())
                                            <ul class="submenu">
                                                @foreach ($type->children as $subType)
                                                    {{-- Cấp 2: Gói 4G, Gói Thoại... --}}
                                                    <li>
                                                        {{-- SỬA Ở ĐÂY: Thêm tiền tố /goi-cuoc/ --}}
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

                    <li><a href="/lien-he">Liên Hệ</a></li>
                </ul>
            </nav>
        </div>
    </header>
