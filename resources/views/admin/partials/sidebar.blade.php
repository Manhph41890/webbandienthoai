<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
            <img src="{{asset('logo/logo_remove.png')}}" alt="Logo" width="90%">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    {{-- Sử dụng Request::is() để kiểm tra route hiện tại và thêm class 'active' --}}
    {{-- <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Thống kê (Dashboard)</span>
        </a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý Nội dung
    </div>

    <!-- Nav Item - Quản lý Danh mục -->
    <li class="nav-item {{ Request::is('admin/categories*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Quản lý Danh Mục</span>
        </a>
    </li>

    <!-- Nav Item - Quản lý Điện thoại -->
    <li class="nav-item {{ Request::is('admin/phones*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsephones"
            aria-expanded="true" aria-controls="collapsephones">
            <i class="fas fa-fw fa-pen-square"></i>
            <span>Quản lý Điện thoại</span>
        </a>
        <div id="collapsephones" class="collapse {{ Request::is('admin/phones*') ? 'show' : '' }}"
            aria-labelledby="headingphones" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/phones') && !request()->routeIs('phones.trash') ? 'active' : '' }}"
                    href="{{ route('admin.phones.index') }}">Danh sách</a>
                <a class="collapse-item {{ Request::is('admin/phones/create') ? 'active' : '' }}"
                    href="{{ route('admin.phones.create') }}">Thêm mới</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Quản lý Gói Cước -->
    <li class="nav-item {{ Request::is('admin/packages*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepackages"
            aria-expanded="true" aria-controls="collapsepackages">
            <i class="fas fa-fw fa-pen-square"></i>
            <span>Quản lý Gói Cước</span>
        </a>
        <div id="collapsepackages" class="collapse {{ Request::is('admin/packages*') ? 'show' : '' }}"
            aria-labelledby="headingpackages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/packages') && !request()->routeIs('packages.trash') ? 'active' : '' }}"
                    href="{{ route('admin.packages.index') }}">Danh sách</a>
                <a class="collapse-item {{ Request::is('admin/packages/create') ? 'active' : '' }}"
                    href="{{ route('admin.packages.create') }}">Thêm mới</a>
            </div>
        </div>
    </li>


    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý Tài khoản
    </div>

    <!-- Nav Item - Quản lý Tài khoản -->
    <li class="nav-item {{ Request::is('admin/accounts*') || Request::is('admin/users*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccounts"
            aria-expanded="true" aria-controls="collapseAccounts">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>Quản lý Tài khoản</span>
        </a>
        <div id="collapseAccounts"
            class="collapse {{ Request::is('admin/accounts*') || Request::is('admin/users*') ? 'show' : '' }}"
            aria-labelledby="headingAccounts" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/accounts') && !request()->routeIs('admin.accounts.users.index') ? 'active' : '' }}"
                    href="{{ route('admin.accounts.index') }}">Tài khoản Nhân viên</a>
                <a class="collapse-item {{ request()->routeIs('admin.accounts.users.index') ? 'active' : '' }}"
                    href="{{ route('admin.accounts.users.index') }}">Tài khoản Người dùng</a>
                <a class="collapse-item {{ Request::is('admin/accounts/create') ? 'active' : '' }}"
                    href="{{ route('admin.accounts.create') }}">Thêm nhân viên</a>
            </div>
        </div>
    </li>

    {{-- Menu đơn hàng --}}
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">


    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý Liên Hệ
    </div>

    <!-- Nav Item - Quản lý Liên Hệ -->
    <li class="nav-item {{ Request::is('admin/contact*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.contact.index') }}">
            <i class="fas fa-fw fa-file-invoice-dollar"></i>
            <span>Yêu cầu cần phản hồi</span>
        </a>
    </li>
    <!-- Heading -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
