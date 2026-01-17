@extends('auth.auth')

@section('title', 'Đăng ký tài khoản')

@section('content')
    <!-- Cột Form -->
    <div class="auth-form-column">
        <h2>Tạo tài khoản mới</h2>
        <p class="social-prompt">Đăng ký nhanh bằng tài khoản mạng xã hội</p>
        <div class="social-login">
            <a href="{{ route('facebook.login') }}" class="facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="{{ route('google.login') }}" class="google">
                <i class="fab fa-google-plus-g"></i>
            </a>
        </div>
        <div class="divider">Hoặc</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <i class="fas fa-user input-icon"></i>
                <input type="text" name="name" placeholder="Họ và tên của bạn" value="{{ old('name') }}"
                    class="@error('name') is-invalid @enderror">
            </div>
            @error('name')
                <small class="error-text">{{ $message }}</small>
            @enderror

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
                    class="@error('password') is-invalid @enderror" id="password-field-1">
                <button type="button" class="password-toggle"><i class="fas fa-eye"></i></button>
            </div>
            @error('password')
                <small class="error-text">{{ $message }}</small>
            @enderror

            <div class="form-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" id="password-field-2">
            </div>


            <button type="submit" class="btn-submit">ĐĂNG KÝ</button>
            <p class="auth-switch-link">
                Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a>
            </p>
        </form>

        <p class="register-terms">
            Khi bấm đăng ký bạn đã đồng ý với <a href="#">Điều khoản dịch vụ</a> và <a href="#">Chính sách quyền
                riêng tư</a> của ToanHongKorea.
        </p>

    </div>

    <div class="auth-image-column">
        {{-- Thay thế ảnh minh họa bằng ảnh nội thất sang trọng --}}
        <img src="{{ asset('logo/logo_remove.png') }}" alt="ToanHongKorea Interior">
        <h3>Kết nối thông minh cho cuộc sống số</h3>
        <p>Giải pháp trọn gói từ điện thoại, sim đến gói cước – đơn giản, nhanh gọn, tiết kiệm chi phí.</p>

    </div>
@endsection

@push('scripts')
    <script>
        // Xử lý ẩn/hiện mật khẩu (code tương tự trang login)
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
