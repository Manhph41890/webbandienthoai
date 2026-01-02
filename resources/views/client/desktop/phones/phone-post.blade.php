<script>
    // Hàm mở Messenger
    function openMessenger() {
        const pageId = "100090503628117";
        window.open(`https://m.me/${pageId}`, '_blank');
    }

    document.addEventListener('DOMContentLoaded', function() {
        let selectedCondition = null,
            selectedSize = null,
            selectedColor = null,
            currentVariant = null;

        const pageId = "100090503628117";
        const phoneName = "{{ $phone->name }}";

        // Logic chọn biến thể
        const items = document.querySelectorAll('.ss-pd-v-item');
        items.forEach(item => {
            item.addEventListener('click', function() {
                const type = this.dataset.type;
                const value = this.dataset.value;

                document.querySelectorAll(`.ss-pd-v-item[data-type="${type}"]`).forEach(btn =>
                    btn.classList.remove('active'));
                this.classList.add('active');

                if (type === 'condition') selectedCondition = value;
                if (type === 'size') selectedSize = value;
                if (type === 'color') selectedColor = value;

                // Tìm variant tương ứng
                currentVariant = VARIANT_DATA.find(v =>
                    v.condition === selectedCondition &&
                    v.size_id == selectedSize &&
                    v.color_id == selectedColor
                );

                // Gọi hàm cập nhật UI của bạn ở đây (nếu có)
                if (typeof updateDisplay === "function") updateDisplay();
            });
        });

        // XỬ LÝ NÚT MUA NGAY
        const buyBtn = document.getElementById('btn-buy-now');
        if (buyBtn) {
            buyBtn.onclick = function() {
                // Kiểm tra đã chọn đủ chưa
                if (!selectedCondition || !selectedSize || !selectedColor || !currentVariant) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Thông báo',
                        text: 'Vui lòng chọn đầy đủ Thông tin loại máy, Dung lượng và Màu sắc!',
                        confirmButtonColor: '#0084FF'
                    });
                    return;
                }

                const sizeText = document.querySelector(`.ss-pd-v-item[data-type="size"].active`).innerText
                    .trim();
                const colorText = document.querySelector(`.ss-pd-v-item[data-type="color"].active`)
                    .innerText.trim();
                const price = document.getElementById('ss-pd-main-price').innerText;

                // Nội dung gửi Shop
                let message = `Chào Shop, mình muốn mua:\n`;
                message += `📱 Sản phẩm: ${phoneName}\n`;
                message += `✨ Tình trạng: ${selectedCondition == 'new' ? 'used' : 'Like New'}\n`;
                message += `💾 Cấu hình: ${sizeText} - ${colorText}\n`;
                message += `💰 Giá: ${price}\n`;
                message += `🔗 Link: ${window.location.href}`;

                // Bước 1: Copy vào bộ nhớ đệm
                copyToClipboard(message);

                // Bước 2: Hiện dòng chữ hướng dẫn dưới nút (nếu có)
                const guide = document.getElementById('copy-guide');
                if (guide) {
                    guide.style.display = 'inline-block';
                }

                // Bước 3: Hiện thông báo xịn sò (Chỉ có 1 nút duy nhất)
                Swal.fire({
                    title: 'Đã sao chép đơn hàng!',
                    html: 'Thông tin sản phẩm đã được copy. <br>Bạn chỉ cần <b>Dán (Ctrl+V)</b> vào khung chat nhé!',
                    icon: 'success',
                    confirmButtonColor: '#0084FF',
                    confirmButtonText: 'Mở Messenger ngay',
                    allowOutsideClick: false, // Không cho phép click ra ngoài để tắt
                    allowEscapeKey: false // Không cho phép nhấn nút Esc để tắt
                }).then((result) => {
                    if (result.isConfirmed) {
                        openMessenger();
                    }
                });

            };
        }

        function copyToClipboard(text) {
            const temp = document.createElement("textarea");
            temp.value = text;
            document.body.appendChild(temp);
            temp.select();
            document.execCommand("copy");
            document.body.removeChild(temp);
        }
    });
</script>
<style>
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
