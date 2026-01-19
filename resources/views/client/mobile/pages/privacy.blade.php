@extends('client.mobile.layouts.app')

@section('content')
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #007bff;
            --bg-light: #f4f7f6;
        }

        .privacy-body {
            background-color: var(--bg-light);
            padding-bottom: 50px;
        }

        .privacy-card {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .privacy-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-top: 25px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            border-left: 4px solid var(--accent-color);
            padding-left: 15px;
        }

        .content-box {
            padding: 30px 40px;
            line-height: 1.8;
            color: #444;
        }

        .deletion-instruction {
            background-color: #fff4f4;
            border: 1px dashed #e74c3c;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .contact-info-card {
            background: #e9ecef;
            border-radius: 10px;
            padding: 20px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .contact-item i {
            width: 30px;
            color: var(--accent-color);
            font-size: 1.2rem;
        }

        /* Hiệu ứng cho danh sách */
        .policy-list {
            list-style: none;
            padding-left: 0;
        }

        .policy-list li {
            position: relative;
            padding-left: 25px;
            margin-bottom: 10px;
        }

        .policy-list li::before {
            content: "\F633";
            /* Bootstrap icon check */
            font-family: bootstrap-icons;
            position: absolute;
            left: 0;
            color: #28a745;
        }
    </style>

    <div class="privacy-body">
        <!-- Header đơn giản, uy tín -->
        <div class="privacy-header">
            <div class="container">
                <h1 class="fw-bold">Chính Sách Bảo Mật</h1>
                <p class="mb-0 opacity-75">Cam kết bảo vệ quyền riêng tư và dữ liệu của khách hàng tại Tươi Duyên Mobile</p>
            </div>
        </div>

        <div class="container mt-n4">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="privacy-card">
                        <div class="content-box">
                            <p class="lead text-center mb-4">
                                Chào mừng bạn đến với <strong>Tươi Duyên Mobile</strong>. Chúng tôi hiểu rằng sự riêng tư
                                của
                                bạn là vô cùng quan trọng.
                            </p>

                            <!-- Mục 1 -->
                            <h3 class="section-title"><i class="bi bi-database-add me-2"></i>1. Thông tin chúng tôi thu thập
                            </h3>
                            <p>Nhằm tối ưu hóa trải nghiệm người dùng, khi bạn sử dụng tính năng <strong>Đăng nhập qua
                                    Facebook</strong>, hệ thống sẽ thu thập các thông tin công khai gồm:</p>
                            <ul class="policy-list">
                                <li>Họ và tên hiển thị trên Facebook.</li>
                                <li>Địa chỉ Email liên kết.</li>
                                <li>ID người dùng (User ID) để định danh tài khoản.</li>
                            </ul>

                            <!-- Mục 2 -->
                            <h3 class="section-title"><i class="bi bi-gear-wide-connected me-2"></i>2. Cách chúng tôi sử
                                dụng thông tin</h3>
                            <p>Dữ liệu của bạn được sử dụng vào các mục đích hợp pháp sau:</p>
                            <ul class="policy-list">
                                <li>Tạo và quản lý tài khoản thành viên trên hệ thống.</li>
                                <li>Xử lý đơn hàng mua bán điện thoại, đăng ký Sim thẻ.</li>
                                <li>Hỗ trợ khách hàng nhanh chóng tại khu vực Busan và toàn Hàn Quốc.</li>
                            </ul>

                            <!-- Mục 3 - QUAN TRỌNG CHO FACEBOOK APP -->
                            <h3 class="section-title text-danger"><i class="bi bi-shield-lock-fill me-2"></i>3. Chính sách
                                xóa dữ liệu (Data Deletion)</h3>
                            <p>Chúng tôi tôn trọng quyền kiểm soát dữ liệu của bạn. Theo quy định của Facebook, chúng tôi
                                cung cấp quy trình xóa dữ liệu rõ ràng:</p>
                            <div class="deletion-instruction">
                                <p class="fw-bold mb-2">Để xóa dữ liệu hoạt động trên Tươi Duyên Mobile, bạn thực hiện một
                                    trong hai cách:</p>
                                <ol>
                                    <li><strong>Gửi Email:</strong> Gửi yêu cầu tới <a
                                            href="mailto:support@TuoiDuyenMobile.com"
                                            class="text-decoration-none fw-bold">support@TuoiDuyenMobile.com</a> với nội
                                        dung
                                        "Yêu cầu xóa tài khoản".</li>
                                    <li><strong>Liên hệ trực tiếp:</strong> Gọi Hotline <a href="tel:01028288333"
                                            class="text-decoration-none fw-bold">010.6565.2999</a> để được hỗ trợ tức thì.
                                    </li>
                                </ol>
                                <p class="text-muted mb-0 small"><i class="bi bi-info-circle me-1"></i> Sau khi tiếp nhận,
                                    chúng tôi sẽ xác nhận và tiến hành xóa toàn bộ dữ liệu định danh của bạn khỏi hệ thống
                                    trong vòng <strong>24 giờ</strong> làm việc.</p>
                            </div>

                            <!-- Mục 4 -->
                            <h3 class="section-title"><i class="bi bi-geo-alt-fill me-2"></i>4. Thông tin liên hệ</h3>
                            <div class="contact-info-card">
                                <h5 class="fw-bold">Cửa hàng Tươi Duyên Mobile</h5>
                                <div class="contact-item">
                                    <i class="bi bi-house-door"></i>
                                    <span>19 Jangrimsijang 4-gil, Saha-gu, Busan <br> (부산시 사하구 장림시장4길 19번호 1층)</span>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-phone"></i>
                                    <span>010-6565-2999 / 010-8282-6868</span>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-envelope"></i>
                                    <span>support@TuoiDuyenMobile.com</span>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <p class="text-muted small">Cập nhật lần cuối: {{ date('d/m/Y') }}</p>
                                <hr>
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4">Quay lại trang
                                    trước</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
