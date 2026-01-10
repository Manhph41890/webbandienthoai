<style>
    .up-avatar-section {
        position: relative;
    }

    .up-avatar-wrapper {
        position: relative;
        width: 80px;
        height: 80px;
        margin: 0 auto 15px;
    }

    .up-avatar-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.2);
    }

    /* .up-avatar-section2 {
        position: relative;
    }

    .up-avatar-wrapper2 {
        position: relative;
        width: 40px;
        height: 40px;
        margin: 0 auto 15px;
    }

    .up-avatar-wrapper2 img {
        width: 70%;
        height: 70%;
        object-fit: cover;
        border-radius: 50%;
        border: 1px solid rgb(255 255 255 / 20%);
        margin-top: 13px;
    } */


    /* Reset & Base */
    .mobile-user-actions {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .mobile-action-btn {
        background: none;
        border: none;
        color: white;
        font-size: 22px;
        position: relative;
        padding: 5px;
        cursor: pointer;
    }

    .mobile-action-btn .badge {
        position: absolute;
        top: 0;
        right: -5px;
        background: #ff4d6d;
        color: white;
        font-size: 10px;
        padding: 2px 6px;
        border-radius: 10px;
        font-weight: bold;
    }

    /* Sidebar chính */
    .mobile-user-sidebar {
        position: fixed;
        top: 0;
        right: -300px;
        /* Ẩn đi */
        width: 280px;
        height: 100%;
        background: #1a222d;
        z-index: 10000;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: -5px 0 15px rgba(0, 0, 0, 0.3);
        display: flex;
        flex-direction: column;
    }

    .mobile-user-sidebar.active {
        right: 0;
    }

    /* Lớp phủ mờ */
    .mobile-menu-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: 0.3s;
    }

    .mobile-menu-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    /* Nội dung bên trong Sidebar */
    .sidebar-header {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-header h3 {
        margin: 0;
        color: white;
        font-size: 18px;
    }

    .close-sidebar {
        background: none;
        border: none;
        color: #999;
        font-size: 30px;
        line-height: 1;
    }

    /* Card User */
    .user-profile-card {
        padding: 20px;
        background: linear-gradient(135deg, #242f3e 0%, #1a222d 100%);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user-avatar i {
        font-size: 40px;
        color: #ff4d6d;
    }

    .user-details {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        color: white;
        font-weight: bold;
        font-size: 16px;
    }

    .user-role {
        font-size: 11px;
        color: #ffc107;
        text-transform: uppercase;
    }

    .user-email {
        font-size: 12px;
        color: #888;
    }

    /* Danh sách menu */
    .menu-list {
        padding: 10px 0;
    }

    .menu-link {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 20px;
        color: #ddd;
        text-decoration: none;
        transition: 0.2s;
        font-size: 15px;
    }

    .menu-link i {
        width: 20px;
        font-size: 18px;
    }

    .menu-link:active {
        background: rgba(255, 255, 255, 0.1);
    }

    .admin-link {
        color: #ffc107;
    }

    .logout-link {
        color: #ff5e5e;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    /* Guest Box */
    .guest-box {
        padding: 30px 20px;
        text-align: center;
    }

    .guest-box p {
        color: #999;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .login-btn-mobile {
        display: block;
        background: #ff4d6d;
        color: white;
        text-decoration: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .register-link-mobile {
        color: #ddd;
        font-size: 13px;
        text-decoration: underline;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const openBtn = document.getElementById('openUserMenu');
        const closeBtn = document.getElementById('closeUserMenu');
        const sidebar = document.getElementById('userSidebar');
        const overlay = document.getElementById('menuOverlay');

        function toggleMenu() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            // Ngăn scroll body khi mở menu
            document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
        }

        openBtn.addEventListener('click', toggleMenu);
        closeBtn.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);
    });
</script>
