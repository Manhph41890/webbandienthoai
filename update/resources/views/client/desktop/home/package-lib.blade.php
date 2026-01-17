@push('styles')
    <style>
        /* Container bao bọc bên ngoài */
        .spc-pagination-outer {
            overflow: hidden !important; 
            /* Ẩn các sản phẩm ở trang khác */
            width: 100%;
            cursor: grab;
            touch-action: pan-y;
        }

        .spc-pagination-outer:active {
            cursor: grabbing;
        }

        /* Track chứa các sản phẩm */
        .spc-list-wrapper {
            display: flex !important;
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
            will-change: transform !important;
            gap: 20px !important;
            /* Khoảng cách giữa các card */
        }

        /* Định dạng mỗi card chiếm đúng 1/4 độ rộng (trừ đi gap) */
        .spc-card-container {
            flex: 0 0 calc(25% - 15px) !important;
            /* 4 sản phẩm mỗi trang */
            box-sizing: border-box !important;
        }

        /* Điều chỉnh cho mobile (1 sản phẩm mỗi trang) */
        @media (max-width: 768px) {
            .spc-card-container {
                flex: 0 0 100%;
            }
        }

        /* Điều chỉnh cho máy tính bảng (2 sản phẩm mỗi trang) */
        @media (min-width: 769px) and (max-width: 1024px) {
            .spc-card-container {
                flex: 0 0 calc(50% - 10px) !important;
            }
        }

        /* Phân trang (Dots) */
        .spc-pagination-controls {
            display: flex !important;
            justify-content: center !important;
            gap: 10px !important;
            margin-top: 20px !important;
        }

        .spc-dot {
            width: 12px;
            height: 12px;
            background-color: #ccc;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            padding: 0;
        }

        .spc-dot.active {
            background-color: #ee0000;
            /* Màu thương hiệu của bạn */
            width: 30px;
            border-radius: 10px;
        }

        .spc-section-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        /* Style cho Tiêu đề "Gói cước Hot" */
        .spc-section-header {
            margin-bottom: 30px;
            text-align: left;
        }

        .spc-main-title {
            font-size: 28px;
            font-weight: 800;
            color: #2d3436;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .spc-title-underline {
            width: 60px;
            height: 4px;
            background: #4a6cf7;
            border-radius: 2px;
        }

        /* Grid Layout 3 cột */
        .spc-list-wrapper {
            --spc-primary: #4a6cf7;
            --spc-danger: #e74c3c;
            --spc-warning: #f1c40f;
            --spc-dark: #2d3436;
            --spc-gray: #636e72;
            --spc-bg-alt: #f8f9fa;

            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .spc-card-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 20px;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            border: 1px solid #eee;
        }

        .spc-card-container:hover {
            transform: translateY(-5px);
        }

        /* Header */
        .spc-card-head {
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 12px;
            margin-bottom: 15px;
        }

        .spc-product-title {
            font-size: 18px;
            color: var(--spc-dark);
            margin: 0 0 10px 0;
            font-weight: 700;
            line-height: 1.4;
            min-height: 50px;
        }

        .spc-meta-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .spc-rating-box {
            color: var(--spc-warning);
            font-size: 12px;
        }

        .spc-rating-text {
            color: var(--spc-gray);
            margin-left: 4px;
        }

        /* Nút trái tim */
        .spc-heart-btn {
            background: none;
            border: none;
            font-size: 18px;
            color: #ff4757;
            cursor: pointer;
            transition: transform 0.2s;
            padding: 0;
        }

        .spc-heart-btn:hover {
            transform: scale(1.2);
        }

        /* Body */
        .spc-card-body {
            display: flex;
            flex-direction: column;
            gap: 15px;
            flex-grow: 1;
        }

        .spc-price-wrapper {
            text-align: center;
            background: #fdf2f2;
            padding: 10px;
            border-radius: 10px;
        }

        .spc-price-num {
            font-size: 22px;
            font-weight: 800;
            color: var(--spc-danger);
        }

        .spc-period {
            color: var(--spc-gray);
            font-size: 13px;
        }

        .spc-highlight-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .spc-highlight-item {
            background: var(--spc-bg-alt);
            padding: 8px 12px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .spc-highlight-item i {
            color: var(--spc-primary);
            width: 15px;
        }

        .spc-spec-column {
            border-top: 1px dashed #eee;
            padding-top: 10px;
        }

        .spc-spec-entry {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .spc-spec-key {
            color: var(--spc-gray);
        }

        .spc-spec-val {
            font-weight: 600;
            color: var(--spc-dark);
        }

        .spc-brand-color {
            color: #e11d48;
        }

        /* Footer - 2 Nút Mua ngay & Chi tiết */
        .spc-card-foot {
            display: flex;
            gap: 8px;
            margin-top: 15px;
        }

        .spc-btn-buy {
            flex: 1.8;
            background-color: #4a6cf7;
            /* Màu xanh đen như ảnh */
            color: white !important;
            text-decoration: none;
            padding: 10px 5px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.3s;
            text-transform: uppercase;
        }

        .spc-btn-buy:hover {
            background-color: #2c3e50;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .spc-btn-detail {
            flex: 1;
            background-color: #f0f2f5;
            color: #2d3436 !important;
            text-decoration: none;
            padding: 10px 5px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            text-transform: uppercase;
        }

        .spc-btn-detail:hover {
            background-color: #e4e6e9;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .spc-list-wrapper {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 650px) {
            .spc-list-wrapper {
                grid-template-columns: 1fr;
            }

            .spc-main-title {
                font-size: 22px;
            }
        }
    </style>
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const track = document.getElementById('spc-list-track');
        const dotsContainer = document.getElementById('spc-pagination-dots');
        const outer = document.querySelector('.spc-pagination-outer');
        const items = track.querySelectorAll('.spc-card-container');

        let itemsPerPage = 4;
        if (window.innerWidth <= 768) itemsPerPage = 1;
        else if (window.innerWidth <= 1024) itemsPerPage = 2;

        const totalPages = Math.ceil(items.length / itemsPerPage);
        let currentPage = 0;

        // 1. Tạo các chấm phân trang
        function createDots() {
            dotsContainer.innerHTML = '';
            for (let i = 0; i < totalPages; i++) {
                const dot = document.createElement('button');
                dot.classList.add('spc-dot');
                if (i === 0) dot.classList.add('active');
                dot.addEventListener('click', () => goToPage(i));
                dotsContainer.appendChild(dot);
            }
        }

        // 2. Hàm chuyển trang
        function goToPage(pageIndex) {
            if (pageIndex < 0) pageIndex = 0;
            if (pageIndex >= totalPages) pageIndex = totalPages - 1;

            currentPage = pageIndex;
            const gap = 20; // Khớp với gap trong CSS
            const itemWidth = items[0].offsetWidth + gap;
            const moveDistance = pageIndex * itemWidth * itemsPerPage;

            track.style.transform = `translateX(-${moveDistance}px)`;

            // Cập nhật dots
            document.querySelectorAll('.spc-dot').forEach((dot, index) => {
                dot.classList.toggle('active', index === currentPage);
            });
        }

        // 3. Xử lý Kéo (Drag) và Vuốt (Swipe)
        let isDragging = false,
            startX, scrollLeft, currentTranslate = 0;

        outer.addEventListener('mousedown', startDrag);
        outer.addEventListener('touchstart', startDrag);

        function startDrag(e) {
            isDragging = true;
            startX = e.type === 'touchstart' ? e.touches[0].clientX : e.clientX;
            track.style.transition = 'none'; // Tắt transition khi đang kéo
        }

        window.addEventListener('mousemove', drag);
        window.addEventListener('touchmove', drag);

        function drag(e) {
            if (!isDragging) return;
            const x = e.type === 'touchmove' ? e.touches[0].clientX : e.clientX;
            const walk = x - startX;
            const gap = 20;
            const itemWidth = items[0].offsetWidth + gap;
            const currentOffset = -(currentPage * itemWidth * itemsPerPage);
            track.style.transform = `translateX(${currentOffset + walk}px)`;
        }

        window.addEventListener('mouseup', endDrag);
        window.addEventListener('touchend', endDrag);

        function endDrag(e) {
            if (!isDragging) return;
            isDragging = false;
            track.style.transition = 'transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94)';

            const endX = e.type === 'touchend' ? e.changedTouches[0].clientX : e.clientX;
            const distance = endX - startX;

            // Nếu kéo đủ xa (> 50px) thì chuyển trang
            if (distance < -50 && currentPage < totalPages - 1) {
                goToPage(currentPage + 1);
            } else if (distance > 50 && currentPage > 0) {
                goToPage(currentPage - 1);
            } else {
                goToPage(currentPage); // Quay lại trang cũ
            }
        }

        // Khởi tạo
        createDots();

        // Xử lý khi resize màn hình
        window.addEventListener('resize', () => {
            location.reload(); // Reload để tính toán lại số item trên mỗi trang
        });
    });
</script>
