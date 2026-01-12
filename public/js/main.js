document.addEventListener('DOMContentLoaded', function () {

    // 1. Khởi tạo Swiper ngay khi trang load xong (Không đợi click)
    const heroSwiper = new Swiper('.x-hero-swiper-init', {
        loop: true,
        effect: 'slide',
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.x-hero-dots', // Khớp với class trong HTML
            clickable: true,
        },
        navigation: {
            nextEl: '.x-hero-next', // Khớp với class trong HTML
            prevEl: '.x-hero-prev', // Khớp với class trong HTML
        },
        speed: 800,
    });

    const midBannerSwiper = new Swiper('.mid-banner-swiper', {
        loop: true,
        autoplay: {
            delay: 3000, // 4 giây đổi ảnh một lần
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.mid-banner-next',
            prevEl: '.mid-banner-prev',
        },
        effect: 'slide',
        speed: 800,
    });
    const subSwipers = new Swiper('.banner-sub-swiper', {
        loop: true,
        autoplay: {
            delay: 4000, // 4 giây đổi ảnh một lần
            disableOnInteraction: false,
        },
        speed: 800,
        effect: 'slide',
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        // Nếu muốn ảnh hiện ra mượt mà hơn
        fadeEffect: {
            crossFade: true
        }
    });
    // 2. Swiper cho Sản phẩm nổi bật (MỚI)
    const productSwiper = new Swiper('.product-swiper', {
        slidesPerView: 2,      // Mặc định cho mobile
        spaceBetween: 10,      // Khoảng cách giữa các sp
        slidesPerGroup: 2,     // Mỗi lần bấm nhảy 2 cái
        loop: false,           // Tắt loop để tránh lỗi hiển thị khi ít sp
        navigation: {
            nextEl: '.slider-nav.next',
            prevEl: '.slider-nav.prev',
        },
        // Điểm dừng responsive
        breakpoints: {
            768: {             // Máy tính bảng
                slidesPerView: 3,
                spaceBetween: 12,
                slidesPerGroup: 3,
            },
            1024: {            // Desktop
                slidesPerView: 5,
                spaceBetween: 12,
                slidesPerGroup: 5,
            }
        },
        // Thêm hiệu ứng di chuyển mượt mà
        speed: 600,
    });

});