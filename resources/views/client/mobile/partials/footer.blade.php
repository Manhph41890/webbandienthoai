<footer class="mf-wrapper">
    <div class="mf-container">
        <!-- Brand Section -->
        <div class="mf-section mf-brand">
            <a href="/" class="mf-logo">
                <img src="{{ asset('logo/logo_remove.png') }}" alt="Toanhong Korea">
            </a>
            <p class="mf-description">
                <strong>TOANHONG KOREA</strong> - Hệ thống phân phối iPhone, Samsung và giải pháp Viễn thông hàng đầu
                cho cộng đồng người Việt tại Hàn Quốc.
            </p>
            <div class="mf-socials">
                <a href="https://www.facebook.com/anhtoan270189/" class="mf-social-btn fb"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.facebook.com/anhtoan270189/" class="mf-social-btn tt"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.facebook.com/anhtoan270189/" class="mf-social-btn yt"><i class="fab fa-youtube"></i></a>
                <a href="https://www.facebook.com/anhtoan270189/" class="mf-social-btn ig"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <!-- Links Sections (Accordion Style) -->
        <div class="mf-accordion">
            <div class="mf-acc-item">
                <div class="mf-acc-header" onclick="toggleMfAccordion(this)">
                    <span>DỊCH VỤ KHÁCH HÀNG</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                <ul class="mf-acc-content">
                    <li><a href="#">Đăng ký Sim trả sau</a></li>
                    <li><a href="#">Gia hạn gói cước data</a></li>
                    <li><a href="#">Nạp tiền thẻ quốc tế</a></li>
                    <li><a href="#">Hỗ trợ trả góp 0%</a></li>
                </ul>
            </div>

            <div class="mf-acc-item">
                <div class="mf-acc-header" onclick="toggleMfAccordion(this)">
                    <span>CHÍNH SÁCH CHUNG</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                <ul class="mf-acc-content">
                    <li><a href="#">Chính sách bảo hành vàng</a></li>
                    <li><a href="#">Quy định đổi trả máy cũ</a></li>
                    <li><a href="#">Chính sách bảo mật thông tin</a></li>
                    <li><a href="#">Vận chuyển hỏa tốc toàn Hàn</a></li>
                </ul>
            </div>
        </div>

        <!-- Contact Section (High-Touch Card) -->
        <div class="mf-section mf-contact-card">
            <h4 class="mf-card-title">KẾT NỐI VỚI CHÚNG TÔI</h4>

            <div class="mf-contact-row">
                <i class="fa-solid fa-location-dot"></i>
                <span>부산시 사하구 장림시장4길 19번호 1층</span>
            </div>

            <div class="mf-phone-grid">
                <a href="tel:01028288333" class="mf-phone-btn">
                    <i class="fa-solid fa-phone"></i>
                    <span>01065652999</span>
                </a>
                <a href="tel:01082826886" class="mf-phone-btn">
                    <i class="fa-solid fa-phone"></i>
                    <span>01025282999</span>
                </a>
            </div>

            <a href="mailto:hongtoan0509@gmail.com" class="mf-contact-row">
                <i class="fa-solid fa-envelope"></i>
                <span>hongtoan0509@gmail.com</span>
            </a>

            <div class="mf-contact-row">
                <i class="fa-solid fa-clock"></i>
                <span>Hỗ trợ khách hàng: 24/7 (T2-CN)</span>
            </div>
        </div>

        <!-- Payment & Trust -->
        <div class="mf-trust-section">
            <div class="mf-payment-icons">

                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa">

                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard">

                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal">

            </div>
        </div>
    </div>

    <div class="mf-bottom">
        <p>© 2025 <span>Toanhong Korea</span>. Thiết kế bởi ManhDev</p>
    </div>

    <!-- Nút quay lại đầu trang mượt mà -->
    <button id="backToTop" class="mf-back-to-top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>
    
</footer>
@include('client.mobile.partials.footer-lib')