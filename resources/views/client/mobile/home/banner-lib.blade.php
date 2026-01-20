<style>
    /* Reset & Variables cho Mobile */
    :root {
        --mb-accent: #ff4d6d;
        /* Màu hồng/đỏ chủ đạo */
        --mb-navy: #140000;
        --mb-radius: 12px;
    }

    .mb-hero-wrapper {
        background: #f8f9fa;
        padding-bottom: 20px;
    }

    /* Tùy chỉnh Slider */
    .mb-hero-slider {
        padding: 10px 10px 5px 10px;
        /* Tạo khoảng cách nhỏ với cạnh màn hình */
    }

    .mb-hero-swiper {
        border-radius: var(--mb-radius);
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .mb-hero-img {
        width: 100%;
        aspect-ratio: 16 / 9;
        /* Tỉ lệ chuẩn cho banner mobile */
        object-fit: cover;
        display: block;
    }

    /* Custom chấm tròn Pagination */
    .mb-hero-dots.swiper-pagination-bullets {
        bottom: 10px;
    }

    .mb-hero-dots .swiper-pagination-bullet {
        width: 8px;
        height: 8px;
        background: rgba(255, 255, 255, 0.6);
        opacity: 1;
        transition: all 0.3s;
    }

    .mb-hero-dots .swiper-pagination-bullet-active {
        background: var(--mb-accent) !important;
        width: 20px;
        /* Kéo dài chấm tròn đang active nhìn rất sang */
        border-radius: 4px;
    }

    /* Banner phụ (Promo Card) bên dưới */
    .mb-hero-promo-container {
        padding: 10px;
    }

    .mb-promo-card {
        display: flex;
        background: linear-gradient(135deg, #140000 0%, #2c3e50 100%);
        border-radius: var(--mb-radius);
        text-decoration: none;
        overflow: hidden;
        height: 100px;
        /* Chiều cao cố định vừa phải */
        position: relative;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .mb-promo-content {
        flex: 1.5;
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .mb-promo-label {
        background: var(--mb-accent);
        color: white;
        font-size: 9px;
        font-weight: bold;
        padding: 2px 8px;
        border-radius: 4px;
        width: fit-content;
        margin-bottom: 5px;
    }

    .mb-promo-title {
        color: white;
        font-size: 16px;
        font-weight: bold;
        margin: 0;
        line-height: 1.2;
    }

    .mb-promo-btn {
        color: rgba(255, 255, 255, 0.7);
        font-size: 11px;
        margin-top: 5px;
    }

    .mb-promo-image {
        flex: 1;
        position: relative;
    }

    .mb-promo-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Hiệu ứng bo góc nhẹ cho ảnh */
        clip-path: polygon(15% 0, 100% 0, 100% 100%, 0% 100%);
    }

    /* Hiệu ứng khi chạm (Mobile active) */
    .mb-promo-card:active {
        transform: scale(0.98);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const heroSwiper = new Swiper('.mb-hero-swiper', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.mb-hero-dots',
                clickable: true,
            },
            // Thêm hiệu ứng chuyển cảnh mượt
            speed: 800,
            effect: 'slide',
        });
    });
</script>
