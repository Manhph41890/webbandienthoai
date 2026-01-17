@push('styles')
    <style>
        /* Samsung Specific Section Style */
        .samsung-section {
            padding: 50px 0;
            background-color: #ffffff;
        }

        .ss-content-wrapper {
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            border-top: 5px solid #034EA2;
            /* Thanh màu đặc trưng Samsung */
        }

        /* Header & Tabs */
        .ss-title {
            font-weight: 800;
            color: #000;
            letter-spacing: -1px;
            margin-bottom: 5px;
        }

        .ss-subtitle {
            color: #666;
            font-size: 0.9rem;
        }

        .ss-category-tabs {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .ss-tab-item {
            text-decoration: none;
            color: #444;
            padding: 8px 18px;
            border-radius: 50px;
            background: #f1f1f1;
            font-size: 0.85rem;
            font-weight: 600;
            white-space: nowrap;
            transition: all 0.3s ease;
        }

        .ss-tab-item.active,
        .ss-tab-item:hover {
            background: #034EA2;
            color: #fff;
        }

        /* Card Style */
        .ss-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 15px;
            position: relative;
            transition: all 0.3s ease;
            height: 100%;
        }

        .ss-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(3, 78, 162, 0.15);
            border-color: #034EA2;
        }

        .ss-image-box {
            padding: 20px;
            text-align: center;
        }

        .ss-image-box img {
            max-width: 100%;
            height: auto;
            transition: transform 0.5s ease;
        }

        .ss-card:hover .ss-image-box img {
            transform: scale(1.05);
        }

        /* Badge & Wishlist */
        .ss-badge-new {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #034EA2;
            color: white;
            font-size: 0.7rem;
            padding: 2px 10px;
            border-radius: 4px;
            font-weight: bold;
            z-index: 2;
        }

        .ss-wishlist-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            border: none;
            background: none;
            color: #ccc;
            font-size: 1.2rem;
            z-index: 2;
            transition: color 0.3s;
        }

        .ss-wishlist-btn:hover {
            color: #ff4757;
        }

        /* Info */
        .ss-tag {
            font-size: 0.7rem;
            color: #034EA2;
            font-weight: bold;
            text-transform: uppercase;
        }

        .ss-name {
            font-size: 1rem;
            font-weight: 700;
            margin: 5px 0;
            color: #1a1a1a;
            height: 2.4em;
            overflow: hidden;
        }

        .ss-price {
            font-size: 1.2rem;
            font-weight: 800;
            color: #d63031;
        }

        .ss-currency {
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        .ss-rating {
            display: flex;
            align-items: center;
            gap: 5px;
            margin: 10px 0;
        }

        .ss-rating .stars {
            color: #f1c40f;
            font-size: 0.75rem;
        }

        .ss-rating .count {
            font-size: 0.75rem;
            color: #999;
        }

        /* Actions */
        .ss-actions {
            display: flex;
            gap: 8px;
            margin-top: 15px;
        }

        .ss-btn-buy {
            flex: 1;
            background: #000;
            color: #fff;
            text-decoration: none;
            text-align: center;
            padding: 8px 5px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            transition: background 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .ss-btn-buy:hover {
            background: #034EA2;
            color: #fff;
        }

        .ss-btn-view {
            width: 38px;
            height: 38px;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            color: #444;
            transition: all 0.3s;
        }

        .ss-btn-view:hover {
            background: #f8f9fa;
            color: #034EA2;
            border-color: #034EA2;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .ss-header {
                align-items: flex-start !important;
            }

            .ss-category-tabs {
                margin-top: 15px;
                width: 100%;
            }
        }
        /* Samsung Specific Style */
.ss-content-wrapper { background: #fff; padding: 30px; border-radius: 16px; }
.ss-title { font-weight: 900; color: #000; letter-spacing: -1px; margin-bottom: 0; }
.ss-subtitle { color: #666; font-size: 14px; }

.ss-card {
    border: 1px solid #eee; border-radius: 12px; padding: 20px; transition: 0.3s;
    background: #fff; height: 100%; position: relative;
}
.ss-card:hover { border-color: #000; transform: translateY(-5px); }
.ss-badge-new {
    position: absolute; top: 12px; left: 12px; background: #000; color: #fff;
    font-size: 10px; padding: 2px 8px; border-radius: 20px; z-index: 2;
}
.ss-wishlist-btn {
    position: absolute; top: 12px; right: 12px; border: none; background: none;
    color: #ccc; font-size: 18px; z-index: 2;
}
.ss-image-box { width: 100%; height: 180px; margin-bottom: 15px; }
.ss-image-box img { width: 100%; height: 100%; object-fit: contain; }
.ss-tag { font-size: 10px; color: #888; text-transform: uppercase; }
.ss-name { font-size: 16px; font-weight: 700; margin: 5px 0; color: #000; }
.ss-price { font-weight: 800; color: #000; font-size: 18px; }
.ss-rating { font-size: 12px; color: #ffc107; display: flex; align-items: center; gap: 5px; margin-bottom: 15px;}
.ss-rating .count { color: #aaa; }

/* Dùng chung cho cả 2 page */
.tab-wrapper-container { position: relative; max-width: 600px; }
.category-tabs {
    display: flex; gap: 10px; overflow-x: auto; scroll-behavior: smooth;
    padding: 5px; scrollbar-width: none;
}
.category-tabs::-webkit-scrollbar { display: none; }
.nav-tag-btn {
    border: none; background: #fff; width: 30px; height: 30px;
    border-radius: 50%; box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

    </style>
@endpush
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.product-pagination-section');

    sections.forEach(section => {
        // --- 1. Xử lý phân trang ---
        const itemsPerPage = 8;
        const productList = section.querySelector('.product-list');
        const items = Array.from(productList.querySelectorAll('.product-item'));
        const paginationUl = section.querySelector('.custom-pagination');
        let currentPage = 1;

        function showPage(page) {
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;

            items.forEach((item, index) => {
                item.style.display = (index >= start && index < end) ? 'block' : 'none';
            });
        }

        function createPagination() {
            const pageCount = Math.ceil(items.length / itemsPerPage);
            paginationUl.innerHTML = '';

            for (let i = 1; i <= pageCount; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === 1 ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="javascript:void(0)">${i}</a>`;
                
                li.addEventListener('click', (e) => {
                    e.preventDefault();
                    currentPage = i;
                    showPage(currentPage);
                    
                    section.querySelectorAll('.page-item').forEach(p => p.classList.remove('active'));
                    li.classList.add('active');
                });
                paginationUl.appendChild(li);
            }
        }

        if (items.length > 0) {
            showPage(1);
            createPagination();
        }

        // --- 2. Xử lý cuộn Tag và Click Tag ---
        const tabContainer = section.querySelector('.category-tabs');
        const btnLeft = section.querySelector('.nav-tag-btn.left');
        const btnRight = section.querySelector('.nav-tag-btn.right');
        const tabs = section.querySelectorAll('.tab-item');

        if (tabContainer) {
            // Click Tag
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Nút cuộn
            if (btnLeft && btnRight) {
                btnLeft.addEventListener('click', () => {
                    tabContainer.scrollBy({ left: -150, behavior: 'smooth' });
                });
                btnRight.addEventListener('click', () => {
                    tabContainer.scrollBy({ left: 150, behavior: 'smooth' });
                });
            }
        }
    });
});
</script>
