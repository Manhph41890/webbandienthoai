@push('styles')
    <style>
        :root {
            --primary-red: #d70018;
            --bg-gray: #f2f2f2;
        }

        #m-pd-wrapper {
            background: #fff;
            padding-bottom: 80px;
            /* Chừa chỗ cho sticky footer */
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica;
        }

        /* Slider Image */
        .m-pd-image-slider {
            position: relative;
            width: 100%;
            background: #fff;
            overflow: hidden;
        }

        .m-pd-main-track {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
        }

        .m-pd-main-track::-webkit-scrollbar {
            display: none;
        }

        .m-pd-slide {
            min-width: 100%;
            scroll-snap-align: start;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 350px;
        }

        .m-pd-slide img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .m-pd-badge-condition {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            padding: 4px 10px;
            font-size: 11px;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .m-pd-slider-dots {
            text-align: center;
            padding: 10px 0;
        }

        .m-pd-slider-dots .dot {
            height: 6px;
            width: 6px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            margin: 0 3px;
        }

        .m-pd-slider-dots .dot.active {
            background-color: var(--primary-red);
            width: 12px;
            border-radius: 10px;
        }

        /* Info Section */
        .m-pd-info-container {
            padding: 0 15px;
        }

        .m-pd-breadcrumb {
            font-size: 12px;
            color: #777;
            margin-bottom: 5px;
        }

        .m-pd-title {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            line-height: 1.4;
            margin-bottom: 8px;
        }

        .m-pd-meta-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .m-pd-rating i {
            color: #ffc107;
        }

        .m-pd-price-box {
            background: #fef2f2;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .m-pd-price-new {
            font-size: 24px;
            font-weight: 800;
            color: var(--primary-red);
        }

        .m-pd-stock-status {
            font-size: 12px;
            font-weight: 600;
        }

        /* Variant Selectors */
        .m-v-group {
            margin-bottom: 15px;
        }

        .m-v-group label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .m-v-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .ss-pd-v-item {
            border: 1px solid #ddd;
            background: #fff;
            padding: 10px 5px;
            border-radius: 6px;
            font-size: 12px;
            text-align: center;
            color: #333;
        }

        .ss-pd-v-item.active {
            border: 1.5px solid var(--primary-red);
            color:  #d70018;
            background: #fff5f5;
            font-weight: 600;
        }

        .color-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 4px;
            border: 1px solid #eee;
        }

        /* Used Info Card */
        .m-pd-used-card {
            display: flex;
            justify-content: space-around;
            background: #f8f9fa;
            border: 1px dashed #ccc;
            padding: 12px;
            border-radius: 8px;
            margin: 15px 0;
        }

        .m-used-item {
            text-align: center;
            font-size: 12px;
        }

        .m-used-item i {
            display: block;
            color: #007bff;
            font-size: 18px;
            margin-bottom: 4px;
        }

        /* Promo */
        .m-pd-promo {
            border: 1px solid #ffd5d5;
            border-radius: 8px;
            margin-top: 20px;
        }

        .m-promo-header {
            background: #ffebeb;
            color: var(--primary-red);
            font-weight: 700;
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 8px 8px 0 0;
        }

        .m-promo-list {
            list-style: none;
            padding: 10px 12px;
            margin: 0;
        }

        .m-promo-list li {
            font-size: 13px;
            margin-bottom: 8px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .m-promo-list li i {
            color: #28a745;
            margin-top: 3px;
        }

        /* Sticky Action Footer */
        .m-pd-sticky-actions {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #fff;
            display: flex;
            padding: 10px 15px;
            gap: 10px;
            box-shadow: 0 -3px 15px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }

        .m-btn-contact {
            flex: 1;
            border: 1px solid #ddd;
            background: #fff;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
        }

        .m-btn-buy {
            flex: 2;
            background: linear-gradient(to right, #0841ec, #f76060);
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
        }
    </style>
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('m-pd-slider');
        const dots = document.querySelectorAll('.m-pd-slider-dots .dot');

        // State mặc định từ biến thể đầu tiên
        let selected = {
            condition: String(VARIANT_DATA[0].condition),
            size: String(VARIANT_DATA[0].size_id),
            color: String(VARIANT_DATA[0].color_id)
        };

        // Xử lý Dots cho slider cuộn ngang
        slider.addEventListener('scroll', () => {
            let index = Math.round(slider.scrollLeft / slider.offsetWidth);
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        });

        function updateUI() {
            const match = VARIANT_DATA.find(v =>
                String(v.condition) === selected.condition &&
                String(v.size_id) === selected.size &&
                String(v.color_id) === selected.color
            );

            if (match) {
                document.getElementById('ss-pd-main-price').innerText = new Intl.NumberFormat('vi-VN').format(
                    match.price) + 'w';
                document.getElementById('ss-pd-sku').innerText = match.sku || 'N/A';

                const stockLabel = document.getElementById('ss-pd-stock-status');
                stockLabel.innerText = match.stock > 0 ? `Còn hàng` : 'Hết hàng';
                stockLabel.style.color = match.stock > 0 ? '#2e7d32' : '#d70018';

                // Máy cũ / mới
                const usedBox = document.getElementById('ss-pd-used-info');
                if (match.condition === 'used') {
                    usedBox.style.display = 'flex';
                    document.getElementById('val-pin').innerText = match.used_details?.battery_health || 'N/A';
                    document.getElementById('val-sac').innerText = (match.used_details?.charging_cycles ||
                        '0') + ' lần';
                    document.getElementById('ss-pd-current-status').innerText = 'Like New';
                } else {
                    usedBox.style.display = 'none';
                    document.getElementById('ss-pd-current-status').innerText = 'Mới 100%';
                }

                // Scroll slider đến ảnh tương ứng nếu có
                if (match.image_path) {
                    const fullPath = window.location.origin + '/storage/' + match.image_path;
                    const slides = document.querySelectorAll('.m-pd-slide img');
                    slides.forEach((img, idx) => {
                        if (img.src.includes(match.image_path)) {
                            slider.scrollTo({
                                left: idx * slider.offsetWidth,
                                behavior: 'smooth'
                            });
                        }
                    });
                }
            }

            updateButtonStates();
        }

        function updateButtonStates() {
            document.querySelectorAll('.ss-pd-v-item').forEach(btn => {
                const type = btn.dataset.type;
                const val = String(btn.dataset.value);
                btn.classList.toggle('active', selected[type] === val);
            });
        }

        document.querySelectorAll('.ss-pd-v-item').forEach(btn => {
            btn.addEventListener('click', function() {
                selected[this.dataset.type] = String(this.dataset.value);
                updateUI();
            });
        });

        updateUI();
    });
</script>
