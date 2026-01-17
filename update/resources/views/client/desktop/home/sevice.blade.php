<section class="trust-features">
    <div class="container">
        <div class="row g-3">
            <!-- Tính năng 1 -->
            <div class="col-6 col-md-3">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>
                    <div class="feature-text">Sản phẩm an toàn</div>
                </div>
            </div>

            <!-- Tính năng 2 -->
            <div class="col-6 col-md-3">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fa-solid fa-handshake-angle"></i>
                    </div>
                    <div class="feature-text">Chất lượng cam kết</div>
                </div>
            </div>

            <!-- Tính năng 3 -->
            <div class="col-6 col-md-3">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <div class="feature-text">Dịch vụ vượt trội</div>
                </div>
            </div>

            <!-- Tính năng 4 -->
            <div class="col-6 col-md-3">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <div class="feature-text">Giao hàng nhanh</div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    :root {
        --brand-green: #1E293C; /* Màu xanh lá đặc trưng trong ảnh */
        --text-color: #333;
        --bg-gray: #f2f2f2; /* Màu nền xám nhạt như ảnh */
    }

    .trust-features {
        padding: 30px 0;
        background-color: var(--bg-gray);
    }

    .feature-box {
        background: #ffffff;
        padding: 20px 15px;
        border-radius: 12px; /* Bo góc như ảnh */
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        height: 100%;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    /* Hiệu ứng khi di chuột vào (tùy chọn để thêm phần chuyên nghiệp) */
    .feature-box:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transform: translateY(-2px);
    }

    .feature-icon {
        color: var(--brand-green);
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .feature-text {
        color: var(--text-color);
        font-weight: 500;
        font-size: 15px;
        white-space: nowrap; /* Giữ text trên 1 hàng nếu đủ chỗ */
    }

    /* Tối ưu cho màn hình nhỏ (Mobile) */
    @media (max-width: 768px) {
        .feature-box {
            padding: 15px 10px;
            gap: 8px;
        }
        .feature-text {
            font-size: 13px;
            white-space: normal; /* Cho phép xuống dòng trên mobile nếu quá dài */
            text-align: left;
        }
        .feature-icon {
            font-size: 20px;
        }
    }
</style>
@endpush