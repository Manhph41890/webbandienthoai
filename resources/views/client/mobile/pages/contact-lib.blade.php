<style>
    :root {
        --m-primary: #3f4b5b;
        --m-accent: #2ecc71;
        --m-text: #333;
        --m-gray: #f8f9fa;
        --m-border: #ddd;
    }

    .contact-mobile-section {
        background-color: #f4f7f6;
        padding: 20px 15px 50px 15px;
        font-family: 'Inter', -apple-system, sans-serif;
    }

    .mobile-container {
        max-width: 500px;
        /* Giới hạn độ rộng để đẹp trên cả tablet nhỏ */
        margin: 0 auto;
    }

    /* Header */
    .mobile-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .mobile-title {
        font-size: 26px;
        font-weight: 800;
        color: var(--m-primary);
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .mobile-subtitle {
        font-size: 14px;
        color: #666;
    }

    /* Card Style */
    .mobile-card {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    /* Form Elements */
    .m-input-group {
        margin-bottom: 18px;
    }

    .m-input-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #555;
        margin-bottom: 6px;
        margin-left: 2px;
    }

    .mobile-form input,
    .mobile-form select,
    .mobile-form textarea {
        width: 100%;
        padding: 14px 15px;
        border: 1px solid var(--m-border);
        border-radius: 10px;
        font-size: 15px;
        background: #fff;
        box-sizing: border-box;
        /* Quan trọng để không bị tràn màn hình */
        transition: border-color 0.3s;
    }

    .mobile-form input:focus,
    .mobile-form select:focus,
    .mobile-form textarea:focus {
        outline: none;
        border-color: var(--m-primary);
        background: #fff;
    }

    .m-error {
        color: #e74c3c;
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }

    /* Submit Button */
    .m-btn-submit {
        width: 100%;
        background: var(--m-primary);
        color: #fff;
        border: none;
        padding: 16px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 700;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
        box-shadow: 0 4px 12px rgba(63, 75, 91, 0.3);
    }

    .m-btn-submit:active {
        transform: scale(0.98);
    }

    /* Info Section */
    .m-info-list {
        margin-bottom: 20px;
    }

    .m-info-item {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        align-items: flex-start;
    }

    .m-icon {
        width: 35px;
        height: 35px;
        background: rgba(63, 75, 91, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--m-primary);
        flex-shrink: 0;
    }

    .m-text strong {
        display: block;
        font-size: 14px;
        color: var(--m-primary);
    }

    .m-text p {
        margin: 2px 0 0 0;
        font-size: 14px;
        color: #555;
        line-height: 1.4;
    }

    /* Map */
    .m-map-wrapper {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--m-border);
    }

    /* Điều chỉnh cho màn hình cực nhỏ */
    @media (max-width: 360px) {
        .mobile-title {
            font-size: 22px;
        }

        .m-btn-submit {
            font-size: 14px;
        }
    }
</style>
