@extends('client.desktop.layouts.app')

@section('content')
    <div class="err-wrapper">
        <div class="err-container">
            <!-- Icon minh họa (Có thể thay bằng SVG) -->
            <div class="err-code">404</div>

            <h2 class="err-title">Ối! Trang này không tồn tại.</h2>
            <p class="err-desc">
                Có vẻ như đường dẫn bạn đang truy cập đã bị thay đổi, xóa bỏ hoặc không tồn tại. Hãy kiểm tra lại URL hoặc
                quay về trang chủ.
            </p>

            <div class="err-actions">
                <a href="/" class="err-btn err-btn-primary">
                    <i class="fa-solid fa-house"></i> Quay về trang chủ
                </a>
                <a href="javascript:history.back()" class="err-btn err-btn-outline">
                    <i class="fa-solid fa-arrow-left"></i> Quay lại trang trước
                </a>
            </div>
        </div>
    </div>
@endsection
@include('client.desktop.pages.http-lib')