<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Winbanks Express - @yield('title', 'Dashboard')</title>
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('sb-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sb-admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- Font Awesome cho icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="{{ asset('sb-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript -->
    <script src="{{ asset('sb-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sb-admin/js/sb-admin-2.min.js') }}"></script>

    @stack('styles')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        {{-- Sidebar --}}
        @include('admin.partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                {{-- Topbar/Header --}}
                @include('admin.partials.header')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content') {{-- Đây là nơi nội dung của từng trang sẽ được nạp vào --}}

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            {{-- Footer --}}
            @include('admin.partials.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    {{-- Scripts chung và modal --}}
    @include('admin.partials.scripts')
    @stack('scripts') {{-- Đây là nơi nội dung các modal sẽ được nạp vào --}}

</body>

</html>
