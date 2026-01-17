<style>
    .ms-mid-section {
        padding: 5px 10px;
        background-color: #fff;
    }

    .ms-mid-container {
        width: 100%;
        max-width: 600px;
        /* Giới hạn độ rộng cho mobile */
        margin: 0 auto;
    }

    .ms-mid-swiper {
        border-radius: 10px;
        /* Bo góc hiện đại */
        overflow: hidden;
        position: relative;
        /* Tạo đổ bóng nhẹ để banner nổi bật trên nền trắng */
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .ms-banner-link {
        display: block;
        width: 100%;
    }

    .ms-banner-img {
        width: 100%;
        height: auto;
        aspect-ratio: 615 / 104;
        /* Giữ đúng tỉ lệ ảnh gốc */
        display: block;
        object-fit: cover;
    }

    /* Tùy chỉnh thanh tiến trình thay vì dấu chấm */
    .ms-swiper-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: rgba(255, 255, 255, 0.3);
        z-index: 10;
    }

    .ms-progress-inner {
        height: 100%;
        width: 0%;
        background: #ff4d6d;
        /* Màu accent đồng bộ với các phần trước */
        transition: width 0.1s linear;
    }

    /* Hiệu ứng nhấp nháy nhẹ khi nhấn vào banner */
    .ms-banner-link:active {
        opacity: 0.9;
        transform: scale(0.99);
        transition: 0.2s;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const progressInner = document.querySelector('.ms-progress-inner');
        const autoplayDelay = 4000; // 4 giây đổi banner 1 lần

        const midSwiper = new Swiper('.ms-mid-swiper', {
            loop: true,
            autoplay: {
                delay: autoplayDelay,
                disableOnInteraction: false,
            },
            speed: 800,
            effect: 'slide',
            on: {
                // Khi slide bắt đầu chuyển
                slideChangeTransitionStart: function() {
                    progressInner.style.transition = 'none';
                    progressInner.style.width = '0%';
                },
                // Khi slide đã chuyển xong và bắt đầu đếm thời gian cho slide mới
                slideChangeTransitionEnd: function() {
                    progressInner.style.transition = `width ${autoplayDelay}ms linear`;
                    progressInner.style.width = '100%';
                },
                // Khởi tạo lần đầu
                init: function() {
                    setTimeout(() => {
                        progressInner.style.transition = `width ${autoplayDelay}ms linear`;
                        progressInner.style.width = '100%';
                    }, 100);
                }
            }
        });
    });
</script>
