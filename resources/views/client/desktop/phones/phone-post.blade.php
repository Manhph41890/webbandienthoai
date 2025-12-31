<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Khai báo các biến lưu trữ lựa chọn của người dùng
    let selectedCondition = null;
    let selectedSize = null;
    let selectedColor = null;
    let currentVariant = null;

    const pageId = "100090503628117"; // THAY ID FANPAGE CỦA BẠN VÀO ĐÂY (Ví dụ: 123456789)
    const phoneName = "{{ $phone->name }}";
    const currentUrl = window.location.href;

    const items = document.querySelectorAll('.ss-pd-v-item');
    const priceEl = document.getElementById('ss-pd-main-price');
    const stockEl = document.getElementById('ss-pd-stock-status');
    const skuEl = document.getElementById('ss-pd-sku');
    const buyBtn = document.getElementById('btn-buy-now');

    // 2. Hàm cập nhật giao diện khi chọn biến thể
    function updateDisplay() {
        // Tìm variant khớp với 3 điều kiện
        currentVariant = VARIANT_DATA.find(v => 
            v.condition === selectedCondition && 
            v.size_id == selectedSize && 
            v.color_id == selectedColor
        );

        if (currentVariant) {
            // Cập nhật giá (định dạng tiền tệ VNĐ)
            priceEl.innerText = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(currentVariant.price);
            skuEl.innerText = currentVariant.sku || 'N/A';
            stockEl.innerText = currentVariant.stock > 0 ? `Còn hàng (${currentVariant.stock})` : 'Hết hàng';
            stockEl.style.color = currentVariant.stock > 0 ? '#27ae60' : '#e74c3c';
            
            // Hiển thị thông tin máy cũ nếu có
            const usedInfo = document.getElementById('ss-pd-used-info');
            if (selectedCondition !== 'new' && usedInfo) {
                usedInfo.style.display = 'block';
                document.getElementById('val-pin').innerText = currentVariant.battery_health + '%' || 'N/A';
                document.getElementById('val-sac').innerText = currentVariant.charging_count || 'N/A';
            } else if(usedInfo) {
                usedInfo.style.display = 'none';
            }
        } else {
            priceEl.innerText = "Chưa có giá";
            stockEl.innerText = "Vui lòng chọn đủ tùy chọn";
        }
    }

    // 3. Sự kiện click vào các nút biến thể
    items.forEach(item => {
        item.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            const value = this.getAttribute('data-value');

            // Xóa active trong cùng nhóm
            document.querySelectorAll(`.ss-pd-v-item[data-type="${type}"]`).forEach(btn => btn.classList.remove('active'));
            // Thêm active cho nút vừa chọn
            this.classList.add('active');

            // Cập nhật giá trị đã chọn
            if (type === 'condition') selectedCondition = value;
            if (type === 'size') selectedSize = value;
            if (type === 'color') selectedColor = value;

            updateDisplay();
        });
    });

    // 4. Xử lý nút MUA NGAY
    buyBtn.addEventListener('click', function() {
        if (!selectedCondition || !selectedSize || !selectedColor) {
            alert('Vui lòng chọn đầy đủ Tình trạng, Dung lượng và Màu sắc!');
            return;
        }

        if (!currentVariant) {
            alert('Xin lỗi, phiên bản này hiện không khả dụng!');
            return;
        }

        // Lấy text hiển thị của Size và Color để gửi tin nhắn cho đẹp
        const sizeText = document.querySelector(`.ss-pd-v-item[data-type="size"].active`).innerText.trim();
        const colorText = document.querySelector(`.ss-pd-v-item[data-type="color"].active`).innerText.trim();
        const conditionText = selectedCondition === 'new' ? 'Máy mới 100%' : 'Máy cũ/Like New';

        // Soạn nội dung tin nhắn
        let message = `Chào Shop, mình muốn mua điện thoại:\n`;
        message += `📱 Sản phẩm: ${phoneName}\n`;
        message += `✨ Tình trạng: ${conditionText}\n`;
        message += `💾 Dung lượng: ${sizeText}\n`;
        message += `🎨 Màu sắc: ${colorText}\n`;
        message += `💰 Giá: ${priceEl.innerText}\n`;
        message += `🆔 SKU: ${currentVariant.sku}\n`;
        message += `🔗 Link: ${currentUrl}`;

        // Mã hóa URL
        const encodedMessage = encodeURIComponent(message);
        // const messengerUrl = `https://m.me/${pageId}?text=${encodedMessage}`;
        const messengerUrl = `https://www.facebook.com/messages/t/${pageId}?text=${encodedMessage}`;

        // Mở tab mới
        window.open(messengerUrl, '_blank');
    });
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
        background: #0084FF; /* Màu xanh Messenger */
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