@extends('client.desktop.layouts.app')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1 class="text-primary fw-bold mb-4 text-center">Hướng Dẫn Đăng Ký Sim</h1>

                <div class="card border-0 shadow-sm p-4 mb-4">
                    <h4 class="fw-bold text-danger border-bottom pb-2 mt-4"><i class="fa-solid fa-file-invoice me-2"></i>1.
                        Giấy tờ cần chuẩn bị</h4>
                    <p>Để đăng ký Sim tại Hàn Quốc, quý khách cần cung cấp hình ảnh rõ nét của một trong các loại giấy tờ
                        sau:</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded text-center border">
                                <i class="fa-solid fa-passport fa-2x mb-2 text-primary"></i>
                                <p class="mb-0 fw-bold">Hộ chiếu (Passport)</p>
                                <small class="text-muted">(Dành cho người mới sang hoặc du lịch)</small>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded text-center border">
                                <i class="fa-solid fa-id-card fa-2x mb-2 text-primary"></i>
                                <p class="mb-0 fw-bold">Thẻ chứng minh thư (ARC)</p>
                                <small class="text-muted">(Dành cho người cư trú dài hạn)</small>
                            </div>
                        </div>
                    </div>

                    <h4 class="fw-bold text-danger border-bottom pb-2 mt-4"><i class="fa-solid fa-list-check me-2"></i>2.
                        Quy trình đăng ký</h4>
                    <div class="ms-3">
                        <p><strong>Bước 1:</strong> Chọn gói cước phù hợp với nhu cầu (Data, Nghe gọi).</p>
                        <p><strong>Bước 2:</strong> Gửi ảnh giấy tờ và địa chỉ nhận sim cho quản trị viên qua 01028288333
                        </p>
                        <p><strong>Bước 3:</strong> Cửa hàng kích hoạt và gửi Sim hỏa tốc.</p>
                    </div>

                    <h4 class="fw-bold text-danger border-bottom pb-2 mt-4"><i class="fa-solid fa-truck-fast me-2"></i>3.
                        Giao nhận hàng</h4>
                    <div class="alert alert-info border-0 shadow-sm">
                        <p class="mb-1">🚀 <strong>Giao hàng toàn Hàn Quốc:</strong> Nhận sim trong vòng 1-2 ngày làm
                            việc.</p>
                        <p class="mb-0">✈️ <strong>Hỗ trợ gửi sim về Việt Nam:</strong> Cho khách hàng chuẩn bị sang Hàn
                            Quốc.</p>
                    </div>

                    <div class="text-center mt-4">
                        <a href="tel:01028288333" class="btn btn-primary btn-lg px-5">Liên hệ đăng ký ngay:
                            010.6565.2999</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
