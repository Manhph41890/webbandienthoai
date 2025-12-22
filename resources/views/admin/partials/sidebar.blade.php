<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-newspaper"></i>
        </div>
        <div class="sidebar-brand-text mx-3">MobiTech</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    {{-- Sử dụng Request::is() để kiểm tra route hiện tại và thêm class 'active' --}}
    <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Thống kê (Dashboard)</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý Nội dung
    </div>

    <!-- Nav Item - Quản lý Danh mục -->
    <li class="nav-item {{ Request::is('admin/brands*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.categoriesindex') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Quản lý Thương hiệu</span>
        </a>
    </li>

    <!-- Nav Item - Quản lý Bài viết -->
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
                <a class="collapse-item {{ request()->routeIs('admin.accounts.users.index') ? 'active' : '' }}"
                    href="{{ route('admin.accounts.users.index') }}">Tài khoản Người dùng</a>
            </div>
        </div>
    </li>

    {{-- Menu đơn hàng --}}
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">


    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý Đơn hàng
    </div>

    <!-- Nav Item - Quản lý Đơn hàng -->
    <li class="nav-item {{ Request::is('admin/bills*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.bills.index') }}">
            <i class="fas fa-fw fa-file-invoice-dollar"></i>
            <span>Đơn hàng</span>
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
