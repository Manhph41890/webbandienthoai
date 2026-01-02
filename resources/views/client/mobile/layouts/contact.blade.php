<div id="contact-widget" class="contact-fixed">
    <!-- Tooltip chung -->
    <div class="contact-tooltip">Liên hệ với chúng tôi!</div>

        <!-- Nút Messenger -->
    <a href="javascript:void(0)" class="contact-bubble messenger-color" onclick="openMessenger()">
        <img src="https://upload.wikimedia.org/wikipedia/commons/b/be/Facebook_Messenger_logo_2020.svg" alt="Messenger">
    </a>
    
    <!-- Nút Gọi Số 1 -->
    <a href="tel:01028288333" class="contact-bubble phone-color" title="Gọi 010 2828 8333">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.62 10.79c1.44 2.83 3.76 5.15 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" fill="white"/>
        </svg>
        <span class="phone-text">010 2828 8333</span>
    </a>

    <!-- Nút Gọi Số 2 -->
    <a href="tel:01082826886" class="contact-bubble phone-color" title="Gọi 010 8282 6886">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.62 10.79c1.44 2.83 3.76 5.15 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" fill="white"/>
        </svg>
        <span class="phone-text">010 8282 6886</span>
    </a>

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
        gap: 12px; /* Khoảng cách giữa các nút */
    }

    .contact-bubble {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        text-decoration: none;
        position: relative;
    }

    /* Hiệu ứng khi di chuột vào (hiện số điện thoại) */
    .contact-bubble:hover {
        transform: scale(1.1);
        border-radius: 30px;
        width: auto;
        padding: 0 20px;
    }

    .phone-text {
        display: none;
        color: white;
        font-weight: bold;
        margin-left: 10px;
        white-space: nowrap;
    }

    .contact-bubble:hover .phone-text {
        display: inline;
    }

    .messenger-color {
        background: #fff;
    }

    .phone-color {
        background: #4CAF50; /* Màu xanh lá cho nút gọi */
    }

    .contact-bubble img, .contact-bubble svg {
        width: 35px;
        height: 35px;
    }

    .contact-tooltip {
        background: #333;
        color: #fff;
        padding: 5px 12px;
        border-radius: 5px;
        font-size: 13px;
        margin-bottom: 5px;
        position: relative;
        animation: bounce 2s infinite;
        pointer-events: none;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
        40% {transform: translateY(-5px);}
        60% {transform: translateY(-3px);}
    }

    /* Responsive cho điện thoại */
    @media (max-width: 600px) {
        .contact-bubble {
            width: 50px;
            height: 50px;
        }
        .contact-bubble img, .contact-bubble svg {
            width: 30px;
            height: 30px;
        }
    }
</style>

<script>
    function openMessenger() {
        // Thay đường dẫn link Messenger của bạn vào đây
        window.open('https://m.me/100095174172336', '_blank');
    }
</script>