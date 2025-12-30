@push('styles')
    <style>
        /* Tabs */
        .category-tabs {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            /* Giảm padding để không bị trống quá nhiều */
            padding-bottom: 8px;
            margin-bottom: 0px;
            /* Cho phép cuộn mượt trên điện thoại */
            -webkit-overflow-scrolling: touch;
        }

        /* Tùy chỉnh thanh cuộn cho Chrome, Safari, Edge */
        .category-tabs::-webkit-scrollbar {
            height: 4px;
            /* Độ cao thanh cuộn cực mỏng */
        }

        .category-tabs::-webkit-scrollbar-track {
            background: #f1f1f1;
            /* Màu nền đường ray */
            border-radius: 10px;
        }

        .category-tabs::-webkit-scrollbar-thumb {
            background: #ccc;
            /* Màu của thanh kéo */
            border-radius: 10px;
        }

        .category-tabs::-webkit-scrollbar-thumb:hover {
            background: #999;
            /* Màu khi di chuột vào */
        }

        /* Ẩn thanh cuộn cho Firefox */
        .category-tabs {
            scrollbar-width: thin;
            scrollbar-color: #ccc #f1f1f1;
        }

        /* ... (Các giữ nguyên các biến :root và style cũ của bạn) ... */
        :root {
            --messenger-color: #0084ff !important;
            --primary-red: #e01020;
            --text-dark: #1a1a1a;
            --bg-light: #f8f9fa;
        }

        /* Tabs */
        .category-tabs {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 15px;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .tab-item {
            padding: 6px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            white-space: nowrap;
            color: #333;
            text-decoration: none;
            font-size: 14px;
        }

        .tab-item.active {
            background-color: #e31837;
            color: white;
            border-color: #e31837;
        }

        /* Lớp bọc ngoài cùng */
        .featured-products-section {
            padding: 80px 0;
            background-color: var(--bg-light);
        }

        /* Lớp bọc nội dung chính (Box trắng) */
        .products-content-wrapper {
            padding: 20px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .featured-products {
            padding: 60px 0;
            background-color: #fff;
        }

        /* Tiêu đề */
        .section-title-wrapper {
            position: relative;
        }

        .section-title {
            font-weight: 800;
            font-size: 26px;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .title-underline {
            width: 140px;
            height: 4px;
            background-color: #1E293C !important;
        }

        /* Card sản phẩm */
        .product-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 15px;
            position: relative;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            /* Đảm bảo hiệu ứng không tràn ra ngoài */
        }

        .product-card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
            border-color: transparent;
        }

        /* Badge 'New' */
        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ffffff !important;
            color: #ffffff;
            padding: 3px 10px;
            font-size: 11px;
            font-weight: bold;
            border-radius: 4px;
            z-index: 5;
            /* Tăng z-index để nằm trên lớp mờ */
        }

        /* Ảnh sản phẩm và Hiệu ứng làm mờ 2 góc */
        .product-image {
            width: 100%;
            padding-top: 100%;
            position: relative;
            margin-bottom: 15px;
            overflow: hidden;
            /* Quan trọng để che lớp mờ khi chưa hover */
            border-radius: 8px;
        }

        /* Lớp mờ 1: Góc trái trên */
        .product-image::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 1px #ffffffda solid;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.024);
            /* Màu nền rất nhẹ */
            backdrop-filter: blur(0.5px);
            /* Tạo độ mờ */
            -webkit-backdrop-filter: blur(0.5px);
            z-index: 2;
            transform: translate(-100%, -100%);
            /* Giấu ở góc trái trên */
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none !important; 
        }

        /* Lớp mờ 2: Góc phải dưới */
        .product-image::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 1px #ffffff solid;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(0.5px);
            -webkit-backdrop-filter: blur(0.5px);
            z-index: 2;
            transform: translate(100%, 100%);
            /* Giấu ở góc phải dưới */
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none !important;
        }

        /* Khi hover vào card: Cả hai lớp cùng xuất hiện */
        .product-card:hover .product-image::before,
        .product-card:hover .product-image::after {
            transform: translate(0, 0);
        }

        .product-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.8s ease;
            z-index: 1;
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
            /* Tăng nhẹ độ phóng đại khi mờ sẽ đẹp hơn */
        }

        /* Các phần còn lại giữ nguyên */
        .product-content {
            position: relative;
            z-index: 3;
        }

        .product-name {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: -10px !important;
            color: var(--text-dark);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 40px;
        }

        .product-price {
            color: var(--primary-red);
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .product-price .currency {
            font-size: 12px;
            text-transform: uppercase;
        }

        .product-rating {
            font-size: 11px;
            color: #ffc107;
            margin-bottom: 15px;
        }

        .rating-count {
            color: #888;
            margin-left: 5px;
        }

        .product-actions {
            display: flex;
            gap: 8px;
            margin-top: auto;
        }

        .btn-messenger {
            flex: 2;
            background: linear-gradient(180deg, #1E293C 30%, #e56583 100%) !important;
            color: #fff;
            text-decoration: none;
            font-size: 11px;
            font-weight: 700;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .btn-messenger:hover {
            background: var(--messenger-color !important);
            color: #fff;
        }

        .btn-detail {
            flex: 1;
            background: #f1f1f1;
            color: #555;
            text-decoration: none;
            font-size: 11px;
            font-weight: 700;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: 0.3s;
        }

        .btn-detail:hover {
            background: #ddd;
            color: #333;
        }

        .product-nav {
            align-items: center;
            gap: 15px;
        }

        .nav-btn {
            border: 1px solid #ddd;
            background: #fff;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            cursor: pointer;
            transition: 0.3s;
        }

        .nav-btn:hover {
            background: #000;
            color: #fff;
            border-color: #000;
        }

        @media (min-width: 992px) {
            .col-lg-2-4 {
                flex: 0 0 20%;
                max-width: 20%;
            }
        }

        /* Nút điều hướng Tag */
        .category-tabs-wrapper {
            position: relative;
            max-width: 750px;
            margin-left: 20px;
        }

        .nav-tag-btn {
            border: none;
            background: #fff;
            cursor: pointer;
            padding: 5px 10px;
            z-index: 10;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .nav-tag-btn:hover {
            background: #e31837;
            color: #fff;
        }

        /* Phân trang */
        .custom-pagination {
            gap: 5px;
        }

        .custom-pagination .page-item .page-link {
            border-radius: 5px;
            color: #1E293C;
            border: 1px solid #dee2e6;
            padding: 8px 16px;
        }

        .custom-pagination .page-item.active .page-link {
            background-color: #1E293C;
            border-color: #1E293C;
            color: #fff;
        }
    </style>
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- PHẦN 1: XỬ LÝ PHÂN TRANG (PAGINATION) ---
        const itemsPerPage = 8;
        const productContainer = document.getElementById('product-list');
        const products = Array.from(productContainer.getElementsByClassName('product-item'));
        const paginationContainer = document.getElementById('pagination');
        let currentPage = 1;

        function displayProducts(page) {
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;

            products.forEach((product, index) => {
                if (index >= start && index < end) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });

            // Cuộn lên đầu section khi chuyển trang (tùy chọn)
            // productContainer.scrollIntoView({ behavior: 'smooth' });
        }

        function setupPagination() {
            const pageCount = Math.ceil(products.length / itemsPerPage);
            paginationContainer.innerHTML = '';

            for (let i = 1; i <= pageCount; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="javascript:void(0)">${i}</a>`;

                li.addEventListener('click', function() {
                    currentPage = i;
                    displayProducts(currentPage);

                    // Update active class
                    document.querySelectorAll('.custom-pagination .page-item').forEach(el => {
                        el.classList.remove('active');
                    });
                    li.classList.add('active');
                });
                paginationContainer.appendChild(li);
            }
        }

        // Khởi tạo trang 1
        if (products.length > 0) {
            displayProducts(currentPage);
            setupPagination();
        }

        // --- PHẦN 2: XỬ LÝ THANH TAG (SCROLL & CLICK) ---
        const tagContainer = document.getElementById('category-tabs');
        const btnLeft = document.querySelector('.nav-tag-btn.left');
        const btnRight = document.querySelector('.nav-tag-btn.right');
        const tags = document.querySelectorAll('.tab-item');

        // Click chuyển Active
        tags.forEach(tag => {
            tag.addEventListener('click', function(e) {
                e.preventDefault();
                tags.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                // Ở đây bạn có thể thêm logic lọc sản phẩm theo tag nếu cần
                console.log("Đang lọc: " + this.innerText);
            });
        });

        // Nút kéo sang trái/phải
        btnRight.addEventListener('click', () => {
            tagContainer.scrollBy({
                left: 200,
                behavior: 'smooth'
            });
        });

        btnLeft.addEventListener('click', () => {
            tagContainer.scrollBy({
                left: -200,
                behavior: 'smooth'
            });
        });
    });
</script>
