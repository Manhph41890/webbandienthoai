<style>
    :root {
        --wl-red: #ff4d6d;
        --wl-navy: #140000;
        --wl-bg: #f5f7fa;
        --wl-card: #ffffff;
    }

    .wl-mobile-wrapper {
        background-color: var(--wl-bg);
        min-height: 100vh;
        padding-bottom: 50px;
    }

    /* Header */
    .wl-header {
        background: var(--wl-navy);
        padding: 30px 20px;
        border-radius: 0 0 25px 25px;
    }

    .wl-header-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .wl-header-title h3 {
        color: white;
        margin: 0;
        font-size: 1.2rem;
        font-weight: 700;
    }

    .wl-count-badge {
        background: var(--wl-red);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    /* Empty State */
    .wl-empty-state {
        text-align: center;
        padding: 60px 30px;
    }

    .wl-empty-icon {
        font-size: 60px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .wl-empty-state h4 {
        font-weight: 700;
        color: #444;
    }

    .wl-empty-state p {
        color: #888;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .wl-btn-primary {
        display: inline-block;
        background: var(--wl-red);
        color: white;
        padding: 12px 30px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
    }

    /* Section Common */
    .wl-content {
        padding: 0 15px;
        margin-top: -15px;
    }

    .wl-section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
        margin-top: 25px;
    }

    .wl-section-header i {
        color: var(--wl-red);
    }

    /* Phone Grid (2 columns) */
    .wl-phone-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .wl-phone-card {
        background: white;
        border-radius: 15px;
        padding: 12px;
        position: relative;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .wl-remove-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        z-index: 5;
        background: #f0f0f0;
        border: none;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        font-size: 14px;
        color: #999;
    }

    .wl-card-img {
        width: 100%;
        aspect-ratio: 1/1;
        margin-bottom: 10px;
    }

    .wl-card-img img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .wl-item-name {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .wl-item-price {
        color: var(--wl-red);
        font-weight: 700;
        font-size: 15px;
        margin: 0;
    }

    .wl-item-price span {
        font-size: 11px;
        font-weight: 400;
    }

    .wl-card-footer {
        margin-top: 10px;
    }

    .wl-btn-detail {
        display: block;
        text-align: center;
        border: 1px solid #eee;
        padding: 6px;
        border-radius: 8px;
        font-size: 12px;
        text-decoration: none;
        color: #666;
    }

    /* Package List (Horizontal) */
    .wl-package-item {
        background: white;
        border-radius: 15px;
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 15px;
        position: relative;
        margin-bottom: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border-left: 4px solid var(--wl-red);
    }

    .wl-pkg-icon {
        width: 50px;
        height: 50px;
        background: #f0f7ff;
        color: #007bff;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 20px;
    }

    .wl-pkg-info {
        flex: 1;
    }

    .wl-pkg-name {
        font-size: 15px;
        font-weight: 700;
        margin: 0;
    }

    .wl-pkg-network {
        font-size: 12px;
        color: #888;
        margin: 2px 0;
    }

    .wl-pkg-price {
        font-size: 13px;
        color: var(--wl-red);
        font-weight: 700;
        margin: 0;
    }

    .wl-pkg-chat {
        width: 40px;
        height: 40px;
        background: #0084ff;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        text-decoration: none;
        font-size: 18px;
    }

    .wl-card-link {
        text-decoration: none;
    }
</style>
