@extends('auth.auth')

@section('title', 'Đăng nhập')

@section('content')
    <!-- Cột Form -->
    <div class="auth-form-column">
        <h2>Chào mừng trở lại!</h2>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <p class="social-prompt">Đăng nhập nhanh bằng tài khoản mạng xã hội</p>
        <div class="social-login">
            <a href="{{ route('facebook.login') }}" class="facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="google"><i class="fab fa-google-plus-g"></i></a>
        </div>

        <div class="divider">Hoặc</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" name="email" placeholder="Email của bạn" value="{{ old('email') }}"
                    class="@error('email') is-invalid @enderror">
            </div>
            @error('email')
                <small class="error-text">{{ $message }}</small>
            @enderror


            <div class="form-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password" placeholder="Mật khẩu"
                    class="@error('password') is-invalid @enderror" id="password-field">
                <button type="button" class="password-toggle"><i class="fas fa-eye"></i></button>
            </div>
            @error('password')
                <small class="error-text">{{ $message }}</small>
            @enderror


            <div class="form-actions">
                <a href="#">Quên mật khẩu?</a>
            </div>
            <button type="submit" class="btn-submit">ĐĂNG NHẬP</button>
        </form>

        <p class="auth-switch-link">
            Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a>
        </p>
    </div>

    <!-- Cột Ảnh -->

    {{-- Nếu KHÔNG PHẢI mobile (tức là desktop) thì mới hiển thị --}}
    @if (!$isMobile)
        <div class="auth-image-column">
            <img src="{{ asset('logo/logo_remove.png') }}" alt="ToanHongKorea Interior">
            <h3>Kết nối thông minh cho cuộc sống số</h3>
            <p>Giải pháp trọn gói từ điện thoại, sim đến gói cước – đơn giản, nhanh gọn, tiết kiệm chi phí.</p>
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        // Xử lý ẩn/hiện mật khẩu
        document.querySelectorAll('.password-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const passwordField = this.previousElementSibling;
                const icon = this.querySelector('i');
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
@endpush
