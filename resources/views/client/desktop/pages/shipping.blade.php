@extends('client.desktop.layouts.app')

@section('content')
    <style>
        .shipping-header {
            background: linear-gradient(135deg, #0d6efd 0%, #003d99 100%);
            color: white;
            padding: 50px 0;
            text-align: center;
            border-radius: 0 0 30px 30px;
        }

        .shipping-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s;
            height: 100%;
        }

        .shipping-card:hover {
            transform: translateY(-5px);
        }

        .icon-box {
            width: 60px;
            height: 60px;
            background: #e7f1ff;
            color: #0d6efd;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .step-line {
            border-left: 2px dashed #dee2e6;
            padding-left: 30px;
            position: relative;
        }

        .step-line::before {
            content: '';
            position: absolute;
            left: -9px;
            top: 0;
            width: 16px;
            height: 16px;
            background: #0d6efd;
            border-radius: 50%;
        }
    </style>

    <div class="shipping-header mb-5">
        <div class="container">
            <h1 class="fw-bold"><i class="fa-solid fa-truck-fast me-2"></i>Chính Sách Giao Hàng</h1>
            <p class="lead">Nhanh chóng - An toàn - Tin cậy tại Hàn Quốc & Việt Nam</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row g-4">
            <!-- Khu vực Hàn Quốc -->
            <div class="col-md-6">
                <div class="card shipping-card shadow-sm p-4 border-top border-primary border-4">
                    <div class="icon-box">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <h3 class="fw-bold text-primary">Giao hàng tại Hàn Quốc</h3>
                    <p class="text-muted">Chúng tôi sử dụng các dịch vụ chuyển phát nhanh uy tín hàng đầu tại Hàn như CJ
                        Logistics, Post Office (우체국택배).</p>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fa-solid fa-circle-check text-success me-2"></i><strong>Phí giao
                                hàng:</strong> <span class="badge bg-success">MIỄN PHÍ 100%</span> cho mọi đơn hàng.</li>
                        <li class="mb-3"><i class="fa-solid fa-circle-check text-success me-2"></i><strong>Khu vực
                                Busan:</strong> Nhận hàng ngay trong ngày hoặc sáng hôm sau.</li>
                        <li class="mb-3"><i class="fa-solid fa-circle-check text-success me-2"></i><strong>Toàn
                                quốc:</strong> Thời gian từ 1 - 2 ngày làm việc (không tính CN).</li>
                    </ul>
                </div>
            </div>

            <!-- Khu vực Việt Nam -->
            <div class="col-md-6">
                <div class="card shipping-card shadow-sm p-4 border-top border-danger border-4">
                    <div class="icon-box" style="background: #fff0f0; color: #dc3545;">
                        <i class="fa-solid fa-plane-up"></i>
                    </div>
                    <h3 class="fw-bold text-danger">Gửi hàng về Việt Nam</h3>
                    <p class="text-muted">Hỗ trợ khách hàng gửi điện thoại, quà tặng về cho người thân tại Việt Nam thông
                        qua đường bay chuyên tuyến an toàn.</p>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fa-solid fa-circle-check text-success me-2"></i><strong>Cước phí
                                gửi:</strong> <span class="fw-bold text-dark">20.000 Won</span> / đơn hàng máy.</li>
                        <li class="mb-3"><i class="fa-solid fa-circle-check text-success me-2"></i><strong>Thời
                                gian:</strong> Nhận hàng sau 3 - 5 ngày làm việc.</li>
                        <li class="mb-3"><i class="fa-solid fa-circle-check text-success me-2"></i><strong>Cam
                                kết:</strong> Đền bù 100% giá trị nếu xảy ra thất lạc do vận chuyển.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Quy trình nhận hàng -->
        <div class="mt-5 p-4 bg-white rounded-4 shadow-sm">
            <h3 class="fw-bold mb-4 text-center">Quy trình kiểm tra & Nhận hàng</h3>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="step-line mb-4">
                        <h5>Bước 1: Kiểm tra khi nhân viên Thecbe giao hàng</h5>
                        <p class="text-muted small">Quý khách vui lòng kiểm tra vỏ hộp kiện hàng. Hộp phải còn nguyên băng
                            keo niêm phong, không có dấu hiệu bị rách, ướt hoặc móp méo bất thường.</p>
                    </div>
                    <div class="step-line mb-4">
                        <h5>Bước 2: Quay Video mở hộp (Bắt buộc để bảo hành)</h5>
                        <p class="text-muted small">Vì tính chất hàng công nghệ giá trị cao, quý khách <strong>vui lòng quay
                                clip rõ nét</strong> quá trình khui hộp. Video này là bằng chứng duy nhất để cửa hàng hỗ trợ
                            nếu máy bị lỗi do vận chuyển.</p>
                    </div>
                    <div class="step-line">
                        <h5>Bước 3: Xác nhận & Liên hệ</h5>
                        <p class="text-muted small">Nếu hàng hóa có bất kỳ vấn đề gì, hãy giữ nguyên trạng thái và gọi ngay
                            cho hotline <strong>010-6565-2999</strong>. Chúng tôi sẽ giải quyết ngay lập tức.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thông tin liên hệ nhanh -->
        <div class="alert alert-info mt-5 border-0 rounded-4 p-4 d-flex align-items-center">
            <div class="fs-1 me-4">
                <i class="fa-solid fa-truck-ramp-box text-info"></i>
            </div>
            <div>
                <h5 class="fw-bold">Hỗ trợ theo dõi đơn hàng (Tracking)</h5>
                <p class="mb-0">Sau khi gửi hàng, chúng tôi sẽ cung cấp <strong>Mã vận đơn</strong>. Quý khách có thể tự
                    tra cứu trên app của hãng Taekbae hoặc nhắn tin để nhân viên hỗ trợ check vị trí kiện hàng.</p>
                <div class="mt-3">
                    <a href="tel:01028288333" class="btn btn-primary rounded-pill px-4 fw-bold">Hotline Busan:
                        010.6565.2999</a>
                </div>
            </div>
        </div>
    </div>
@endsection
