<style>
    /* Tùy chỉnh thanh cuộn cho cột bên phải */
    .right-scrollable-content {
        max-height: 75vh;
        /* Chiều cao tối đa (khoảng 75% màn hình) */
        overflow-y: auto;
        /* Hiện thanh cuộn dọc khi nội dung dài */
        overflow-x: hidden;
        scroll-behavior: smooth;
        /* Cuộn mượt */
    }

    /* Làm đẹp thanh cuộn (Chỉ dành cho trình duyệt Webkit như Chrome, Safari, Edge) */
    .right-scrollable-content::-webkit-scrollbar {
        width: 6px;
        /* Độ rộng thanh cuộn */
    }

    .right-scrollable-content::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* Màu nền của đường ray */
        border-radius: 10px;
    }

    .right-scrollable-content::-webkit-scrollbar-thumb {
        background: #ccc;
        /* Màu của thanh trượt */
        border-radius: 10px;
    }

    .right-scrollable-content::-webkit-scrollbar-thumb:hover {
        background: #999;
        /* Màu thanh trượt khi di chuột vào */
    }

    /* Đảm bảo tab menu dính trên cùng khi cuộn trong div này */
    .right-scrollable-content .sticky-top {
        position: sticky;
        top: 0;
        z-index: 1020;
        background-color: white;
    }

    /* CSS Custom cho Modal */
    .badge-soft-primary {
        background: #e7f1ff;
        color: #007bff;
        border-radius: 8px;
    }

    .badge-soft-success {
        background: #d4edda;
        color: #155724;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 11px;
    }

    .main-image-container {
        height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
    }

    .main-img-zoom {
        max-height: 100%;
        transition: 0.3s;
    }

    .main-img-zoom:hover {
        transform: scale(1.05);
    }

    .divider-vertical {
        width: 1px;
        background: #eee;
        height: 40px;
    }

    .nav-pills .nav-link {
        color: #6c757d;
        border: 1px solid transparent;
        border-radius: 10px;
        margin: 0 5px;
    }

    .nav-pills .nav-link.active {
        background: #140000;
        color: #fff;
    }

    .variant-item-card {
        transition: all 0.2s;
        border: 1px solid #edf2f9;
    }

    .variant-item-card:hover {
        border-color: #007bff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .bg-light-primary {
        background-color: #f0f7ff !important;
    }

    .gallery-img {
        height: 120px;
        width: 100%;
        object-fit: cover;
        transition: 0.3s;
        cursor: pointer;
    }

    .gallery-img:hover {
        filter: brightness(0.8);
    }

    .used-info-box {
        font-size: 12px;
    }

    /* Hiệu ứng khi di chuột vào ảnh */
    .clickable-img {
        cursor: pointer;
        transition: opacity 0.3s;
    }

    .clickable-img:hover {
        opacity: 0.8;
    }

    /* CSS cho Lightbox (Xem ảnh chi tiết) */
    .custom-lightbox {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        align-items: center;
        justify-content: center;
    }

    .lightbox-content {
        max-width: 90%;
        max-height: 90%;
        border-radius: 5px;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
        animation: zoomIn 0.3s;
    }

    @keyframes zoomIn {
        from {
            transform: scale(0.7);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .close-lightbox {
        position: absolute;
        top: 20px;
        right: 35px;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }
</style>


<script>
    function openLightbox(src) {
        const lightbox = document.getElementById('imageLightbox');
        const lightboxImg = document.getElementById('lightboxImg');
        lightbox.style.display = "flex";
        lightboxImg.src = src;

        // Chặn cuộn trang web khi đang xem ảnh
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const lightbox = document.getElementById('imageLightbox');
        lightbox.style.display = "none";

        // Mở lại cuộn trang
        document.body.style.overflow = 'auto';
    }

    // Đóng lightbox khi nhấn phím ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === "Escape") {
            closeLightbox();
        }
    });
</script>
