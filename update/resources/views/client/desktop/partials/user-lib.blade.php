<style>
    .header-user-actions {
        display: flex;
        align-items: center;
        /* Căn giữa theo chiều dọc cho tất cả */
        gap: 15px;
        /* Khoảng cách giữa Wishlist và User Dropdown */
    }

    /* Container chính */
    .up-avatar-section {
        display: flex;
        align-items: center;
    }

    .up-avatar-wrapper {
        position: relative;
        width: 35px;
        /* Kích thước thực tế bạn muốn hiển thị */
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .up-avatar-wrapper img {
        width: 100%;
        /* Chiếm hết container 35px */
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.2);
        /* Bỏ margin cũ vì nó gây lệch */
        margin: 0;
    }

    .user-trigger {
        display: flex;
        align-items: center;
        gap: 10px;
        /* Khoảng cách giữa avatar và tên */
        color: white;
        cursor: pointer;
    }

    .user-name {
        font-weight: 600;
        font-size: 14px;
        white-space: nowrap;
        /* Tránh tên bị xuống dòng */
    }

    /* Đảm bảo wishlist cũng nằm giữa (nếu wishlist chưa có flex) */
    .header-user-actions>a,
    .header-user-actions>div {
        display: flex;
        align-items: center;
    }

    .user-dropdown {
        position: relative;
        padding: 10px 0;
        /* Tạo không gian đệm xung quanh nút */
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
        top: 100%;
        /* Sát mép dưới nút */
        right: 0;
        width: 240px;
        padding-top: 15px;
        /* Kỹ thuật tạo 'cầu nối' tàng hình để chuột đi qua không bị mất menu */
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
        background: #1a222d;
        /* Màu navy đậm theo header */
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
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
        color: #ff4d6d;
        /* Màu hồng gradient */
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

    /* Container tổng của cụm icon góc phải */
    .th-user-nav {
        display: flex;
        align-items: center;
        gap: 25px;
        /* Khoảng cách giữa wishlist và login */
    }

    /* --- Style cho Nút Wishlist (Trái tim) --- */
    .th-wishlist-btn {
        position: relative;
        color: #ffffff;
        font-size: 22px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .th-wishlist-btn:hover {
        color: #ff4d6d;
        /* Màu hồng đỏ khi hover */
        transform: translateY(-2px);
    }

    /* Badge số lượng (Số 0 trong ảnh của bạn) */
    .th-wishlist-count {
        position: absolute;
        top: -5px;
        right: -10px;
        background-color: #ff4d6d;
        /* Màu đỏ nổi bật */
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 20px;
        border: 2px solid #1a222d;
        /* Viền trùng màu nền header để tạo độ tách khối */
        min-width: 18px;
        text-align: center;
    }

    /* --- Style cho Nút Đăng nhập (Guest Group) --- */
    .guest-group .action-item {
        display: flex;
        align-items: center;
        gap: 8px;
        /* Khoảng cách icon và chữ */
        color: #ffffff;
        text-decoration: none !important;
        /* Bỏ gạch chân mặc định */
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .guest-group .action-item i {
        font-size: 20px;
        color: #ffffff;
        transition: 0.3s;
    }

    /* Hiệu ứng khi di chuột vào Đăng nhập */
    .guest-group .action-item:hover {
        color: #ff4d6d;
        /* Chuyển chữ sang hồng đỏ */
    }

    .guest-group .action-item:hover i {
        color: #ff4d6d;
        /* Chuyển icon sang hồng đỏ */
        transform: rotate(15deg);
        /* Xoay nhẹ icon cho sinh động */
    }

    /* Animation nhẹ cho badge khi có thay đổi (Option) */
    @keyframes heartBeat {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
        }
    }

    .th-wishlist-btn:hover .th-wishlist-count {
        animation: heartBeat 0.5s infinite;
    }
</style>
