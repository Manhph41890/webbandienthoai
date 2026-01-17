@extends('client.desktop.layouts.app')

@section('content')
<div class="err-wrapper">
    <div class="err-container">
        <!-- Icon cái khiên/khóa -->
        <div class="err-code" style="background: linear-gradient(135deg, #1e293b 0%, #ef4444 100%); -webkit-background-clip: text;">
            403
        </div>
        
        <h2 class="err-title">Khu vực hạn chế truy cập!</h2>
        <p class="err-desc">
            Bạn không có quyền truy cập vào nội dung này. Nếu bạn cho rằng đây là một lỗi, vui lòng liên hệ với quản trị viên hệ thống <b>Toanhong Korea</b>.
        </p>

        <div class="err-actions">
            <a href="/" class="err-btn err-btn-primary">
                <i class="fa-solid fa-house"></i> Quay về trang chủ
            </a>
            <a href="{{ route('contact.index') }}" class="err-btn err-btn-outline">
                <i class="fa-solid fa-headset"></i> Hỗ trợ kỹ thuật
            </a>
        </div>
    </div>
</div>
@endsection
@include('client.desktop.pages.http-lib')