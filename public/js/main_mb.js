document.addEventListener('DOMContentLoaded', function () {

    // 1. Khởi tạo Swiper ngay khi trang load xong (Không đợi click)
    // const heroSwiper = new Swiper('.x-hero-swiper-init', {
    //     loop: true,
    //     effect: 'slide',
    //     autoplay: {
    //         delay: 3000,
    //         disableOnInteraction: false,
    //     },
    //     pagination: {
    //         el: '.x-hero-dots', // Khớp với class trong HTML
    //         clickable: true,
    //     },
    //     navigation: {
    //         nextEl: '.x-hero-next', // Khớp với class trong HTML
    //         prevEl: '.x-hero-prev', // Khớp với class trong HTML
    //     },
    //     speed: 800,
    // });

    // const midBannerSwiper = new Swiper('.mid-banner-swiper', {
    //     loop: true,
    //     autoplay: {
    //         delay: 3000, // 4 giây đổi ảnh một lần
    //         disableOnInteraction: false,
    //     },
    //     navigation: {
    //         nextEl: '.mid-banner-next',
    //         prevEl: '.mid-banner-prev',
    //     },
    //     effect: 'slide',
    //     speed: 800,
    // });
    
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

    // 2. Xử lý sự kiện Click (Chỉ dành cho các logic đóng/mở menu)
    document.addEventListener('click', function (event) {
        const dropdown = document.querySelector('.user-dropdown-content');
        const trigger = document.querySelector('.dropdown-trigger');

        // Logic đóng menu khi click ra ngoài
        if (dropdown && trigger) {
            if (!trigger.contains(event.target) && !dropdown.contains(event.target)) {
                // Ví dụ: dropdown.classList.remove('active');
                // Hoặc ẩn dropdown tùy theo cách bạn code CSS
                dropdown.style.display = 'none';
            }
        }
    });

    // 3. Logic mở menu khi click vào trigger (Nếu bạn không dùng hover)
    const triggerBtn = document.querySelector('.dropdown-trigger');
    if (triggerBtn) {
        triggerBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const dropdown = document.querySelector('.user-dropdown-content');
            if (dropdown) {
                dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
            }
        });
    }

    let lastScrollY = window.scrollY;
    const header = document.querySelector(".main-header");

    window.addEventListener("scroll", () => {
        const currentScrollY = window.scrollY;

        // 1. Xử lý ẩn hiện khi cuộn lên/xuống
        if (currentScrollY > lastScrollY && currentScrollY > 150) {
            // Đang cuộn xuống và đã qua khỏi 150px -> Ẩn header
            header.classList.add("header-hidden");
        } else {
            // Đang cuộn lên -> Hiện header
            header.classList.remove("header-hidden");   
        }

        // 2. Thêm hiệu ứng thu nhỏ khi đã cuộn qua một đoạn
        if (currentScrollY > 50) {
            header.classList.add("header-scrolled");
        } else {
            header.classList.remove("header-scrolled");
        }

        // Cập nhật vị trí cuộn cuối cùng
        lastScrollY = currentScrollY;
    });
});