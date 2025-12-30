@push('styles')
    <style>
        /* Root container để định nghĩa biến nội bộ, tránh ảnh hưởng toàn cục */
        .hpkg-wrapper {
            --hpkg-primary: #4a6cf7;
            --hpkg-danger: #e74c3c;
            --hpkg-warning: #f1c40f;
            --hpkg-dark: #2d3436;
            --hpkg-gray: #636e72;
            --hpkg-bg-soft: #f8f9fa;
            --hpkg-gap: 20px;

            padding: 40px 0;
            background-color: transparent;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        .hpkg-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Tiêu đề */
        .hpkg-head-group {
            margin-bottom: 30px;
        }

        .hpkg-main-title {
            font-size: 28px !important;
            font-weight: 800 !important;
            color: var(--hpkg-dark) !important;
            margin-bottom: 8px !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none !important;
        }

        .hpkg-title-divider {
            width: 60px;
            height: 4px;
            background: var(--hpkg-primary);
            border-radius: 2px;
        }

        /* Slider Core */
        .hpkg-slider-outer {
            overflow: hidden !important;
            width: 100%;
            cursor: grab;
            touch-action: pan-y;
            position: relative;
        }

        .hpkg-slider-outer:active {
            cursor: grabbing;
        }

        .hpkg-track-list {
            display: flex !important;
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
            will-change: transform;
            gap: var(--hpkg-gap) !important;
            padding: 10px 0;
        }

        /* Thẻ Card */
        .hpkg-card-item {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 20px;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            border: 1px solid #eee;
            min-width: 285px;
            /* Điều chỉnh tùy layout */
            flex-shrink: 0;
        }

        .hpkg-card-item:hover {
            transform: translateY(-5px);
        }

        .hpkg-package-name {
            font-size: 18px !important;
            color: var(--hpkg-dark);
            margin: 0 0 10px 0 !important;
            font-weight: 700 !important;
            min-height: 50px;
            line-height: 1.4;
        }

        .hpkg-meta-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hpkg-rating-stars {
            color: var(--hpkg-warning);
            font-size: 12px;
        }

        .hpkg-rating-count {
            color: var(--hpkg-gray);
            margin-left: 4px;
        }

        .hpkg-btn-wishlist {
            background: none;
            border: none;
            color: var(--hpkg-gray);
            cursor: pointer;
            padding: 5px;
            font-size: 18px;
        }

        /* Mid Section */
        .hpkg-price-area {
            text-align: center;
            background: #fdf2f2;
            padding: 12px;
            border-radius: 10px;
            margin: 15px 0;
        }

        .hpkg-price-val {
            font-size: 22px;
            font-weight: 800;
            color: var(--hpkg-danger);
        }

        .hpkg-currency {
            font-size: 16px;
            margin-left: 2px;
        }

        .hpkg-duration {
            color: var(--hpkg-gray);
            font-size: 13px;
        }

        .hpkg-tag-item {
            background: var(--hpkg-bg-soft);
            padding: 8px 12px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .hpkg-tag-item i {
            color: var(--hpkg-primary);
            width: 16px;
        }

        .hpkg-specs-grid {
            border-top: 1px dashed #eee;
            padding-top: 12px;
            margin-top: 5px;
        }

        .hpkg-spec-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .hpkg-spec-label {
            color: var(--hpkg-gray);
        }

        .hpkg-spec-value {
            font-weight: 600;
            color: var(--hpkg-dark);
        }

        .hpkg-text-red {
            color: #e11d48;
        }

        /* Footer Buttons */
        .hpkg-card-bot {
            display: flex;
            gap: 8px;
            margin-top: auto;
            padding-top: 15px;
        }

        .hpkg-btn-action {
            text-decoration: none !important;
            padding: 10px 5px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            transition: 0.3s;
        }

        .hpkg-btn-buy {
            flex: 1.8;
            background-color: var(--hpkg-primary);
            color: #fff !important;
        }

        .hpkg-btn-buy:hover {
            background-color: #3451d1;
        }

        .hpkg-btn-info {
            flex: 1;
            background-color: #f0f2f5;
            color: var(--hpkg-dark) !important;
        }

        /* Pagination */
        .hpkg-dots-container {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 25px;
        }

        .hpkg-dot {
            width: 10px;
            height: 10px;
            background: #ccc;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            transition: 0.3s;
        }

        .hpkg-dot.is-active {
            background: var(--hpkg-danger);
            width: 25px;
            border-radius: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hpkg-card-item {
                min-width: calc(100vw - 60px);
            }
        }
    </style>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const track = document.getElementById('hpkg-track-list');
                const dotsContainer = document.getElementById('hpkg-pagination-dots');
                const items = track.querySelectorAll('.hpkg-card-item');

                if (items.length === 0) return;

                let itemsPerPage = window.innerWidth <= 768 ? 1 : (window.innerWidth <= 1024 ? 2 : 4);
                const totalPages = Math.ceil(items.length / itemsPerPage);
                let currentPage = 0;

                // Tạo dots
                function initDots() {
                    dotsContainer.innerHTML = '';
                    for (let i = 0; i < totalPages; i++) {
                        const btn = document.createElement('button');
                        btn.className = `hpkg-dot ${i === 0 ? 'is-active' : ''}`;
                        btn.addEventListener('click', () => moveToPage(i));
                        dotsContainer.appendChild(btn);
                    }
                }

                function moveToPage(idx) {
                    currentPage = idx;
                    const gap = 20;
                    const itemWidth = items[0].offsetWidth;
                    const offset = idx * (itemWidth + gap) * itemsPerPage;
                    track.style.transform = `translateX(-${offset}px)`;

                    dotsContainer.querySelectorAll('.hpkg-dot').forEach((d, i) => {
                        d.classList.toggle('is-active', i === idx);
                    });
                }

                // Kéo thả (Swipe) logic
                let isDown = false,
                    startX, scrollLeftVal;

                track.parentElement.addEventListener('mousedown', (e) => {
                    isDown = true;
                    startX = e.pageX;
                    track.style.transition = 'none';
                });

                window.addEventListener('mouseup', (e) => {
                    if (!isDown) return;
                    isDown = false;
                    track.style.transition = 'transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                    const endX = e.pageX;
                    if (startX - endX > 50 && currentPage < totalPages - 1) moveToPage(currentPage + 1);
                    else if (endX - startX > 50 && currentPage > 0) moveToPage(currentPage - 1);
                    else moveToPage(currentPage);
                });

                // Touch events cho mobile
                track.parentElement.addEventListener('touchstart', (e) => {
                    isDown = true;
                    startX = e.touches[0].pageX;
                    track.style.transition = 'none';
                });

                track.parentElement.addEventListener('touchend', (e) => {
                    if (!isDown) return;
                    isDown = false;
                    track.style.transition = 'transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                    const endX = e.changedTouches[0].pageX;
                    if (startX - endX > 50 && currentPage < totalPages - 1) moveToPage(currentPage + 1);
                    else if (endX - startX > 50 && currentPage > 0) moveToPage(currentPage - 1);
                    else moveToPage(currentPage);
                });

                initDots();
            });
        </script>
    @endpush
