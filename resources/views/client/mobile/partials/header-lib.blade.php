<style>
    :root {
        --mh-navy: #140000;
        --mh-accent: #ff4d6d;
        --mh-gray: #f4f6f8;
        --mh-text: #333;
        --mh-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Header Container */
    .mh-container {
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Search Bar */
    .mh-search-bar {
        background: #e9ecef;
        padding: 8px 15px;
    }

    .mh-search-inner {
        position: relative;
        display: flex;
        align-items: center;
    }

    .mh-search-inner input {
        width: 100%;
        padding: 10px 45px 10px 15px;
        border: none;
        border-radius: 25px;
        font-size: 14px;
        outline: none;
        background: white;
    }

    .mh-search-inner button {
        position: absolute;
        right: 5px;
        background: var(--mh-accent);
        color: white;
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        cursor: pointer;
    }

    /* Main Nav */
    .mh-main-nav {
        background: var(--mh-navy);
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 15px;
    }

    .mh-logo img {
        height: 35px;
        object-fit: contain;
        margin-left: 50px;
    }

    .mh-icon-btn {
        background: none;
        border: none;
        color: white;
        font-size: 22px;
        cursor: pointer;
    }

    /* Drawer (Cánh gà) */
    .mh-drawer {
        position: fixed;
        top: 0;
        left: -100%;
        /* Giấu sang trái */
        width: 85%;
        max-width: 320px;
        height: 100%;
        background: white;
        z-index: 10001;
        transition: var(--mh-transition);
        display: flex;
        flex-direction: column;
    }

    .mh-drawer.active {
        left: 0;
    }

    .mh-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(3px);
        z-index: 10000;
        opacity: 0;
        visibility: hidden;
        transition: var(--mh-transition);
    }

    .mh-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    /* Header Drawer */
    .mh-drawer-header {
        background: var(--mh-navy);
        color: white;
        padding: 20px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .mh-drawer-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .mh-close-btn {
        background: none;
        border: none;
        color: white;
        font-size: 28px;
        line-height: 1;
    }

    /* Body Drawer */
    .mh-drawer-body {
        flex: 1;
        overflow-y: auto;
        padding: 15px 0;
    }

    /* Quick Links Grid */
    .mh-quick-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        padding: 0 15px 20px;
    }

    .mh-q-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        color: var(--mh-text);
    }

    .mh-q-item i {
        width: 40px;
        height: 40px;
        background: var(--mh-gray);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        color: var(--mh-navy);
        font-size: 18px;
    }

    .mh-q-item span {
        font-size: 11px;
        font-weight: 500;
    }

    .mh-divider-text {
        background: var(--mh-gray);
        padding: 8px 15px;
        font-size: 12px;
        font-weight: bold;
        color: #888;
    }

    /* Accordion Menu */
    .mh-acc-item {
        border-bottom: 1px solid #eee;
    }

    .mh-acc-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 15px;
    }

    .mh-acc-link {
        text-decoration: none;
        color: var(--mh-text);
        font-weight: 600;
        flex: 1;
    }

    .mh-acc-trigger {
        padding: 5px 10px;
        transition: transform 0.3s;
    }

    /* Hiệu ứng xoay icon khi mở */
    .mh-acc-item.open>.mh-acc-header .mh-acc-trigger {
        transform: rotate(180deg);
        color: var(--mh-accent);
    }

    .mh-acc-content {
        background: #fafafa;
        display: none;
        padding-left: 15px;
    }

    /* Sub-level Accordion */
    .mh-sub-header {
        display: flex;
        justify-content: space-between;
        padding: 10px 15px;
        border-bottom: 1px dashed #eee;
    }

    .mh-sub-header a {
        text-decoration: none;
        color: #555;
        font-size: 14px;
    }

    .mh-sub-content {
        display: none;
        background: white;
        padding-left: 20px;
    }

    .mh-sub-content a {
        display: block;
        padding: 8px 15px;
        text-decoration: none;
        color: #777;
        font-size: 13px;
        border-bottom: 1px solid #f9f9f9;
    }

    .mh-drawer-footer {
        padding: 15px;
        text-align: center;
        font-size: 11px;
        color: #999;
        border-top: 1px solid #eee;
    }

    /* Mở menu khi class active được thêm vào */
    .mh-acc-item.open>.mh-acc-content,
    .mh-sub-acc.open>.mh-sub-content {
        display: block;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mhOpenBtn = document.getElementById('mhOpenDrawer');
        const mhCloseBtn = document.getElementById('mhCloseDrawer');
        const mhDrawer = document.getElementById('mhDrawer');
        const mhOverlay = document.getElementById('mhOverlay');

        // 1. Đóng mở Drawer chính
        function toggleDrawer() {
            mhDrawer.classList.toggle('active');
            mhOverlay.classList.toggle('active');
            document.body.style.overflow = mhDrawer.classList.contains('active') ? 'hidden' : '';
        }

        mhOpenBtn.addEventListener('click', toggleDrawer);
        mhCloseBtn.addEventListener('click', toggleDrawer);
        mhOverlay.addEventListener('click', toggleDrawer);

        // 2. Xử lý Accordion (Đa cấp)
        const accTriggers = document.querySelectorAll('.mh-acc-trigger');
        accTriggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                const parent = this.closest('.mh-acc-item');

                // Đóng các menu cấp 1 khác nếu muốn (Optional)
                // document.querySelectorAll('.mh-acc-item').forEach(item => {
                //     if(item !== parent) item.classList.remove('open');
                // });

                parent.classList.toggle('open');
            });
        });

        const subTriggers = document.querySelectorAll('.mh-sub-trigger');
        subTriggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                const parent = this.closest('.mh-sub-acc');
                parent.classList.toggle('open');

                // Thay đổi icon cộng/trừ
                const icon = this.querySelector('i');
                if (parent.classList.contains('open')) {
                    icon.className = 'fa-solid fa-minus';
                } else {
                    icon.className = 'fa-solid fa-plus';
                }
            });
        });
    });
</script>
