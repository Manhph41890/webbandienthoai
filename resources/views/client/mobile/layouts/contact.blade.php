<div id="contact-widget" class="contact-fixed">
    <!-- Tooltip chung -->

    <!-- Danh sách các nút con (Sẽ ẩn/hiện) -->
    <div class="contact-list" id="contact-list">
            <div class="contact-tooltip">Liên hệ với chúng tôi!</div>
        <!-- Nút Messenger cho iPhone -->
        <a href="javascript:void(0)" class="contact-bubble messenger-color" onclick="openMessenger()">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/be/Facebook_Messenger_logo_2020.svg" alt="Messenger">
        </a>
        
        <!-- Nút Gọi Số 1 -->
        <a href="tel:01028288333" class="contact-bubble phone-color">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M6.62 10.79c1.44 2.83 3.76 5.15 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" fill="white"/></svg>
            <span class="phone-text">010 2828 8333</span>
        </a>

        <!-- Nút Gọi Số 2 -->
        <a href="tel:01082826886" class="contact-bubble phone-color">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M6.62 10.79c1.44 2.83 3.76 5.15 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" fill="white"/></svg>
            <span class="phone-text">010 8282 6886</span>
        </a>
    </div>

    <!-- Nút Tổng (Toggle Button) -->
    <div class="contact-bubble toggle-main" onclick="toggleContact()">
        <div class="icon-open">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 11.5C21 16.1944 16.9706 20 12 20C10.5181 20 9.12457 19.6582 7.90616 19.055L3 20L4.10312 15.6841C3.39174 14.4578 3 13.0235 3 11.5C3 6.80558 7.02944 3 12 3C16.9706 3 21 6.80558 21 11.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div class="icon-close" style="display: none;">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 6L6 18M6 6L18 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
    </div>
</div>

<style>
    .contact-fixed {
        position: fixed;
        bottom: 80px;
        right: 20px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 12px;
    }

    /* Danh sách nút con mặc định ẩn */
    .contact-list {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 12px;
        opacity: 0;
        transform: translateY(20px);
        pointer-events: none; /* Không cho bấm khi đang ẩn */
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    /* Khi mở ra */
    .contact-fixed.active .contact-list {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .contact-bubble {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        text-decoration: none;
        cursor: pointer;
    }

    /* Nút Toggle chính */
    .toggle-main {
        background: #0084FF; /* Màu xanh nổi bật */
        border: 2px solid #fff;
    }

    .contact-fixed.active .toggle-main {
        background: #ff4757; /* Chuyển màu đỏ khi muốn đóng */
        transform: rotate(90deg);
    }

    .contact-bubble:hover .phone-text {
        display: inline;
    }

    .phone-text {
        display: none;
        color: white;
        font-weight: bold;
        margin-left: 10px;
        white-space: nowrap;
    }

    /* Hiệu ứng Hover giãn rộng nút điện thoại */
    .phone-color:hover {
        width: auto;
        padding: 0 20px;
        border-radius: 30px;
    }

    .messenger-color { background: #fff; }
    .phone-color { background: #4CAF50; }
    .contact-bubble img, .contact-bubble svg { width: 30px; height: 30px; }

    .contact-tooltip {
        background: #333;
        color: #fff;
        padding: 5px 12px;
        border-radius: 5px;
        font-size: 13px;
        margin-bottom: 5px;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
        40% {transform: translateY(-5px);}
        60% {transform: translateY(-3px);}
    }

    @media (max-width: 600px) {
        .contact-bubble { width: 50px; height: 50px; }
    }
</style>

<script>
    // Hàm đóng mở widget
    function toggleContact() {
        const widget = document.getElementById('contact-widget');
        const iconOpen = document.querySelector('.icon-open');
        const iconClose = document.querySelector('.icon-close');
        const tooltip = document.getElementById('contact-tooltip');

        widget.classList.toggle('active');

        if (widget.classList.contains('active')) {
            iconOpen.style.display = 'none';
            iconClose.style.display = 'block';
            tooltip.style.display = 'none'; // Ẩn tooltip khi đã mở
        } else {
            iconOpen.style.display = 'block';
            iconClose.style.display = 'none';
            tooltip.style.display = 'block';
        }
    }

    // Hàm xử lý Messenger riêng cho iPhone
    function openMessenger() {
        // Luôn dùng Username để tránh lỗi "Guest Session" trên iOS
        const pageUsername = "hanofarmer"; 
        const messengerUrl = "https://m.me/" + pageUsername;
        
        // Trên iPhone dùng href là mượt nhất để mở thẳng App
        window.location.href = messengerUrl;
    }
</script>