@extends('layouts.app')

@section('content')
    <section class="contact-mobile-section">
        <div class="mobile-container">
            <!-- Header -->
            <div class="mobile-header">
                <h2 class="mobile-title">Liên Hệ</h2>
                <p class="mobile-subtitle">Chúng tôi sẽ phản hồi bạn trong vòng 24h.</p>
            </div>

            <!-- Form liên hệ -->
            <div class="mobile-card form-card">
                <form action="{{ route('contact.store') }}" method="POST" class="mobile-form">
                    @csrf
                    <div class="m-input-group">
                        <label>Họ và tên</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nhập họ và tên..."
                            required>
                        @error('name')
                            <span class="m-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="m-input-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="example@gmail.com"
                            required>
                        @error('email')
                            <span class="m-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="m-input-group">
                        <label>Số điện thoại</label>
                        <input type="tel" name="phone_number" value="{{ old('phone_number') }}"
                            placeholder="Số điện thoại của bạn" required>
                        @error('phone_number')
                            <span class="m-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="m-input-group">
                        <label>Dịch vụ quan tâm</label>
                        <select name="service" required>
                            <option value="" disabled selected>Chọn dịch vụ...</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->value }}"
                                    {{ old('service') == $service->value ? 'selected' : '' }}>
                                    {{ $service->value }}
                                </option>
                            @endforeach
                        </select>
                        @error('service')
                            <span class="m-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="m-input-group">
                        <label>Yêu cầu của bạn</label>
                        <textarea name="request" rows="4" placeholder="Viết yêu cầu cụ thể tại đây...">{{ old('request') }}</textarea>
                    </div>

                    <button type="submit" class="m-btn-submit">
                        GỬI YÊU CẦU NGAY
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>

            <!-- Thông tin & Bản đồ -->
            <div class="mobile-card info-card">
                <div class="m-info-list">
                    <div class="m-info-item">
                        <div class="m-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="m-text">
                            <strong>Địa chỉ:</strong>
                            <p>Nhà Văn Hóa Thôn Thế Giới, Đông Ninh, Đông Sơn, Thanh Hóa</p>
                        </div>
                    </div>
                    <div class="m-info-item">
                        <div class="m-icon"><i class="fa-solid fa-phone"></i></div>
                        <div class="m-text">
                            <strong>Hotline:</strong>
                            <p>010 2828 8333 - 010 8282 6868</p>
                        </div><br>
                        <div class="info-item">
                            <i class="fa-brands fa-facebook"></i>
                            <a href="https://www.facebook.com/anhtoan270189/" target="_blank" style="text-decoration: none; color: blacks;">Toàn Hồng Korea</a>
                        </div>
                    </div>
                </div>

                <div class="m-map-wrapper">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4618.629331215925!2d105.66507217594844!3d19.816552628305796!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3136fb00202ec2a5%3A0x2ef88b4e807fa3e7!2zVGjDtG4gVGjhur8gR2nhu5tpIC0gWMOjIMSQw7RuZyBOaW5oIC0gxJDDtG5nIFPGoW4!5e1!3m2!1svi!2s!4v1767490804932!5m2!1svi!2s"
                        width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </section>
@endsection

@include('pages.contact-lib')
