<style>
    :root {
        --sb-bg: #1a222d;
        /* Màu navy đậm sang trọng */
        --sb-active: #ff4d6d;
        /* Màu accent hồng đỏ như mobile bạn đang dùng */
        --sb-text: #a0aec0;
        --sb-hover-bg: rgba(255, 255, 255, 0.05);
    }

    .adm-sb-container {
        background: var(--sb-bg) !important;
        min-height: 100vh;
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.2);
        padding: 0 12px;
    }

    /* Brand */
    .adm-sb-brand {
        padding: 2rem 0;
        text-decoration: none !important;
    }

    .adm-sb-logo-box img {
        max-width: 140px;
        transition: 0.3s;
    }

    /* Heading */
    .adm-sb-heading {
        color: #4a5568;
        text-transform: uppercase;
        font-size: 0.65rem;
        font-weight: 800;
        letter-spacing: 1px;
        margin: 1.5rem 0 0.5rem 1rem;
    }

    /* Nav Items */
    .adm-sb-item {
        list-style: none;
        margin-bottom: 4px;
    }

    .adm-sb-link {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: var(--sb-text) !important;
        text-decoration: none !important;
        border-radius: 10px;
        transition: all 0.3s;
        position: relative;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .adm-sb-link i:first-child {
        margin-right: 12px;
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
    }

    /* Icon mũi tên */
    .arrow-icon {
        margin-left: auto;
        font-size: 0.7rem !important;
        transition: 0.3s;
    }

    .adm-sb-link:not(.collapsed) .arrow-icon {
        transform: rotate(90deg);
    }

    /* Trạng thái Hover & Active */
    .adm-sb-link:hover {
        background: var(--sb-hover-bg);
        color: #fff !important;
    }

    .adm-sb-item.active .adm-sb-link {
        background: linear-gradient(90deg, var(--sb-active), #ff758c);
        color: #fff !important;
        box-shadow: 0 4px 15px rgba(255, 77, 109, 0.3);
    }

    /* Menu con (Inner) */
    .adm-sb-inner {
        background: rgba(0, 0, 0, 0.2) !important;
        margin: 5px 0 10px 15px;
        padding: 5px 0;
        border-radius: 8px;
        border-left: 1px solid rgba(255, 255, 255, 0.1);
    }

    .adm-sb-inner-item {
        display: block;
        padding: 8px 20px;
        color: var(--sb-text) !important;
        font-size: 0.85rem;
        text-decoration: none !important;
        transition: 0.2s;
    }

    .adm-sb-inner-item:hover,
    .adm-sb-inner-item.active {
        color: var(--sb-active) !important;
        padding-left: 25px;
    }

    /* Badge thông báo */
    .adm-sb-badge {
        background: #e53e3e;
        color: white;
        font-size: 0.7rem;
        padding: 2px 6px;
        border-radius: 6px;
        margin-left: 8px;
    }

    /* Toggler */
    .adm-sb-toggler {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        border: none;
        color: var(--sb-text);
    }

    .adm-sb-toggler:hover {
        background: var(--sb-active);
        color: #fff;
    }

    .adm-sb-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.05);
        margin: 1rem 0;
    }
</style>

