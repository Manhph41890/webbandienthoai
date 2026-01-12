<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('m-pd-slider');
        const dots = document.querySelectorAll('.m-pd-slider-dots .dot');

        // 1. CẬP NHẬT DOT KHI VUỐT
        slider.addEventListener('scroll', function() {
            const index = Math.round(slider.scrollLeft / slider.offsetWidth);

            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        });

        // 2. TÍNH NĂNG CLICK MỞ TOÀN MÀN HÌNH (Xịn hơn soi kính lúp)
        const slides = document.querySelectorAll('.m-pd-slide img');
        slides.forEach(img => {
            img.addEventListener('click', function() {
                openFullScreen(this.src);
            });
        });

        function openFullScreen(src) {
            // 1. Tạo overlay với hiệu ứng Blur hậu cảnh
            const overlay = document.createElement('div');
            overlay.style = `
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.85); 
        backdrop-filter: blur(8px); 
        -webkit-backdrop-filter: blur(8px);
        z-index: 10000;
        display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.3s ease;
    `;

            // 2. Tạo container cho ảnh để dễ xử lý hiệu ứng bung ra
            const imgContainer = document.createElement('div');
            imgContainer.style =
                "transform: scale(0.9); transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);";

            const fullImg = document.createElement('img');
            fullImg.src = src;
            fullImg.style = `
        max-width: 95vw; 
        max-height: 85vh; 
        object-fit: contain; 
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    `;

            // 3. Thiết kế lại dòng chữ hướng dẫn (nhìn giống như một cái Badge chuyên nghiệp)
            const tip = document.createElement('div');
            tip.innerHTML =
                '<i class="fa-solid fa-circle-xmark" style="margin-right: 8px;"></i> Nhấn bất kỳ để đóng';
            tip.style = `
        position: absolute; 
        bottom: 60px; 
        left: 50%; 
        transform: translateX(-50%);
        color: #ffffff; 
        font-size: 14px; 
        font-weight: 500;
        background: rgba(255, 255, 255, 0.15);
        padding: 10px 20px;
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        white-space: nowrap;
        pointer-events: none;
        letter-spacing: 0.5px;
    `;

            // Lắp ráp các thành phần
            imgContainer.appendChild(fullImg);
            overlay.appendChild(imgContainer);
            overlay.appendChild(tip);
            document.body.appendChild(overlay);

            // Kích hoạt hiệu ứng xuất hiện (sau 10ms để trình duyệt kịp nhận diện)
            setTimeout(() => {
                overlay.style.opacity = "1";
                imgContainer.style.transform = "scale(1)";
            }, 10);

            // Nhấn để đóng với hiệu ứng mờ dần
            overlay.onclick = () => {
                overlay.style.opacity = "0";
                imgContainer.style.transform = "scale(0.9)";
                setTimeout(() => {
                    if (document.body.contains(overlay)) {
                        document.body.removeChild(overlay);
                    }
                }, 300);
            };
        }
    });
</script>
