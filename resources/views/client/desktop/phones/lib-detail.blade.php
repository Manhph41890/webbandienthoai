@push('styles')
    <style>
        /* Đảm bảo dùng Font Inter hoặc Roboto để nhìn chuẩn Tech */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

        #ss-pd-wrapper {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: #f8f9fa;
            padding: 30px 0;
            color: #333;
        }

        .ss-pd-container {
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-top: 40px;
            padding-bottom: 100px;
        }

        .ss-pd-row {
            display: flex;
            flex-wrap: wrap;
        }

        /* Cột ảnh */
        .ss-pd-col-image {
            flex: 0 0 45%;
            padding: 30px;
            border-right: 1px solid #eee;
        }

        .ss-pd-main-img-box {
            position: relative;
            border: 1px solid #f0f0f0;
            border-radius: 8px;
            margin-bottom: 15px;
            overflow: hidden;
            cursor: zoom-in;
        }

        .ss-pd-main-img-box img {
            width: 100%;
            display: block;
            transition: transform 0.3s ease;
        }

        .ss-pd-main-img-box:hover img {
            transform: scale(1.05);
        }

        .ss-pd-badge-condition {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #007bff;
            color: #fff;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .ss-pd-thumb-list {
            display: flex;
            gap: 10px;
            overflow-x: auto;
        }

        .ss-pd-thumb-list img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border: 2px solid #eee;
            border-radius: 6px;
            cursor: pointer;
        }

        .ss-pd-thumb-list img.active {
            border-color: #007bff;
        }

        /* Cột thông tin */
        .ss-pd-col-info {
            flex: 0 0 55%;
            padding: 30px;
        }

        .ss-pd-breadcrumb {
            font-size: 13px;
            color: #888;
            margin-bottom: 10px;
        }

        .ss-pd-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ss-pd-tag {
            background: #e1f0ff;
            color: #007bff;
            font-size: 14px;
            padding: 2px 10px;
            border-radius: 4px;
        }

        .ss-pd-rating {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ss-pd-rating .stars i {
            color: #ffc107;
            font-size: 14px;
        }

        .ss-pd-review-count {
            color: #666;
            font-size: 14px;
        }

        .ss-pd-price-area {
            margin-bottom: 25px;
            padding: 15px;
            background: #fdf2f2;
            border-radius: 8px;
        }

        .ss-pd-price-new {
            font-size: 32px;
            font-weight: 800;
            color: #d70018;
        }

        .ss-pd-price-old {
            text-decoration: line-through;
            color: #888;
            margin-left: 15px;
        }

        /* Biến thể */
        .ss-pd-label {
            display: block;
            font-weight: 600;
            margin: 15px 0 8px;
        }

        .ss-pd-variant-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .ss-pd-v-item {
            padding: 8px 16px;
            border: 1px solid #ddd;
            background: #fff;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .ss-pd-v-item:hover {
            border-color: #007bff;
        }

        .ss-pd-v-item.active {
            border-color: #007bff;
            background: #eef6ff;
            color: #007bff;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0, 123, 255, 0.1);
        }

        .color-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 1px solid #ddd;
        }

        /* Thông số cũ */
        .ss-pd-spec-summary {
            display: flex;
            gap: 20px;
            margin: 20px 0;
            padding: 15px;
            border: 1px dashed #ccc;
            border-radius: 8px;
        }

        .spec-item {
            font-size: 14px;
        }

        .spec-item i {
            color: #007bff;
            margin-right: 5px;
        }

        /* Promo Box */
        .ss-pd-promo-box {
            border: 1px solid #ffccbc;
            border-radius: 8px;
            margin-top: 25px;
        }

        .promo-title {
            background: #fff3e0;
            padding: 10px 15px;
            font-weight: bold;
            color: #e64a19;
            border-radius: 8px 8px 0 0;
        }

        .promo-list {
            list-style: none;
            padding: 15px;
            margin: 0;
        }

        .promo-list li {
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 1.5;
            display: flex;
            align-items: flex-start;
        }

        .check-icon {
            color: #2e7d32;
            margin-right: 10px;
            font-weight: bold;
        }

        /* Buttons */
        .ss-pd-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .ss-pd-btn-buy {
            flex: 2;
            padding: 15px;
            background: linear-gradient(to right, #d70018, #ff4d4d);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
        }

        .ss-pd-btn-cart {
            flex: 1;
            padding: 15px;
            background: #fff;
            color: #d70018;
            border: 2px solid #d70018;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        .ss-pd-btn-buy:hover {
            opacity: 0.9;
        }

        .ss-pd-btn-cart:hover {
            background: #fff5f5;
        }

        /* Làm rõ nút đang được chọn */
        .ss-pd-v-item.active {
            border: 2px solid #d70018 !important;
            /* Đổi sang màu đỏ thương hiệu của bạn */
            background: #fff5f5 !important;
            color: #d70018 !important;
            position: relative;
        }

        /* Thêm icon check nhỏ ở góc nút active (tùy chọn) */
        .ss-pd-v-item.active::after {
            content: "\f058";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            top: -8px;
            right: -8px;
            background: #fff;
            border-radius: 50%;
            font-size: 14px;
        }

        /* Hiệu ứng cho Thumbnail */
        .ss-pd-thumb-list img {
            transition: all 0.2s;
            opacity: 0.6;
        }

        .ss-pd-thumb-list img.active {
            opacity: 1;
            border-color: #d70018;
            transform: scale(1.05);
        }

        /* Thêm một chút CSS để nhận diện nút đang chọn */
        .ss-pd-v-item.active {
            border: 2px solid #ef4444 !important;
            color: #ef4444 !important;
            background-color: #fef2f2;
        }

        .ss-pd-btn-buy {
            background: #0084FF;
            /* Màu xanh Messenger */
            color: white;
            border: none;
            padding: 15px 25px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 8px;
        }

        .ss-pd-btn-buy:hover {
            background: #0073e6;
        }
    </style>
@endpush
<script>
    const VARIANT_DATA = @json($variants);

    document.addEventListener('DOMContentLoaded', function() {
        const wrapper = document.getElementById('ss-pd-wrapper');
        const mainImg = document.getElementById('ss-pd-main-view');
        const thumbs = document.querySelectorAll('#ss-pd-thumbs img');

        // State lưu trữ lựa chọn (Chuyển về String để khớp với dataset)
        let selected = {
            condition: String(VARIANT_DATA[0].condition),
            size: String(VARIANT_DATA[0].size_id),
            color: String(VARIANT_DATA[0].color_id)
        };

        // --- 1. XỬ LÝ CHUYỂN ẢNH KHI CLICK THUMBNAIL ---
        thumbs.forEach(thumb => {
            thumb.addEventListener('click', function() {
                // Đổi ảnh chính
                mainImg.src = this.getAttribute('data-full');

                // Active thumb
                thumbs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // --- 2. CẬP NHẬT GIAO DIỆN KHI CHỌN BIẾN THỂ ---
        function updateUI() {
            const match = VARIANT_DATA.find(v =>
                String(v.condition) === selected.condition &&
                String(v.size_id) === selected.size &&
                String(v.color_id) === selected.color
            );

            if (match) {
                // Cập nhật Giá & SKU
                document.getElementById('ss-pd-main-price').innerText = new Intl.NumberFormat('vi-VN').format(
                    match.price) + ' WON';
                document.getElementById('ss-pd-sku').innerText = match.sku || 'N/A';

                // Cập nhật Stock
                const stockLabel = document.getElementById('ss-pd-stock-status');
                stockLabel.innerText = match.stock > 0 ? `Còn hàng (${match.stock})` : 'Hết hàng';
                stockLabel.style.color = match.stock > 0 ? '#2e7d32' : '#d70018';

                // Cập nhật Specs
                if (document.getElementById('ss-pd-screen'))
                    document.getElementById('ss-pd-screen').innerText = match.general_specs?.screen_size ||
                    'N/A';
                if (document.getElementById('val-ram'))
                    document.getElementById('val-ram').innerText = match.general_specs?.ram || 'N/A';

                // Xử lý máy cũ
                const usedBox = document.getElementById('ss-pd-used-info');
                if (match.condition === 'used') {
                    usedBox.style.display = 'flex';
                    document.getElementById('val-pin').innerText = match.used_details?.battery_health || 'N/A';
                    document.getElementById('val-sac').innerText = (match.used_details?.charging_cycles ||
                        '0') + ' lần';
                    document.getElementById('ss-pd-current-status').innerText = 'Máy cũ / Like New';
                } else {
                    usedBox.style.display = 'none';
                    document.getElementById('ss-pd-current-status').innerText = 'Máy mới 100%';
                }

                // TỰ ĐỘNG CHUYỂN ẢNH THEO BIẾN THỂ (Nếu có)
                if (match.image_path) {
                    const newSrc = window.location.origin + '/storage/' + match.image_path;
                    mainImg.src = newSrc;

                    // Tìm và active thumbnail tương ứng
                    thumbs.forEach(t => {
                        t.classList.remove('active');
                        if (t.src === newSrc) t.classList.add('active');
                    });
                }
            } else {
                document.getElementById('ss-pd-main-price').innerText = 'Liên hệ';
                document.getElementById('ss-pd-stock-status').innerText = 'Cấu hình này hiện không có sẵn';
            }

            updateButtonStates();
        }

        function updateButtonStates() {
            document.querySelectorAll('.ss-pd-v-item').forEach(btn => {
                const type = btn.dataset.type;
                const val = String(btn.dataset.value);

                if (selected[type] === val) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        }

        // Sự kiện click nút biến thể
        document.querySelectorAll('.ss-pd-v-item').forEach(btn => {
            btn.addEventListener('click', function() {
                selected[this.dataset.type] = String(this.dataset.value);
                updateUI();
            });
        });

        // Chạy lần đầu
        updateUI();
    });
</script>
