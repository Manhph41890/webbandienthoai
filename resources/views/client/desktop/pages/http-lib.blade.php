<style>
    :root {
        --err-navy: #140000;
        --err-accent: #ff4d6d;
        --err-text: #64748b;
    }

    .err-wrapper {
        height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8fafc;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        padding: 20px;
        text-align: center;
    }

    .err-container {
        max-width: 500px;
        width: 100%;
    }

    /* Hiệu ứng số lỗi */
    .err-code {
        font-size: 120px;
        font-weight: 900;
        line-height: 1;
        margin-bottom: 20px;
        background: linear-gradient(135deg, var(--err-navy) 0%, var(--err-accent) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.1));
        animation: floating 3s ease-in-out infinite;
    }

    /* Animation bay bổng */
    @keyframes floating {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-15px);
        }
    }

    .err-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--err-navy);
        margin-bottom: 15px;
    }

    .err-desc {
        color: var(--err-text);
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    /* Nút bấm */
    .err-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .err-btn {
        padding: 12px 25px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 15px;
    }

    .err-btn-primary {
        background: var(--err-navy);
        color: white;
        box-shadow: 0 4px 12px rgba(26, 34, 45, 0.2);
    }

    .err-btn-primary:hover {
        background: var(--err-accent);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(255, 77, 109, 0.3);
    }

    .err-btn-outline {
        border: 2px solid #e2e8f0;
        color: var(--err-text);
        background: white;
    }

    .err-btn-outline:hover {
        background: #f1f5f9;
        color: var(--err-navy);
    }

    /* Responsive */
    @media (max-width: 576px) {
        .err-code {
            font-size: 80px;
        }

        .err-title {
            font-size: 20px;
        }

        .err-actions {
            flex-direction: column;
        }
    }
</style>
