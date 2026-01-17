// public/js/slider.js

$(document).ready(function () {
    $('.hero-slider').slick({
        autoplay: true,
        autoplaySpeed: 5000, // Tự động chuyển slide sau 5 giây
        dots: true, // Hiển thị các dấu chấm điều hướng
        infinite: true, // Vòng lặp vô hạn
        speed: 800, // Tốc độ chuyển động của slide
        slidesToShow: 1, // Chỉ hiển thị 1 slide
        adaptiveHeight: true, // Điều chỉnh chiều cao theo nội dung slide
        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        // Bạn có thể thêm các tùy chọn khác của Slick Carousel tại đây
    });
});

// public/js/slider.js

$(document).ready(function () {
    // Khởi tạo Slick Carousel
    $('.hero-slider').slick({
        autoplay: true,
        autoplaySpeed: 5000, // Tự động chuyển slide sau 5 giây
        dots: true, // Hiển thị các dấu chấm điều hướng
        infinite: true, // Vòng lặp vô hạn
        speed: 800, // Tốc độ chuyển động của slide
        slidesToShow: 1, // Chỉ hiển thị 1 slide
        adaptiveHeight: true, // Điều chỉnh chiều cao theo nội dung slide
        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
    });

    // === Logic cho Header ===

    // Toggle menu mobile
    $('#menuToggle').on('click', function () {
        $('#mainNav').toggleClass('active');
    });

    // Toggle user dropdown
    const userToggle = document.getElementById("userToggle");
    const userDropdown = document.getElementById("userDropdown");

    if (userToggle && userDropdown) {
        userToggle.addEventListener("click", function (e) {
            e.preventDefault();
            userDropdown.classList.toggle("active");
        });

        // Đóng dropdown khi click bên ngoài
        document.addEventListener("click", function (e) {
            if (!userToggle.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove("active");
            }
        });
    }

    // Logic cho submenu trên mobile
    // Sử dụng jQuery vì chúng ta đã include nó
    $('.main-nav ul li > a i.fa-caret-down').on('click', function (e) {
        // Kiểm tra chiều rộng cửa sổ, chỉ kích hoạt trên mobile (ví dụ < 769px)
        if (window.innerWidth <= 768) {
            e.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ 'a'
            const $submenu = $(this).closest('li').find('.submenu'); // Tìm submenu gần nhất
            if ($submenu.length) { // Nếu có submenu
                $submenu.slideToggle(300); // Hiệu ứng trượt lên/xuống
                $(this).closest('li').toggleClass('active'); // Thêm class 'active' cho li cha để xoay mũi tên
            }
        }
    });

    // Đóng submenu nếu không phải mobile và nó đang mở
    $(window).on('resize', function () {
        if (window.innerWidth > 768) {
            $('.main-nav ul li .submenu').css('display', ''); // Đảm bảo submenu hoạt động bình thường trên desktop
            $('.main-nav ul li').removeClass('active'); // Xóa class active trên desktop
        }
    });
});