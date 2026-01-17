<style>

    /* Thấu kính soi ảnh */
    .img-zoom-lens {
        position: absolute;
        border: 1px solid #d4d4d4;
        width: 150px;
        height: 150px;
        border-radius: 10px;
        /* Bo góc kính lúp cho xịn */
        background-repeat: no-repeat;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        pointer-events: none;
        /* Tránh cản trở sự kiện chuột */
        display: none;
        /* Ẩn khi không hover */
        z-index: 10;
    }

    .ss-pd-thumb-list img.active {
        border-color: #ff4d6d;
        opacity: 1;
        transform: translateY(-2px);
    }

    .ss-pd-thumb-list img:hover {
        opacity: 1;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainBox = document.querySelector('.ss-pd-main-img-box');
        const mainImg = document.getElementById('ss-pd-main-view');
        const thumbnails = document.querySelectorAll('#ss-pd-thumbs img');

        // 1. TẠO THẤU KÍNH ZOOM
        const lens = document.createElement("div");
        lens.setAttribute("class", "img-zoom-lens");
        mainBox.appendChild(lens);

        function moveLens(e) {
            let pos, x, y;
            pos = getCursorPos(e);

            // Tính toán vị trí tâm thấu kính
            x = pos.x - (lens.offsetWidth / 2);
            y = pos.y - (lens.offsetHeight / 2);

            // Giới hạn thấu kính không ra ngoài khung ảnh
            if (x > mainImg.width - lens.offsetWidth) {
                x = mainImg.width - lens.offsetWidth;
            }
            if (x < 0) {
                x = 0;
            }
            if (y > mainImg.height - lens.offsetHeight) {
                y = mainImg.height - lens.offsetHeight;
            }
            if (y < 0) {
                y = 0;
            }

            lens.style.left = x + "px";
            lens.style.top = y + "px";

            // Tỷ lệ phóng to (độ zoom - ở đây là 2.5 lần)
            const zoom = 2.5;
            lens.style.backgroundImage = `url('${mainImg.src}')`;
            lens.style.backgroundSize = (mainImg.width * zoom) + "px " + (mainImg.height * zoom) + "px";
            lens.style.backgroundPosition = "-" + (x * zoom) + "px -" + (y * zoom) + "px";
        }

        function getCursorPos(e) {
            let a, x = 0,
                y = 0;
            e = e || window.event;
            a = mainImg.getBoundingClientRect();
            x = e.pageX - a.left;
            y = e.pageY - a.top;
            x = x - window.pageXOffset;
            y = y - window.pageYOffset;
            return {
                x: x,
                y: y
            };
        }

        // Sự kiện di chuột vào ảnh chính
        mainBox.addEventListener("mousemove", moveLens);
        mainBox.addEventListener("mouseenter", () => {
            lens.style.display = "block";
        });
        mainBox.addEventListener("mouseleave", () => {
            lens.style.display = "none";
        });


        // 2. XỬ LÝ CHUYỂN ẢNH THUMBNAIL
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                // Hiệu ứng Fade Out
                mainImg.style.opacity = '0';

                setTimeout(() => {
                    // Đổi ảnh
                    const newSrc = this.getAttribute('data-full');
                    mainImg.src = newSrc;

                    // Cập nhật trạng thái active
                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    // Hiệu ứng Fade In
                    mainImg.style.opacity = '1';
                }, 250);
            });
        });
    });
</script>
