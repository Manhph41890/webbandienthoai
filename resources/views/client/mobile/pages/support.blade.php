@extends('client.mobile.layouts.app')
@section('content')
    <div class="container py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="bg-primary text-white py-4">
                        <i class="fa-solid fa-headset fa-3x mb-3"></i>
                        <h2 class="fw-bold">Hỗ Trợ Dịch Vụ</h2>
                        <p class="mb-0">Kiểm tra Data - Nạp Tiền - Hỗ trợ Trả trước</p>
                    </div>
                    <div class="card-body p-5">
                        <p class="lead">Để được hỗ trợ nhanh nhất các dịch vụ sau, quý khách vui lòng liên hệ trực tiếp với
                            đội ngũ kỹ thuật của <strong>Tươi Duyên Mobile</strong>:</p>

                        <div class="row g-3 my-4 text-start">
                            <div class="col-6"><i class="fa-solid fa-check text-success me-2"></i> Kiểm tra dung lượng Data
                            </div>
                            <div class="col-6"><i class="fa-solid fa-check text-success me-2"></i> Nạp tiền điện thoại
                            </div>
                            <div class="col-6"><i class="fa-solid fa-check text-success me-2"></i> Gia hạn gói cước trả
                                trước</div>
                            <div class="col-6"><i class="fa-solid fa-check text-success me-2"></i> Đổi số/Chuyển mạng</div>
                        </div>

                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            <a href="tel:01028288333" class="btn btn-danger btn-lg px-4 fw-bold">Hotline: 010-6565-2999</a>
                            <a class="btn btn-primary btn-lg px-4 fw-bold">Chat Messenger</a>
                        </div>

                        <div class="mt-4 p-3 bg-light rounded">
                            <small class="text-muted italic">Thời gian hỗ trợ: 09:00 - 22:00 (Hàng ngày kể cả thứ 7,
                                CN)</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
