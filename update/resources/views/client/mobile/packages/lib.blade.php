<style>
    :root {
        --m-primary: #007bff;
        --m-price: #d93025;
        --m-text: #2d3436;
        --m-gray: #636e72;
        --m-bg: #f4f7f9;
        --m-card-bg: #ffffff;
    }

    .m-spc-container {
        padding: 20px 15px;
        background-color: var(--m-bg);
        min-height: 100vh;
    }

    /* Header */
    .m-spc-header {
        margin-bottom: 20px;
    }

    .m-spc-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--m-text);
        text-transform: uppercase;
        margin: 0;
    }

    .m-spc-divider {
        width: 50px;
        height: 4px;
        background: var(--m-primary);
        margin-top: 6px;
        border-radius: 2px;
    }

    /* Package List */
    .m-spc-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    /* Card Styling */
    .m-spc-card {
        background: var(--m-card-bg);
        border-radius: 16px;
        padding: 18px;
        position: relative;
        border: 1px solid #edf2f7;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .m-spc-heart {
        position: absolute;
        top: 15px;
        right: 15px;
        background: none;
        border: none;
        color: #ff7675;
        font-size: 1.2rem;
    }

    .m-spc-top-row {
        padding-right: 30px;
        margin-bottom: 8px;
    }

    .m-spc-package-name {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--m-primary);
        margin-bottom: 4px;
        line-height: 1.3;
    }

    .m-spc-rating {
        font-size: 0.8rem;
        color: #fdcb6e;
    }
    .m-spc-rating span { color: var(--m-gray); margin-left: 4px; }

    /* Pricing Section */
    .m-spc-price-box {
        display: flex;
        align-items: baseline;
        gap: 6px;
        margin-bottom: 15px;
    }

    .m-spc-price-val {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--m-price);
    }
    .m-spc-currency { font-size: 1rem; text-decoration: underline; margin-left: 2px; }
    .m-spc-duration { color: var(--m-gray); font-size: 0.9rem; }

    /* Tags/Badges */
    .m-spc-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 15px;
    }

    .m-spc-tag {
        background: #e1effe;
        color: #1e429f;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Meta Info */
    .m-spc-meta {
        background: #f8fafc;
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .m-spc-meta-item {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        margin-bottom: 6px;
    }
    .m-spc-meta-item:last-child { margin-bottom: 0; }
    
    .m-spc-meta-item .label { color: var(--m-gray); }
    .m-spc-meta-item .value { font-weight: 700; color: var(--m-text); }
    .m-spc-meta-item .value.brand { color: #d63031; }

    /* Actions */
    .m-spc-actions {
        display: flex;
        gap: 10px;
    }

    .m-btn-outline {
        flex: 1;
        border: 1.5px solid #d1d5db;
        padding: 12px;
        border-radius: 10px;
        text-align: center;
        text-decoration: none;
        color: var(--m-text);
        font-weight: 600;
        font-size: 0.9rem;
    }

    .m-btn-primary {
        flex: 2;
        background: var(--m-primary);
        color: #fff;
        padding: 12px;
        border-radius: 10px;
        text-align: center;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
    }
</style>