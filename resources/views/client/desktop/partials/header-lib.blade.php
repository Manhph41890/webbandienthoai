<style>
    :root {
        --th-navy: #1a222d;
        /* Màu nền Dark của Footer */
        --th-red: #ff4d6d;
        /* Màu gạch chân và tiêu đề đỏ của Footer */
        --th-text-white: #ffffff;
        --th-text-gray: #94a3b8;
        --th-font-main: 'Inter', sans-serif;
        /* Hoặc font bạn đang dùng cho footer */
    }

    .th-header {
        --th-navy: #1a222d;
        --th-red: #ff4d6d;
        /* Sử dụng font Inter giúp hiển thị tiếng Việt hoàn hảo */
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        background-color: var(--th-navy);
    }

    .th-container {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Header Top */
    .th-header-main {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 0;
        gap: 30px;
    }

    .th-logo img {
        height: 50px;
        /* Tăng kích thước logo cho cân đối */
        filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.1));
    }

    /* Search Box: Đổi sang tông Dark */
    .th-search-wrapper {
        flex: 1;
        max-width: 500px;
    }

    .th-search-form {
        position: relative;
        display: flex;
        align-items: center;
    }

    .th-search-form input {
        width: 100%;
        padding: 12px 25px;
        background: rgba(255, 255, 255, 0.08);
        /* Nền mờ tối */
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 30px;
        color: white;
        outline: none;
        transition: 0.3s;
    }

    .th-search-form input:focus {
        background: rgba(255, 255, 255, 0.12);
        border-color: var(--th-red);
    }

    .th-search-form button {
        position: absolute;
        right: 5px;
        background: var(--th-red);
        /* Nút search đỏ theo footer */
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
    }

    /* Navigation: Lấy style gạch chân đỏ của Footer */
    .th-navigation {
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .th-nav-list {
        list-style: none;
        display: flex;
        justify-content: center;
        gap: 35px;
        margin: 0;
        padding: 0;
    }

    .th-nav-item {
        position: relative;
    }

    .th-nav-link {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 18px 0;
        color: #ffffff;
        text-decoration: none;
        /* Chỉnh lại độ đậm 700 hoặc 800 để tiếng Việt thanh thoát hơn */
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 0.02em;
        /* Tạo độ thưa nhẹ cho chữ chuyên nghiệp hơn */
        text-transform: uppercase;
        transition: all 0.3s ease;
        -webkit-font-smoothing: antialiased;
        /* Giúp font chữ trên Mac/iPhone mượt hơn */
        -moz-osx-font-smoothing: grayscale;
    }

    .th-nav-link:hover,
    .th-nav-item.active .th-nav-link {
        color: var(--th-red);
    }

    /* Hiệu ứng gạch chân đỏ đồng bộ Footer */
    .th-nav-item {
        position: relative;
    }

    /* Hiệu ứng gạch chân đỏ lấy từ footer (input_file_0) */
    .th-nav-item::after {
        content: "";
        position: absolute;
        bottom: 8px;
        /* Đẩy vạch đỏ lên một chút cho tinh tế */
        left: 0;
        width: 0;
        height: 3px;
        background: var(--th-red);
        transition: width 0.3s ease;
        border-radius: 4px;
    }

    .th-nav-item:hover::after,
    .th-nav-item.active::after {
        width: 20px;
        /* Vạch đỏ ngắn giống tiêu đề Footer của bạn */
    }

    /* Chỉnh màu cho link active và hover */
    .th-nav-item:hover .th-nav-link,
    .th-nav-item.active .th-nav-link {
        color: var(--th-red);
    }

    /* Dropdown Menu tối */
    .th-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        background: var(--th-navy);
        min-width: 220px;
        padding: 10px 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        border-top: 3px solid var(--th-red);
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: 0.3s;
        z-index: 100;
    }

    /* --- Các class bổ trợ cho Smart Header --- */

    /* Trạng thái khi Header bắt đầu dính */
    .th-header.sticky {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 9999;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        animation: slideDown 0.4s ease forwards;
    }

    /* Trạng thái ẩn khi cuộn xuống (để chuẩn bị hiện lại khi cuộn lên) */
    .th-header.header-hidden {
        transform: translateY(-100%);
        transition: transform 0.4s ease;
    }

    /* HIỆU ỨNG RÚT GỌN (Compact Mode) */
    /* Khi ở trạng thái sticky, ta thu nhỏ các thành phần bên trong */
    .th-header.sticky .th-header-main {
        padding: 8px 0;
        /* Thu nhỏ chiều cao tầng 1 */
    }

    .th-header.sticky .th-logo img {
        height: 35px;
        /* Thu nhỏ logo */
    }

    .th-header.sticky .th-nav-link {
        padding: 12px 0;
        /* Thu hẹp menu */
        font-size: 13px;
        /* Chữ nhỏ lại 1 chút cho tinh tế */
    }

    /* Animation khi hiện ra */
    @keyframes slideDown {
        from {
            transform: translateY(-100%);
        }

        to {
            transform: translateY(0);
        }
    }


    /* Font Inter chuyên dụng cho tiếng Việt */
    .th-header {
        font-family: 'Inter', sans-serif;
        background-color: #1a222d;
    }

    .th-nav-item {
        position: relative;
        list-style: none;
    }

    .th-nav-link {
        color: #ffffff;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 14px;
        padding: 15px 0;
        display: block;
        text-decoration: none;
        transition: 0.3s;
    }

    /* Khi ACTIVE hoặc HOVER: Chữ đổi màu đỏ */
    .th-nav-item.active .th-nav-link,
    .th-nav-item:hover .th-nav-link {
        color: #ff4d6d !important;
    }

    /* Vạch đỏ dưới chân (Sửa lại để nó hiện khi Active) */
    .th-nav-item::after {
        content: "";
        position: absolute;
        bottom: 5px;
        left: 0;
        width: 0;
        height: 3px;
        background: #ff4d6d;
        transition: 0.3s ease;
        border-radius: 10px;
    }

    /* Hiển thị vạch đỏ khi LI đang có class active HOẶC khi hover */
    .th-nav-item.active::after,
    .th-nav-item:hover::after {
        width: 25px;
        /* Độ dài vạch đỏ ngắn chuẩn footer */
    }

    .th-has-dropdown:hover .th-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .th-drop-item a {
        padding: 12px 20px;
        color: var(--th-text-gray);
        display: flex;
        justify-content: space-between;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }

    .th-drop-item a:hover {
        background: rgba(255, 255, 255, 0.05);
        color: white;
    }

    /* Submenu */
    .th-submenu {
        position: absolute;
        left: 100%;
        top: 0;
        background: var(--th-navy);
        min-width: 200px;
        list-style: none;
        padding: 10px 0;
        border-left: 1px solid rgba(255, 255, 255, 0.1);
        opacity: 0;
        visibility: hidden;
        transform: translateX(10px);
        transition: 0.3s;
    }

    .th-has-sub:hover .th-submenu {
        opacity: 1;
        visibility: visible;
        transform: translateX(0);
    }

    /* Chỉnh icon mũi tên nhỏ lại và mượt hơn */
    .arrow-icon {
        font-size: 10px;
        margin-left: 2px;
        opacity: 0.7;
        transition: transform 0.3s ease;
    }

    .th-nav-item:hover .arrow-icon {
        transform: rotate(180deg);
        color: var(--th-red);
    }
</style>

<script>
    let lastScrollTop = 0;
    const header = document.querySelector(".th-header");
    const stickyThreshold = 300; // Khoảng cách cuộn xuống bao nhiêu thì bắt đầu kích hoạt sticky

    window.addEventListener("scroll", function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // 1. Nếu cuộn xuống quá ngưỡng threshold
        if (scrollTop > stickyThreshold) {
            header.classList.add("sticky");

            // Kiểm tra hướng cuộn
            if (scrollTop > lastScrollTop) {
                // Đang cuộn xuống -> Ẩn menu đi
                header.classList.add("header-hidden");
            } else {
                // Đang cuộn lên -> Hiện menu rút gọn
                header.classList.remove("header-hidden");
            }
        } else {
            // 2. Nếu quay về đầu trang -> Trở về trạng thái bình thường
            header.classList.remove("sticky", "header-hidden");
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Đảm bảo không bị số âm
    }, false);
</script>
