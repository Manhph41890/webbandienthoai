<style>
    :root {
        --primary-color: #3f4b5b;
        /* Màu xám đậm như trong ảnh nhưng sang hơn */
        --accent-color: #2ecc71;
        --text-light: #888;
        --border-color: #eee;
        --bg-gray: #f9f9f9;
    }

    .contact-section {
        padding: 80px 20px;
        background: #fff;
        font-family: 'Inter', sans-serif;
    }

    .contact-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: start;
    }

    /* Form Side */
    .contact-title {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .contact-subtitle {
        color: var(--text-light);
        margin-bottom: 40px;
        font-size: 15px;
    }

    .input-group {
        margin-bottom: 25px;
        position: relative;
    }

    .input-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .main-contact-form input,
    .main-contact-form select,
    .main-contact-form textarea {
        width: 100%;
        padding: 12px 0;
        border: none;
        border-bottom: 1px solid var(--border-color);
        font-size: 15px;
        background: transparent;
        transition: all 0.3s ease;
        outline: none;
    }

    .main-contact-form input:focus,
    .main-contact-form select:focus,
    .main-contact-form textarea:focus {
        border-bottom-color: var(--primary-color);
    }

    .main-contact-form textarea {
        resize: none;
    }

    /* Submit Button */
    .form-footer {
        margin-top: 30px;
    }

    .btn-submit {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 15px 40px;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background: #2c3e50;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Map Side */
    .contact-map-side {
        height: 100%;
    }

    .map-wrapper {
        height: 400px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        background: var(--bg-gray);
    }

    .contact-info-mini {
        margin-top: 25px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #444;
        font-size: 14px;
    }

    .info-item i {
        color: var(--primary-color);
        width: 20px;
    }

    /* Responsive Mobile */
    @media (max-width: 992px) {
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .contact-map-side {
            order: -1;
            /* Đưa bản đồ lên trên ở mobile nếu muốn */
        }

        .input-row {
            grid-template-columns: 1fr;
        }

        .contact-section {
            padding: 40px 20px;
        }
    }
</style>
<style>
    .contact-container {
        font-family: Arial, sans-serif;
        padding: 20px;
    }

    .store-name {
        font-weight: bold;
        font-size: 24px;
        margin-bottom: 15px;
        color: #000;
    }

    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        font-size: 16px;
    }

    .info-item i {
        width: 25px;
        /* Giúp các icon có độ rộng bằng nhau để chữ thẳng hàng */
        margin-right: 10px;
        color: #333;
    }

    /* Màu riêng cho icon Facebook */
    .fa-facebook {
        color: #1877F2;
    }

    .info-item a {
        text-decoration: none;
        color: inherit;
    }

    .info-item a:hover {
        text-decoration: underline;
        color: #1877F2;
    }
</style>
