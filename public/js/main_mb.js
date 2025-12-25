document.addEventListener('DOMContentLoaded', function() {
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