<style>
    :root {
        --mf-navy: #1a222d;
        --mf-accent: #ff4d6d;
        --mf-text-dim: #94a3b8;
        --mf-white: #ffffff;
    }

    .mf-wrapper {
        background-color: var(--mf-navy);
        color: var(--mf-white);
        padding: 40px 0 0 0;
        font-family: 'Inter', sans-serif;
        position: relative;
        border-top: 4px solid var(--mf-accent);
    }

    .mf-container {
        padding: 0 20px;
    }

    /* Brand Section */
    .mf-logo {
        display: block;
        margin-bottom: 20px;
    }

    .mf-logo img {
        height: 45px;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }

    .mf-description {
        font-size: 13px;
        line-height: 1.6;
        color: var(--mf-text-dim);
        margin-bottom: 20px;
    }

    /* Social Buttons */
    .mf-socials {
        display: flex;
        gap: 12px;
        margin-bottom: 30px;
    }

    .mf-social-btn {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: 0.3s;
    }

    .mf-social-btn:active {
        background: var(--mf-accent);
        transform: scale(0.9);
    }

    /* Accordion Section */
    .mf-acc-item {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .mf-acc-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 0;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    .mf-acc-header i {
        font-size: 12px;
        transition: 0.3s;
        color: var(--mf-text-dim);
    }

    .mf-acc-item.active .mf-acc-header i {
        transform: rotate(180deg);
        color: var(--mf-accent);
    }

    .mf-acc-content {
        list-style: none;
        padding: 0;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease-out;
        margin: 0;
    }

    .mf-acc-item.active .mf-acc-content {
        max-height: 300px;
        padding-bottom: 15px;
    }

    .mf-acc-content li {
        margin-bottom: 12px;
    }

    .mf-acc-content a {
        color: var(--mf-text-dim);
        text-decoration: none;
        font-size: 13px;
    }

    /* Contact Card */
    .mf-contact-card {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 20px;
        padding: 20px;
        margin-top: 30px;
    }

    .mf-card-title {
        font-size: 15px;
        font-weight: 800;
        margin-bottom: 18px;
        color: var(--mf-accent);
    }

    .mf-contact-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 15px;
        color: var(--mf-text-dim);
        font-size: 13px;
        text-decoration: none;
    }

    .mf-contact-row i {
        color: var(--mf-accent);
        margin-top: 3px;
    }

    .mf-phone-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 15px;
    }

    .mf-phone-btn {
        background: var(--mf-white);
        color: var(--mf-navy);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 5px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 800;
        font-size: 12px;
    }

    /* Trust & Bottom */
    .mf-trust-section {
        padding: 30px 0;
        text-align: center;
    }

    .mf-payment-icons {
        display: flex;
        justify-content: center;
        gap: 20px;
        opacity: 0.6;
    }

    .mf-payment-icons img {
        height: 18px;
    }

    .mf-bottom {
        background: rgba(0, 0, 0, 0.2);
        padding: 20px;
        text-align: center;
        font-size: 11px;
        color: var(--mf-text-dim);
    }

    .mf-bottom span {
        color: var(--mf-white);
        font-weight: bold;
    }

    /* Back to Top */
    .mf-back-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
        background: var(--mf-accent);
        color: white;
        border: none;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        display: none;
        z-index: 99;
    }
</style>
<script>
    // 1. Xử lý đóng mở Accordion
    function toggleMfAccordion(element) {
        const parent = element.parentElement;

        // Đóng các accordion khác nếu muốn (Optional)
        // document.querySelectorAll('.mf-acc-item').forEach(item => {  
        //     if (item !== parent) item.classList.remove('active');
        // });

        parent.classList.toggle('active');
    }

    // 2. Xử lý nút Back to Top
    const bttBtn = document.getElementById("backToTop");

    window.onscroll = function() {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            bttBtn.style.display = "block";
        } else {
            bttBtn.style.display = "none";
        }
    };

    bttBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
