<style>
    /* Container chính */
.user-dropdown {
    position: relative;
    padding: 10px 0; /* Tạo không gian đệm xung quanh nút */
}

.user-trigger {
    display: flex;
    align-items: center;
    gap: 8px;
    color: white;
    cursor: pointer;
    font-weight: 500;
}

/* KHU VỰC QUAN TRỌNG: Container chứa menu */
.dropdown-menu-container {
    position: absolute;
    top: 100%; /* Sát mép dưới nút */
    right: 0;
    width: 240px;
    padding-top: 15px; /* Kỹ thuật tạo 'cầu nối' tàng hình để chuột đi qua không bị mất menu */
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 9999;
}

/* Khi hover vào cha, hiển thị con */
.user-dropdown:hover .dropdown-menu-container {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* Phần menu thực tế */
.dropdown-inner {
    background: #1a222d; /* Màu navy đậm theo header */
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 10px 25px rgba(0,0,0,0.5);
    overflow: hidden;
}

/* Header trong menu */
.user-info-header {
    padding: 15px;
    background: linear-gradient(135deg, #1a222d 0%, #2c3e50 100%);
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.role-badge {
    font-size: 11px;
    text-transform: uppercase;
    color: #ff4d6d; /* Màu hồng gradient */
    letter-spacing: 1px;
    margin: 0;
}

.user-email {
    font-size: 13px;
    color: #999;
    margin: 4px 0 0 0;
}

/* Item menu */
.menu-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 18px;
    color: #ddd;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.2s;
}

.menu-item i {
    width: 18px;
    font-size: 16px;
    opacity: 0.7;
}

.menu-item:hover {
    background: rgba(255, 255, 255, 0.05);
    color: white;
}

.menu-item:hover i {
    opacity: 1;
    color: #ff4d6d;
}

/* Nút Admin đặc biệt */
.admin-btn {
    color: #ffc107 !important;
}
.admin-btn:hover {
    background: rgba(255, 193, 7, 0.1) !important;
}

/* Nút Đăng xuất */
.logout-btn {
    color: #ff5e5e !important;
}
.logout-btn:hover {
    background: #ff5e5e !important;
    color: white !important;
}

.divider {
    height: 1px;
    background: rgba(255, 255, 255, 0.05);
    margin: 5px 0;
}

/* Hiệu ứng xoay icon mũi tên khi hover */
.user-dropdown:hover .chevron {
    transform: rotate(180deg);
}
.chevron {
    font-size: 10px;
    transition: 0.3s;
}
</style>