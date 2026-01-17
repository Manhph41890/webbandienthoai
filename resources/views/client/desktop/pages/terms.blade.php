@extends('client.desktop.layouts.app')

@section('content')
<style>
    /* Tùy chỉnh thêm để giao diện mượt mà hơn */
    .policy-header {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
        padding: 60px 0;
        margin-bottom: 40px;
        border-radius: 0 0 50px 50px;
    }
    .policy-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        padding: 40px;
        margin-top: -100px; /* Tạo hiệu ứng đè lên header */
    }
    .policy-section {
        margin-bottom: 30px;
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
    }
    .policy-section:last-child {
        border-bottom: none;
    }
    .policy-section h3 {
        color: #0056b3;
        font-size: 1.25rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .policy-section h3 i {
        font-size: 1.5rem;
        color: #ffc107; /* Màu vàng tạo điểm nhấn */
    }
    .info-box {
        background: #f8f9fa;
        border-left: 5px solid #007bff;
        padding: 20px;
        border-radius: 5px;
    }
</style>

<div class="policy-header text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Điều Khoản Dịch Vụ</h1>
        <p class="lead">Cập nhật lần cuối: {{ date('d/m/Y') }}</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="policy-card">
                <p class="text-muted mb-5 italic">
                    Chào mừng bạn đến với <strong>Toàn Hồng Korea</strong>. Việc bạn truy cập và sử dụng website 
                    <a href="https://toanhongkorean.com" class="text-decoration-none">toanhongkorean.com</a> 
                    đồng nghĩa với việc bạn chấp nhận các điều khoản và điều kiện dưới đây:
                </p>

                <!-- Mục 1 -->
                <div class="policy-section">
                    <h3><i class="bi bi-shield-check"></i> 1. Dịch vụ cung cấp</h3>
                    <p>Chúng tôi chuyên cung cấp các giải pháp công nghệ toàn diện tại Busan và Hàn Quốc bao gồm:</p>
                    <ul>
                        <li>Mua bán điện thoại mới và cũ (iPhone, Samsung, v.v.)</li>
                        <li>Dịch vụ Sim thẻ, đăng ký gói cước nhà mạng.</li>
                        <li>Phụ kiện công nghệ chính hãng.</li>
                    </ul>
                </div>

                <!-- Mục 2 -->
                <div class="policy-section">
                    <h3><i class="bi bi-person-badge"></i> 2. Trách nhiệm người dùng</h3>
                    <p>Để đảm bảo quyền lợi, người dùng cam kết:</p>
                    <ul>
                        <li>Cung cấp thông tin chính xác (Họ tên, số điện thoại, địa chỉ) khi đăng ký dịch vụ.</li>
                        <li>Không sử dụng dịch vụ vào các mục đích vi phạm pháp luật Hàn Quốc.</li>
                    </ul>
                </div>

                <!-- Mục 3 -->
                <div class="policy-section">
                    <h3><i class="bi bi-credit-card"></i> 3. Quy định thanh toán</h3>
                    <p>Mọi giao dịch tại <strong>Toàn Hồng Korea</strong> được thực hiện minh bạch:</p>
                    <div class="info-box">
                        <p class="mb-0">Chấp nhận thanh toán tiền mặt trực tiếp hoặc chuyển khoản qua hệ thống ngân hàng Hàn Quốc (KB Bank, Shinhan, Woori, v.v.).</p>
                    </div>
                </div>

                <!-- Mục 4 -->
                <div class="policy-section">
                    <h3><i class="bi bi-geo-alt"></i> 4. Thông tin liên hệ</h3>
                    <p>Mọi thắc mắc về điều khoản, vui lòng liên hệ trực tiếp cửa hàng:</p>
                    <div class="card bg-light border-0">
                        <div class="card-body">
                            <h5 class="fw-bold">Cửa hàng Toàn Hồng Korea</h5>
                            <p class="mb-1"><i class="bi bi-map"></i> <strong>Địa chỉ:</strong> 19 Jangrimsijang 4-gil, Saha-gu, Busan.</p>
                            <p class="mb-0"><i class="bi bi-telephone"></i> <strong>Hotline:</strong> (Vui lòng bổ sung số điện thoại)</p>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <a href="/" class="btn btn-primary btn-lg px-5 shadow-sm">Tôi đã hiểu và Đồng ý</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection