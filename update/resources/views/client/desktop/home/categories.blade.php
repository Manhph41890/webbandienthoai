<section class="main-category-section">
    <div class="container">


        <!-- Lưới danh mục -->
        <div class="category-grid">
                    <!-- Tiêu đề có gạch chân -->
        <div class="section-header">
            <h2 class="section-title">DANH MỤC CHÍNH</h2>
        </div>
            <!-- Item iPhone -->
            <a href="/iphone" class="category-item">
                <div class="category-icon">
                    <img src="{{ asset('images/categories/iphone.png') }}" alt="iPhone">
                </div>
                <span class="category-label">IPHONE</span>
            </a>

            <!-- Item Samsung -->
            <a href="/samsung" class="category-item">
                <div class="category-icon">
                    <img src="{{ asset('images/categories/samsung.png') }}" alt="Samsung">
                </div>
                <span class="category-label">SAMSUNG</span>
            </a>

            <!-- Item SIM -->
            <a href="/dich-vu-sim" class="category-item">
                <div class="category-icon">
                    <img src="{{ asset('images/categories/simm.png') }}" alt="SIM">
                </div>
                <span class="category-label">DỊCH VỤ SIM</span>
            </a>
        </div>
    </div>
</section>

@push('styles')
<style>
/* ==========================================category================================================== */

/* Container chung cho section */
.main-category-section {
    padding: 60px 0;
    background-color: #fff;
    text-align: center;
}

/* Tiêu đề DANH MỤC CHÍNH */
.section-header {
    margin-bottom: 50px;
}

.section-title {
    font-size: 28px;
    font-weight: 800;
    color: #000;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: inline-block;
    position: relative;
    padding-bottom: 10px;
    text-transform: uppercase;
}

/* Đường gạch chân đậm bên dưới chữ */
.section-title::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background-color: #000;
}

/* Grid chứa các ô */
.category-grid {
    display: flex;
    justify-content: center;
    gap: 60px; /* Khoảng cách giữa các ô */
    flex-wrap: wrap;
}

/* Từng ô danh mục */
.category-item {
    width: 130px;
    height: 160px;
    border: 1px solid #eeeeee; /* Viền xám rất nhạt */
    display: flex;
    border-radius: 5px;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    background-color: #fff;
    transition: all 0.3s ease;
}

/* Hiệu ứng khi di chuột qua ô */
.category-item:hover {
    border-color: #000;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transform: translateY(-5px);
}

/* Hình ảnh icon bên trong */
.category-icon {
    margin-bottom: 15px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.category-icon img {
    max-height: 100%;
    width: auto;
    object-fit: contain;
}

/* Chữ IPHONE, SAMSUNG, SIM */
.category-label {
    font-size: 13px;
    font-family: Arial, Helvetica, sans-serif;
    font-weight: 700;
    color: #000;
    letter-spacing: 0.5px;
}

</style>
@endpush