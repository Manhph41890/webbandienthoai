<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        {{-- Phần này có thể giữ lại nếu bạn muốn phát triển chức năng thông báo sau này --}}
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                {{-- Counter - Alerts (có thể làm động sau) --}}
                <span class="badge badge-danger badge-counter">1</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Trung tâm thông báo
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">{{ date('d/m/Y') }}</div>
                        Chào mừng đến với trang quản trị MobiTech!
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Xem tất cả</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        {{-- ======================================================= --}}
        {{-- === PHẦN KIỂM TRA ĐĂNG NHẬP BẮT ĐẦU TỪ ĐÂY === --}}
        {{-- ======================================================= --}}
        @auth {{-- Nếu người dùng đã đăng nhập --}}
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>

                    {{-- Hiển thị avatar hoặc ảnh mặc định --}}
                    @if (Auth::user()->avatar)
                        <img class="img-profile rounded-circle" src="{{ asset('storage/' . Auth::user()->avatar) }}">
                    @else
                        <img class="img-profile rounded-circle" src="{{ asset('sb-admin/img/undraw_profile.svg') }}">
                    @endif
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Thông tin cá nhân
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Đăng xuất
                    </a>
                </div>
            </li>
        @else
            {{-- Nếu là khách (chưa đăng nhập) --}}
            <li class="nav-item">
                <a class="nav-link text-gray-600" href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt fa-sm fa-fw mr-1"></i>
                    Đăng nhập
                </a>
            </li>
        @endguest
    </ul>

</nav>
<!-- End of Topbar -->

{{-- Modal Đăng xuất (cần có ở đâu đó trong layout chính, ví dụ file scripts.blade.php) --}}
{{-- Đảm bảo rằng file admin/partials/scripts.blade.php có đoạn modal này --}}
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng rời đi?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Chọn "Đăng xuất" bên dưới nếu bạn đã sẵn sàng kết thúc phiên làm việc hiện tại.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                {{-- Form đăng xuất --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Đăng xuất</button>
                </form>
            </div>
        </div>
    </div>
</div>
