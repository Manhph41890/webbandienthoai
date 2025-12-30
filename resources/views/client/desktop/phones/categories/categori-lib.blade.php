<style>
/* Reset & Variables cho Slider */
:root {
    --th-slider-radius: 15px;
    --th-btn-bg: rgba(0, 0, 0, 0.5);
    --th-btn-hover: rgba(0, 0, 0, 0.8);
}

.th-cat-slider-wrapper {
    padding: 20px 0;
    width: 100%;
    background-color: transparent; /* Hoặc màu nền trang của bạn */
}

.th-cat-slider-container {
    max-width: 1200px !important;
    margin: 0 auto;
    padding: 0 0px; /* Tạo khoảng trống cho nút điều hướng lòi ra ngoài */
    position: relative;
}

.th-cat-slider-main {
    position: relative;
    overflow: hidden;
    border-radius: var(--th-slider-radius);
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    background: #fff;
}

.th-cat-slider-track {
    display: flex;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    will-change: transform;
}

.th-cat-slider-item {
    min-width: 100%;
    flex: 0 0 100%;
}

.th-cat-slider-item img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
    border-radius: var(--th-slider-radius);
}

/* Nút điều hướng */
.th-cat-slider-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    background: var(--th-btn-bg);
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    transition: all 0.3s ease;
    font-size: 16px;
}

.th-cat-slider-btn:hover {
    background: var(--th-btn-hover);
    transform: translateY(-50%) scale(1.1);
}

.th-cat-slider-btn.th-prev {
    left: -20px; /* Đẩy nút ra ngoài khung ảnh một chút giống mẫu */
}

.th-cat-slider-btn.th-next {
    right: -20px; /* Đẩy nút ra ngoài khung ảnh một chút giống mẫu */
}

/* Chấm tròn chỉ số */
.th-cat-slider-dots {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 11;
}

.th-dot {
    width: 8px;
    height: 8px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    cursor: pointer;
    transition: 0.3s;
}

.th-dot.active {
    background: #fff;
    width: 20px;
    border-radius: 10px;
}

/* Responsive */
@media (max-width: 768px) {
    .th-cat-slider-container {
        padding: 0 15px;
    }
    .th-cat-slider-btn {
        width: 30px;
        height: 30px;
        font-size: 12px;
    }
    .th-cat-slider-btn.th-prev { left: 5px; }
    .th-cat-slider-btn.th-next { right: 5px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const track = document.querySelector('.th-cat-slider-track');
    const slides = Array.from(track.children);
    const nextButton = document.getElementById('thNextBtn');
    const prevButton = document.getElementById('thPrevBtn');
    const dotContainer = document.getElementById('thSliderDots');
    
    let currentIndex = 0;
    const slideCount = slides.length;
    let autoPlayTimer;

    // Tạo dots tự động dựa trên số lượng slide
    slides.forEach((_, i) => {
        const dot = document.createElement('div');
        dot.classList.add('th-dot');
        if (i === 0) dot.classList.add('active');
        dot.addEventListener('click', () => goToSlide(i));
        dotContainer.appendChild(dot);
    });

    const dots = document.querySelectorAll('.th-dot');

    function updateSlider() {
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
        
        // Cập nhật dots
        dots.forEach(dot => dot.classList.remove('active'));
        dots[currentIndex].classList.add('active');
    }

    function goToSlide(index) {
        currentIndex = index;
        updateSlider();
        resetTimer();
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slideCount;
        updateSlider();
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + slideCount) % slideCount;
        updateSlider();
    }

    function resetTimer() {
        clearInterval(autoPlayTimer);
        autoPlayTimer = setInterval(nextSlide, 5000); // 5 giây đổi ảnh
    }

    // Sự kiện nút bấm
    nextButton.addEventListener('click', () => {
        nextSlide();
        resetTimer();
    });

    prevButton.addEventListener('click', () => {
        prevSlide();
        resetTimer();
    });

    // Khởi chạy auto play
    resetTimer();

    // Hỗ trợ vuốt trên điện thoại (Touch events)
    let startX = 0;
    track.addEventListener('touchstart', (e) => startX = e.touches[0].clientX);
    track.addEventListener('touchend', (e) => {
        let endX = e.changedTouches[0].clientX;
        if (startX - endX > 50) nextSlide();
        if (startX - endX < -50) prevSlide();
        resetTimer();
    });
});
</script>