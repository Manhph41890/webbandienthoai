<style>
    /* --- Tổng quan & Layout --- */
    :root {
        --primary-color: #007bff;
        /* Màu xanh chủ đạo chuyên nghiệp */
        --secondary-color: #6c757d;
        --accent-color: #ffc107;
        /* Màu vàng cho rating */
        --price-color: #d93025;
        /* Màu đỏ cho giá */
        --bg-light: #f8f9fa;
        --border-color: #e0e0e0;
        --text-main: #333;
        --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .spc-section-container {
        background: #fff;
        border: 1px solid var(--border-color);
        /* Viền bọc toàn bộ section */
        border-radius: 12px;
        padding: 30px 20px;
        /* Cách top và bottom bên trong */
        margin-top: 20px;
        margin-bottom: 40px;
        box-shadow: var(--shadow);
    }

    .spc-section-header {
        margin-bottom: 30px;
        text-align: left;
    }

    .spc-main-title {
        font-weight: 700;
        font-size: 1.8rem;
        color: var(--text-main);
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .spc-title-underline {
        width: 60px;
        height: 4px;
        background: var(--primary-color);
        border-radius: 2px;
    }

    /* --- Card Style --- */
    .spc-card-container {
        background: #fff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }

    .spc-card-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        border-color: var(--primary-color);
    }

    /* Header Card */
    .spc-card-head {
        padding: 20px 20px 10px;
    }

    .spc-product-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--primary-color);
        margin-bottom: 10px;
        min-height: 3rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .spc-meta-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .spc-rating-box {
        color: var(--accent-color);
        font-size: 0.85rem;
    }

    .spc-rating-text {
        color: #888;
        margin-left: 5px;
    }

    .spc-heart-btn {
        background: none;
        border: none;
        color: #ff4d4f;
        cursor: pointer;
        font-size: 1.1rem;
        transition: transform 0.2s;
    }

    .spc-heart-btn:hover {
        transform: scale(1.2);
    }

    /* Body Card */
    .spc-card-body {
        padding: 0 20px 20px;
        flex-grow: 1;
    }

    .spc-price-wrapper {
        margin-bottom: 15px;
        padding: 10px 0;
        border-bottom: 1px dashed var(--border-color);
    }

    .spc-price-num {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--price-color);
    }

    .spc-unit {
        font-size: 0.9rem;
        text-decoration: underline;
    }

    .spc-period {
        color: #666;
        font-size: 0.9rem;
    }

    /* Highlights */
    .spc-highlight-list {
        margin-bottom: 15px;
    }

    .spc-highlight-item {
        background: #e7f3ff;
        color: #0056b3;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        font-weight: 500;
    }

    .spc-highlight-item i {
        margin-right: 8px;
        font-size: 0.9rem;
    }

    /* Specs */
    .spc-spec-column {
        font-size: 0.88rem;
    }

    .spc-spec-entry {
        display: flex;
        justify-content: space-between;
        margin-bottom: 6px;
    }

    .spc-spec-key {
        color: #777;
    }

    .spc-spec-key i {
        width: 20px;
    }

    .spc-spec-val {
        font-weight: 600;
        color: #333;
    }

    .spc-brand-color {
        color: #e40001;
        /* Màu đỏ đặc trưng của nhà mạng nếu cần */
        font-weight: 800;
    }

    /* Footer Card & Buttons */
    .spc-card-foot {
        padding: 15px 20px 20px;
        display: flex;
        gap: 10px;
    }

    .spc-btn-buy {
        flex: 2;
        background: #0084ff;
        /* Messenger blue */
        color: white;
        text-align: center;
        padding: 10px;
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
        font-size: 0.85rem;
        transition: background 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .spc-btn-buy:hover {
        background: #0066cc;
        color: white;
        text-decoration: none;
    }

    .spc-btn-detail {
        flex: 1;
        border: 1px solid var(--border-color);
        color: var(--secondary-color);
        text-align: center;
        padding: 10px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        font-size: 0.85rem;
        transition: all 0.3s;
    }

    .spc-btn-detail:hover {
        background: var(--bg-light);
        color: var(--text-main);
        border-color: #999;
        text-decoration: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .spc-main-title {
            font-size: 1.5rem;
        }

        .spc-card-foot {
            flex-direction: column;
        }
    }
</style>
