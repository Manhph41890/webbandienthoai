<style>
    :root {
        --df-navy: #1a222d;
        --df-accent: #ff4d6d;
        --df-text: #94a3b8;
        --df-white: #ffffff;
        --df-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .df-wrapper {
        background-color: var(--df-navy);
        color: var(--df-white);
        padding: 70px 0 0 0;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        border-top: 5px solid var(--df-accent);
    }

    .df-container {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .df-grid {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr 0.8fr 1.2fr;
        gap: 40px;
        padding-bottom: 60px;
    }

    /* Cột Brand */
    .df-logo img {
        height: 55px;
        margin-bottom: 25px;
        transition: var(--df-transition);
    }

    .df-logo:hover img {
        transform: translateY(-3px);
    }

    .df-desc {
        font-size: 14px;
        line-height: 1.8;
        color: var(--df-text);
        margin-bottom: 25px;
        text-align: justify;
    }

    .df-socials {
        display: flex;
        gap: 12px;
    }

    .df-social-link {
        width: 38px;
        height: 38px;
        background: rgba(255, 255, 255, 0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: white;
        text-decoration: none;
        transition: var(--df-transition);
    }

    .df-social-link:hover {
        background: var(--df-accent);
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(255, 77, 109, 0.3);
    }

    /* Tiêu đề các cột */
    .df-title {
        font-size: 16px;
        font-weight: 800;
        margin-bottom: 30px;
        position: relative;
        padding-bottom: 12px;
    }

    .df-title::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 40px;
        height: 3px;
        background: var(--df-accent);
    }

    /* Link list */
    .df-links {
        list-style: none;
        padding: 0;
    }

    .df-links li {
        margin-bottom: 15px;
    }

    .df-links a {
        color: var(--df-text);
        text-decoration: none;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: var(--df-transition);
    }

    .df-links a i {
        font-size: 10px;
        opacity: 0;
        transition: var(--df-transition);
    }

    .df-links a:hover {
        color: var(--df-accent);
        transform: translateX(8px);
    }

    .df-links a:hover i {
        opacity: 1;
    }

    /* Contact */
    .df-contact-item {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .df-icon {
        font-size: 20px;
        color: var(--df-accent);
        margin-top: 3px;
    }

    .df-text strong {
        display: block;
        font-size: 14px;
        margin-bottom: 3px;
        color: white;
    }

    .df-text p {
        font-size: 14px;
        color: var(--df-text);
        margin: 0;
    }

    /* Payment */
    .df-payment {
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .df-payment p {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 15px;
        color: var(--df-text);
    }

    .df-payment-icons {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .df-payment-icons img {
        height: 20px;
        filter: grayscale(1) brightness(1.5);
        opacity: 0.6;
        transition: 0.3s;
    }

    .df-payment-icons img:hover {
        filter: none;
        opacity: 1;
    }

    /* Bottom Footer */
    .df-bottom {
        background: rgba(0, 0, 0, 0.25);
        padding: 25px 0;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .df-bottom-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        color: var(--df-text);
    }

    .df-copy span {
        color: white;
        font-weight: 700;
    }

    .df-author a {
        color: var(--df-accent);
        text-decoration: none;
        font-weight: 600;
    }
</style>
