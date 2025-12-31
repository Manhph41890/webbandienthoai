<style>
    :root {
        --hpk-primary: #4a6cf7;
        --hpk-danger: #e74c3c;
        --hpk-warning: #f1c40f;
        --hpk-dark: #2d3436;
        --hpk-gray: #636e72;
        --hpk-bg-soft: #f8f9fa;
    }

    .hpk-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Segoe UI', sans-serif;
    }

    .hpk-header { margin-bottom: 30px; }
    .hpk-title {
        font-size: 28px;
        font-weight: 800;
        color: var(--hpk-dark);
        text-transform: uppercase;
        margin-bottom: 8px;
    }
    .hpk-underline {
        width: 60px;
        height: 4px;
        background: var(--hpk-primary);
        border-radius: 2px;
    }

    /* Slider Core */
    .hpk-slider-viewport {
        overflow: hidden;
        width: 100%;
        cursor: grab;
        touch-action: pan-y;
    }
    .hpk-slider-viewport:active { cursor: grabbing; }

    .hpk-track {
        display: flex;
        gap: 20px;
        transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        will-change: transform;
    }

    /* Card Style */
    .hpk-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        padding: 20px;
        display: flex;
        flex-direction: column;
        border: 1px solid #eee;
        min-width: 280px; /* Độ rộng tối thiểu cho 1 card */
        flex-shrink: 0;
        transition: transform 0.3s;
    }
    .hpk-card:hover { transform: translateY(-5px); }

    .hpk-card-head {
        border-bottom: 1px solid #f0f0f0;
        padding-bottom: 12px;
        margin-bottom: 15px;
    }
    .hpk-product-name {
        font-size: 18px;
        font-weight: 700;
        min-height: 50px;
        margin: 0 0 10px 0;
    }
    .hpk-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .hpk-rating { color: var(--hpk-warning); font-size: 12px; }
    .hpk-wishlist { border: none; background: none; color: var(--hpk-gray); cursor: pointer; }

    /* Body & Price */
    .hpk-card-body { flex-grow: 1; display: flex; flex-direction: column; gap: 15px; }
    .hpk-price-box {
        text-align: center;
        background: #fff5f5;
        padding: 10px;
        border-radius: 10px;
    }
    .hpk-price-val { font-size: 22px; font-weight: 800; color: var(--hpk-danger); }
    .hpk-duration { color: var(--hpk-gray); font-size: 13px; }

    .hpk-feat-item {
        background: var(--hpk-bg-soft);
        padding: 8px 12px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        margin-bottom: 8px;
    }
    .hpk-feat-item i { color: var(--hpk-primary); width: 15px; }

    .hpk-spec-row {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        margin-bottom: 5px;
    }
    .hpk-text-danger { color: #e11d48; }

    /* Buttons */
    .hpk-card-foot { display: flex; gap: 8px; margin-top: 15px; }
    .hpk-btn-main, .hpk-btn-sub {
        padding: 10px 5px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 12px;
        text-align: center;
        text-decoration: none;
        text-transform: uppercase;
        flex: 1;
    }
    .hpk-btn-main { background: var(--hpk-primary); color: #fff !important; flex: 1.8; }
    .hpk-btn-sub { background: #f0f2f5; color: var(--hpk-dark) !important; }

    /* Pagination Dots */
    .hpk-dots {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 20px;
    }
    .hpk-dot {
        width: 10px;
        height: 10px;
        background: #ccc;
        border-radius: 50%;
        border: none;
        cursor: pointer;
        transition: 0.3s;
    }
    .hpk-dot.active {
        background: var(--hpk-danger);
        width: 25px;
        border-radius: 10px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const track = document.getElementById('hpk-track');
        const dotsContainer = document.getElementById('hpk-dots');
        const viewport = document.querySelector('.hpk-slider-viewport');
        const items = track.querySelectorAll('.hpk-card');

        if (items.length === 0) return;

        let itemsPerPage = window.innerWidth <= 768 ? 1 : (window.innerWidth <= 1024 ? 2 : 4);
        const totalPages = Math.ceil(items.length / itemsPerPage);
        let currentPage = 0;

        function createDots() {
            dotsContainer.innerHTML = '';
            for (let i = 0; i < totalPages; i++) {
                const dot = document.createElement('button');
                dot.classList.add('hpk-dot');
                if (i === 0) dot.classList.add('active');
                dot.onclick = () => goToPage(i);
                dotsContainer.appendChild(dot);
            }
        }

        function goToPage(index) {
            currentPage = Math.max(0, Math.min(index, totalPages - 1));
            const gap = 20;
            const itemWidth = items[0].offsetWidth + gap;
            const moveDistance = currentPage * itemWidth * itemsPerPage;

            track.style.transform = `translateX(-${moveDistance}px)`;
            
            document.querySelectorAll('.hpk-dot').forEach((dot, i) => {
                dot.classList.toggle('active', i === currentPage);
            });
        }

        // Drag & Swipe Logic
        let isDragging = false, startX = 0, currentMove = 0;

        const start = (e) => {
            isDragging = true;
            startX = e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
            track.style.transition = 'none';
        };

        const move = (e) => {
            if (!isDragging) return;
            const x = e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
            currentMove = x - startX;
            const itemWidth = items[0].offsetWidth + 20;
            const offset = -(currentPage * itemWidth * itemsPerPage);
            track.style.transform = `translateX(${offset + currentMove}px)`;
        };

        const end = () => {
            if (!isDragging) return;
            isDragging = false;
            track.style.transition = 'transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            if (currentMove < -50) goToPage(currentPage + 1);
            else if (currentMove > 50) goToPage(currentPage - 1);
            else goToPage(currentPage);
            currentMove = 0;
        };

        viewport.addEventListener('mousedown', start);
        viewport.addEventListener('touchstart', start);
        window.addEventListener('mousemove', move);
        window.addEventListener('touchmove', move);
        window.addEventListener('mouseup', end);
        window.addEventListener('touchend', end);

        createDots();
        window.addEventListener('resize', () => {
            // Tối ưu: Chỉ reload nếu itemsPerPage thay đổi
            let newIPP = window.innerWidth <= 768 ? 1 : (window.innerWidth <= 1024 ? 2 : 4);
            if(newIPP !== itemsPerPage) location.reload();
        });
    });
</script>