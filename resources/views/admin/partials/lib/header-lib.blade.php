<style>
    :root {
        --adm-navy: #140000;
        --adm-accent: #ff4d6d;
        --adm-bg: #ffffff;
        --adm-text: #334155;
    }

    /* Navbar Container */
    .adm-hb-navbar {
        height: 70px;
        background: var(--adm-bg);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 25px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 0;
        z-index: 999;
    }

    /* Left Section */
    .adm-hb-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .adm-hb-toggle-btn {
        background: none;
        border: none;
        font-size: 20px;
        color: var(--adm-text);
        cursor: pointer;
        padding: 5px;
    }

    .adm-hb-welcome {
        font-size: 14px;
        color: #64748b;
    }

    .adm-hb-welcome span {
        font-weight: 700;
        color: var(--adm-navy);
    }

    /* Right Section */
    .adm-hb-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .adm-hb-icon-link {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #64748b;
        text-decoration: none;
        position: relative;
        transition: 0.3s;
    }

    .adm-hb-icon-link:hover {
        background: #f1f5f9;
        color: var(--adm-accent);
    }

    .adm-hb-badge {
        position: absolute;
        top: 5px;
        right: 5px;
        background: var(--adm-accent);
        color: white;
        font-size: 10px;
        padding: 2px 5px;
        border-radius: 10px;
        border: 2px solid white;
    }

    .adm-hb-divider {
        width: 1px;
        height: 30px;
        background: #e2e8f0;
        margin: 0 10px;
    }

    /* User Info */
    .adm-hb-user-trigger {
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 12px;
        transition: 0.3s;
    }

    .adm-hb-user-trigger:hover {
        background: #f8fafc;
    }

    .adm-hb-user-info {
        text-align: right;
    }

    .adm-hb-user-name {
        display: block;
        font-size: 14px;
        font-weight: 700;
        color: var(--adm-navy);
    }

    .adm-hb-user-role {
        display: block;
        font-size: 11px;
        color: #ffffff;
        text-transform: uppercase;
    }

    .adm-hb-user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        overflow: hidden;
        border: 2px solid #e2e8f0;
    }

    .adm-hb-user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Dropdown Menus */
    .adm-hb-dropdown {
        position: relative;
    }

    .adm-hb-dropdown-menu {
        position: absolute;
        top: calc(100% + 15px);
        background: white;
        min-width: 250px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: 0.3s;
    }

    .adm-hb-menu-right {
        right: 0;
    }

    .adm-hb-dropdown.active .adm-hb-dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    /* Dropdown Nội dung */
    .adm-hb-menu-header {
        padding: 15px 20px;
        font-weight: 700;
        border-bottom: 1px solid #f1f5f9;
    }

    .adm-hb-menu-item {
        display: flex;
        gap: 12px;
        padding: 15px 20px;
        text-decoration: none;
        border-bottom: 1px solid #f8fafc;
    }

    .adm-hb-item-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .adm-hb-item-icon.warning {
        background: #fff7ed;
        color: #f97316;
    }

    .adm-hb-item-text {
        margin: 0;
        font-size: 13px;
        color: #475569;
        line-height: 1.4;
    }

    .adm-hb-item-time {
        font-size: 11px;
        color: #ffffff;
    }

    .adm-hb-menu-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        color: #475569;
        text-decoration: none;
        font-size: 14px;
        transition: 0.2s;
    }

    .adm-hb-menu-link:hover {
        background: #f1f5f9;
        color: var(--adm-accent);
    }

    .adm-hb-menu-link.logout {
        color: #ef4444;
    }

    /* Logout Modal */
    .adm-hb-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: 0.3s;
    }

    .adm-hb-modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .adm-hb-modal {
        background: white;
        width: 90%;
        max-width: 400px;
        padding: 30px;
        border-radius: 20px;
        text-align: center;
        transform: scale(0.9);
        transition: 0.3s;
    }

    .adm-hb-modal-overlay.active .adm-hb-modal {
        transform: scale(1);
    }

    .adm-hb-modal-icon {
        width: 60px;
        height: 60px;
        background: #fee2e2;
        color: #ef4444;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto 20px;
    }

    .adm-hb-modal h3 {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .adm-hb-modal p {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .adm-hb-modal-actions {
        display: flex;
        gap: 10px;
    }

    .adm-hb-modal-actions button,
    .adm-hb-modal-actions form {
        flex: 1;
    }

    .adm-hb-btn-cancel {
        border: none;
        background: #f1f5f9;
        color: #475569;
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
    }

    .adm-hb-btn-confirm {
        border: none;
        background: #ef4444;
        color: white;
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Xử lý đóng mở Dropdowns
        const triggers = document.querySelectorAll('.adm-hb-trigger');

        triggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.stopPropagation();
                const parent = this.parentElement;

                // Đóng các dropdown khác
                document.querySelectorAll('.adm-hb-dropdown').forEach(d => {
                    if (d !== parent) d.classList.remove('active');
                });

                parent.classList.toggle('active');
            });
        });

        // Đóng dropdown khi click ngoài
        document.addEventListener('click', function() {
            document.querySelectorAll('.adm-hb-dropdown').forEach(d => d.classList.remove('active'));
        });

        // 2. Xử lý Modal Đăng xuất
        const logoutBtn = document.getElementById('admLogoutTrigger');
        const modal = document.getElementById('admLogoutModal');
        const cancelBtn = document.getElementById('admCancelLogout');

        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                modal.classList.add('active');
            });
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', function() {
                modal.classList.remove('active');
            });
        }

        // Đóng modal khi click ra ngoài vùng trắng
        modal.addEventListener('click', function(e) {
            if (e.target === modal) modal.classList.remove('active');
        });

        // 3. Kết nối với Sidebar cũ (Giữ nguyên logic của SB Admin)
        const sidebarToggle = document.getElementById('admSidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                document.body.classList.toggle('sidebar-toggled');
                const sidebar = document.querySelector('.sidebar');
                if (sidebar) sidebar.classList.toggle('toggled');
            });
        }
    });
</script>
