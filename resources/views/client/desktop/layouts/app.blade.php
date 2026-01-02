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


    <link rel="stylesheet" href="{{ asset('css/desk/header_footer.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/desk/client_styles.css') }}"> --}}
    <script src="{{ asset('js/main.js') }}"></script>
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

    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @stack('styles')
</head>

<body>
    @include('client.desktop.partials.header') {{-- Bao gồm phần header --}}

    @yield('content') {{-- Đây là nơi nội dung chính của từng trang sẽ được inject vào --}}
    <!-- Floating Messenger Button -->
    <div id="messenger-widget" class="messenger-fixed">
        <div class="messenger-tooltip">Bấm để chat với tư vấn viên!</div>
        <a href="javascript:void(0)" id="messenger-bubble" onclick="openMessenger()">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/be/Facebook_Messenger_logo_2020.svg"
                alt="Messenger">
        </a>
    </div>

    <style>
        .messenger-fixed {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        #messenger-bubble {
            width: 60px;
            height: 60px;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s;
        }

        #messenger-bubble:hover {
            transform: scale(1.1);
        }

        #messenger-bubble img {
            width: 45px;
            height: 45px;
        }

        .messenger-tooltip {
            background: #333;
            color: #fff;
            padding: 5px 12px;
            border-radius: 5px;
            font-size: 13px;
            margin-bottom: 10px;
            position: relative;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-5px);
            }

            60% {
                transform: translateY(-3px);
            }
        }
    </style>
    @include('client.desktop.partials.footer') {{-- Bao gồm phần footer --}}

    @stack('scripts')
</body>

</html>
