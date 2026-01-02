<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toàn Hồng Korea')</title> {{-- Cho phép các trang con định nghĩa title riêng --}}

    <!-- Thêm Favicon (Biểu tượng trên tab trình duyệt) -->
    <link rel="icon" type="image/png" href="{{ asset('logo/logo.png') }}">
    <!-- Biểu tượng cho iPhone/iOS -->
    <link rel="apple-touch-icon" href="{{ asset('logo/logo.png') }}">


    <link rel="stylesheet" href="{{ asset('css/client_styles_mb.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/desk/client_styles.css') }}"> --}}
    <script src="{{ asset('js/main.js') }}"></script>
    {{-- <script src="{{ asset('js/main_mb.js') }}"></script> --}}
    <!-- Font Awesome cho icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Font Awesome để dùng icon search, user, heart, arrow -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('styles')
</head>

<body>
    @include('client.mobile.partials.header') {{-- Bao gồm phần header --}}

    @yield('content') {{-- Đây là nơi nội dung chính của từng trang sẽ được inject vào --}}
  @include('client.mobile.layouts.contact')
    @include('client.mobile.partials.footer') {{-- Bao gồm phần footer --}}

    @stack('scripts')
</body>

</html>
