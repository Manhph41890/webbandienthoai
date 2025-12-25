document.addEventListener('DOMContentLoaded', function () {
    // Lấy tất cả các nút mũi tên
    header.addEventListener('click', () => {
        const parent = header.parentElement;

        document.querySelectorAll('.m-footer-accordion').forEach(item => {
            if (item !== parent) item.classList.remove('active');
        });

        // Toggle class active cho cái đang nhấn
        parent.classList.toggle('active');
    });
    const toggles = document.querySelectorAll('.arrow-toggle');

    toggles.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            // Tìm phần tử cha (li) chứa menu này
            const parentLi = this.closest('li');

            // Toggle class 'open' để hiển thị menu con (CSS sẽ xử lý hiển thị)
            parentLi.classList.toggle('open');

            // (Tùy chọn) Đóng các menu cùng cấp khác nếu muốn kiểu Accordion thuần túy
            /*
            const siblings = parentLi.parentElement.children;
            for (let sibling of siblings) {
                if (sibling !== parentLi) {
                    sibling.classList.remove('open');
                }
            }
            */
        });
    });
    const openBtn = document.getElementById('openMenu');
    const closeBtn = document.getElementById('closeMenu');
    const drawer = document.getElementById('sideDrawer');
    const overlay = document.getElementById('menuOverlay');

    function toggleMenu() {
        drawer.classList.toggle('active');
        overlay.classList.toggle('active');
        // Ngăn scroll body khi mở menu
        document.body.style.overflow = drawer.classList.contains('active') ? 'hidden' : '';
    }

    openBtn.addEventListener('click', toggleMenu);
    closeBtn.addEventListener('click', toggleMenu);
    overlay.addEventListener('click', toggleMenu);


});