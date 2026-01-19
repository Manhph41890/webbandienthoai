@extends('client.desktop.layouts.app')
@section('content')
    <div class="container py-5">
        <h2 class="text-center fw-bold mb-5">Câu Hỏi Thường Gặp (FAQs)</h2>
        <div class="accordion shadow-sm" id="faqAccordion">
            <!-- Câu 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        Tôi là du khách mới sang có đăng ký được sim không?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Hoàn toàn được! Bạn chỉ cần có Hộ chiếu hợp lệ là có thể đăng ký sim trả trước để sử dụng ngay.
                    </div>
                </div>
            </div>
            <!-- Câu 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq2">
                        Cửa hàng có ship máy về Việt Nam không?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Có! Tươi Duyên Mobile hỗ trợ gửi điện thoại và phụ kiện về tận tay khách hàng tại Việt Nam qua đường
                        bay uy tín.
                    </div>
                </div>
            </div>
            <!-- Câu 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq3">
                        Mua máy cũ có được trả góp không?
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Chúng tôi có chính sách hỗ trợ trả góp qua thẻ tín dụng ngân hàng Hàn Quốc. Vui lòng liên hệ hotline
                        để được check hồ sơ.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
