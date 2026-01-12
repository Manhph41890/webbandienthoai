<div id="contact-widget-desktop" class="contact-fixed-pc">
    <!-- Danh sách nút con -->
    <div class="contact-list-pc">
        <a href="javascript:void(0)" class="contact-bubble-pc messenger-color" onclick="openMessenger()">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/be/Facebook_Messenger_logo_2020.svg"
                alt="Messenger">
            <span class="label-text">Nhắn tin cho shop</span>
        </a>

        <a href="tel:01028288333" class="contact-bubble-pc phone-color">
            <svg viewBox="0 0 24 24" fill="white">
                <path
                    d="M6.62 10.79c1.44 2.83 3.76 5.15 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
            </svg>
            <span class="label-text">010 2828 8333</span>
        </a>

        <a href="tel:01082826886" class="contact-bubble-pc phone-color">
            <svg viewBox="0 0 24 24" fill="white">
                <path
                    d="M6.62 10.79c1.44 2.83 3.76 5.15 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
            </svg>
            <span class="label-text">010 8282 6886</span>
        </a>
    </div>

    <!-- Nút chính và Tooltip -->
    <div class="toggle-wrapper-pc">
        <div class="contact-tooltip-pc" id="tooltip-pc">Liên hệ với chúng tôi!</div>
        <div class="contact-bubble-pc toggle-main-pc" onclick="toggleContactPC()">
            <div class="icon-open-pc">
                <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path
                        d="M21 11.5C21 16.1944 16.9706 20 12 20C10.5181 20 9.12457 19.6582 7.90616 19.055L3 20L4.10312 15.6841C3.39174 14.4578 3 13.0235 3 11.5C3 6.80558 7.02944 3 12 3C16.9706 3 21 6.80558 21 11.5Z" />
                </svg>
            </div>
            <div class="icon-close-pc" style="display: none;">
                <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round"
                    stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </div>
        </div>
    </div>
</div>

<style>
    .contact-fixed-pc {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 99999;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 15px;
        pointer-events: none;
    }

    .contact-list-pc {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 12px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
        transition: all 0.3s ease;
    }

    .contact-fixed-pc.active .contact-list-pc {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
        pointer-events: auto;
    }

    /* Bubble chung */
    .contact-bubble-pc {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        /* Luôn giữa icon mặc định */
        background: #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        pointer-events: auto;
        overflow: hidden;
        position: relative;
    }

    /* Hiệu ứng giãn cho các nút liên hệ (trừ nút Toggle) */
    .contact-bubble-pc:not(.toggle-main-pc):hover {
        width: 200px;
        border-radius: 30px;
        justify-content: flex-start;
        padding-left: 15px;
    }

    .label-text {
        position: absolute;
        left: 55px;
        opacity: 0;
        white-space: nowrap;
        font-weight: 600;
        color: inherit;
        transition: opacity 0.2s;
    }

    .contact-bubble-pc:not(.toggle-main-pc):hover .label-text {
        opacity: 1;
    }

    /* Màu sắc */
    .phone-color {
        background: #4CAF50;
        color: #fff;
    }

    .messenger-color {
        background: #fff;
        color: #0084FF;
    }

    .contact-bubble-pc svg,
    .contact-bubble-pc img {
        width: 30px;
        height: 30px;
        flex-shrink: 0;
    }

    /* NÚT TOGGLE CHÍNH (Sửa lỗi mất icon) */
    .toggle-main-pc {
        background: #0084FF;
        /* Màu xanh lúc đóng */
        z-index: 2;
        border: 2px solid #fff;
    }

    /* Khi Mở: Đổi màu nút đỏ và icon dấu X */
    .contact-fixed-pc.active .toggle-main-pc {
        background: #FF4757 !important;
        transform: rotate(0deg);
        /* Không cần xoay cả nút, chỉ cần hiện X */
    }

    .icon-open-pc,
    .icon-close-pc {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    /* Tooltip */
    .contact-tooltip-pc {
        position: absolute;
        right: 70px;
        background: rgba(0, 0, 0, 0.8);
        color: #fff;
        padding: 8px 15px;
        border-radius: 8px;
        font-size: 13px;
        white-space: nowrap;
        pointer-events: none;
        transition: 0.3s;
        opacity: 1;
    }

    .contact-fixed-pc.active .contact-tooltip-pc {
        opacity: 0;
        visibility: hidden;
    }
</style>

<script>
    function openMessenger() {
        // Luôn dùng Username để tránh lỗi "Guest Session" trên iOS
        const pageUsername = "anhtoan270189";
        const messengerUrl = "https://m.me/" + pageUsername;

        // Trên iPhone dùng href là mượt nhất để mở thẳng App
        window.location.href = messengerUrl;
    }
    function toggleContactPC() {
        const widget = document.getElementById('contact-widget-desktop');
        const iconOpen = document.querySelector('.icon-open-pc');
        const iconClose = document.querySelector('.icon-close-pc');

        const isActive = widget.classList.toggle('active');

        if (isActive) {
            // Đang mở: Hiện X, ẩn Talk
            iconOpen.style.display = 'none';
            iconClose.style.display = 'flex'; // Dùng flex để icon căn giữa
        } else {
            // Đang đóng: Hiện Talk, ẩn X
            iconOpen.style.display = 'flex';
            iconClose.style.display = 'none';
        }
    }
</script>
