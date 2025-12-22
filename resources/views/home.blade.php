<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toanhong Korea - Trang chủ</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="{{ asset('cliend/css/style.css') }}">
    <!-- Font Awesome cho icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header Area -->
    <header>
        <div class="top-bar">
            <div class="logo">TOANHONG<span>KOREA</span></div>
            <div class="search-box">
                <input type="text" placeholder="Tìm kiếm...">
                <button><i class="fa fa-search"></i></button>
            </div>
            <div class="user-actions">
                <span><i class="fa fa-user"></i> Tài khoản</span>
                <span><i class="fa fa-heart"></i> Yêu thích</span>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="#">Trang Chủ</a></li>
                <li><a href="#">iPhone <i class="fa fa-chevron-down"></i></a></li>
                <li><a href="#">SAMSUNG <i class="fa fa-chevron-down"></i></a></li>
                <li><a href="#">Dịch vụ Sim <i class="fa fa-chevron-down"></i></a></li>
                <li><a href="#">Liên Hệ</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Hero Banner -->
        <section class="hero-banners">
            <div class="banner-main"><img src="https://via.placeholder.com/800x400" alt="iPhone 16 Pro Max"></div>
            <div class="banner-side"><img src="https://via.placeholder.com/300x400" alt="iPhone 17 Pro"></div>
        </section>

        <!-- Flash Sale -->
        <section class="flash-sale grid-3">
            <div class="sale-item hot-badge">
                <img src="https://via.placeholder.com/150" alt="S24 Ultra">
                <p>Galaxy S24 Ultra</p>
                <span class="price">930.000 won</span>
            </div>
            <div class="sale-item hot-badge">
                <img src="https://via.placeholder.com/150" alt="S24 Ultra">
                <p>Galaxy S24 Ultra</p>
                <span class="price">930.000 won</span>
            </div>
            <div class="sale-item hot-badge">
                <img src="https://via.placeholder.com/150" alt="S24 Ultra">
                <p>Galaxy S24 Ultra</p>
                <span class="price">930.000 won</span>
            </div>
        </section>

        <!-- Main Categories -->
        <section class="section-title">
            <h2>DANH MỤC CHÍNH</h2>
            <div class="categories grid-3">
                <div class="cat-card"><i class="fa fa-mobile-alt"></i><p>iPhone</p></div>
                <div class="cat-card"><i class="fa fa-mobile"></i><p>Samsung</p></div>
                <div class="cat-card"><i class="fa fa-sim-card"></i><p>SIM</p></div>
            </div>
        </section>

        <!-- Product Grid (Nổi bật) -->
        <section class="product-section">
            <div class="flex-between">
                <h2>Sản Phẩm Nổi Bật</h2>
                <div class="pagination">1 2 ></div>
            </div>
            <div class="product-grid">
                <!-- Lặp lại 5 lần cho 1 hàng -->
                <div class="product-card">
                    <img src="https://via.placeholder.com/150" alt="iPhone 13">
                    <h3>iPhone 13 Pro</h3>
                    <p class="price">750.000 won</p>
                    <div class="btn-group">
                        <button class="btn-buy">MUA NGAY</button>
                        <button class="btn-detail">CHI TIẾT</button>
                    </div>
                    <div class="stars">★★★★★</div>
                </div>
                <!-- Copy card này ra thêm 4 cái nữa -->
            </div>
        </section>

        <!-- Sim Plans -->
        <section class="sim-plans">
            <h2>Gói Cước Hot</h2>
            <div class="plans-grid">
                <div class="plan-card vina">
                    <div class="plan-header">Vinaphone VD90</div>
                    <div class="plan-body">
                        <p>30GB DATA/tháng</p>
                        <p>Miễn phí nội mạng</p>
                        <p>Giá từ: 270.000đ</p>
                    </div>
                    <button class="btn-select">Chọn gói</button>
                </div>
                <!-- Thêm các gói Viettel tương tự -->
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content grid-4">
            <div>
                <h3>TOANHONG KOREA</h3>
                <p>Hotline: 010-6565-2xx</p>
            </div>
            <div>
                <h3>Liên hệ</h3>
                <p>Địa chỉ: Hàn Quốc...</p>
            </div>
            <div>
                <h3>Hỗ trợ</h3>
                <ul>
                    <li>Chính sách đổi trả</li>
                    <li>Vận chuyển quốc tế</li>
                </ul>
            </div>
            <div>
                <h3>Thanh toán</h3>
                <img src="https://via.placeholder.com/200x100?text=Payment+Methods" alt="Payment">
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>