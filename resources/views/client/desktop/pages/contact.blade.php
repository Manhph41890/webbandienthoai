@extends('client.desktop.layouts.app')

@section('content')
    <section class="contact-section">
        <div class="contact-container" style="max-width: 1100px !important">
            <div class="contact-grid">

                <!-- Bên trái: Form liên hệ -->
                <div class="contact-form-side">
                    <h2 class="contact-title">Liên Hệ</h2>
                    <p class="contact-subtitle">Hãy để lại thông tin, chúng tôi sẽ phản hồi bạn trong vòng 24h.</p>

                    <form action="#" method="POST" class="main-contact-form">
                        <div class="input-group">
                            <input type="text" name="name" placeholder="Họ và tên của bạn" required>
                        </div>

                        <div class="input-row">
                            <div class="input-group">
                                <input type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="input-group">
                                <input type="tel" name="phone" placeholder="Số điện thoại" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <select name="service" required>
                                <option value="" disabled selected>Vui lòng chọn dịch vụ mà bạn quan tâm *</option>
                                <option value="tu-van">Tư vấn mua điện thoại</option>
                                <option value="bao-hanh">Hỗ trợ bảo hành</option>
                                <option value="gop-y">Góp ý dịch vụ</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <textarea name="message" rows="4" placeholder="Yêu cầu cụ thể (nếu có)"></textarea>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn-submit">
                                <span>Gửi yêu cầu</span>
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Bên phải: Bản đồ -->
                <div class="contact-map-side">
                    <div class="map-wrapper">
                        <!-- Thay src bằng link bản đồ thực tế của bạn -->
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4618.629331215925!2d105.66507217594844!3d19.816552628305796!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3136fb00202ec2a5%3A0x2ef88b4e807fa3e7!2zVGjDtG4gVGjhur8gR2nhu5tpIC0gWMOjIMSQw7RuZyBOaW5oIC0gxJDDtG5nIFPGoW4!5e1!3m2!1svi!2s!4v1767490804932!5m2!1svi!2s"
                            width="550" height="430" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="contact-info-mini">
                        <div class="info-item">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Nhà Văn Hóa Thôn Thế Giới</span>
                        </div>
                        <div class="info-item">
                            <i class="fa-solid fa-phone"></i>
                            <span>010 2828 8333 - 010 8282 6868</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@include('pages.contact-lib')
