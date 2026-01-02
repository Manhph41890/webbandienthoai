<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Khai báo các biến lưu trữ lựa chọn
    let selectedCondition = null;
    let selectedSize = null;
    let selectedColor = null;
    let currentVariant = null;

    const pageId = "100095174172336"; // ID Fanpage của bạn
    const phoneName = "{{ $phone->name }}";
    const currentUrl = window.location.href;

    // Các thành phần DOM trên bản Mobile
    const items = document.querySelectorAll('.ss-pd-v-item');
    const priceEl = document.getElementById('ss-pd-main-price');
    const stockEl = document.getElementById('ss-pd-stock-status');
    const skuEl = document.getElementById('ss-pd-sku');
    const buyBtn = document.getElementById('btn-add-to-cart'); // ID nút MUA NGAY trên mobile

    // 2. Hàm cập nhật giao diện khi chọn biến thể
    function updateDisplay() {
        // Tìm variant khớp với 3 điều kiện
        currentVariant = VARIANT_DATA.find(v => 
            v.condition === selectedCondition && 
            v.size_id == selectedSize && 
            v.color_id == selectedColor
        );

        if (currentVariant) {
            // Cập nhật giá
            priceEl.innerText = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(currentVariant.price);
            
            // Cập nhật SKU và Trạng thái kho
            if(skuEl) skuEl.innerText = currentVariant.sku || 'N/A';
            if(stockEl) {
                stockEl.innerText = currentVariant.stock > 0 ? `Còn hàng (${currentVariant.stock})` : 'Hết hàng';
                stockEl.style.color = currentVariant.stock > 0 ? '#27ae60' : '#e74c3c';
            }
            
            // Hiển thị thông tin máy cũ (Pin, Sạc, RAM)
            const usedInfo = document.getElementById('ss-pd-used-info');
            if (selectedCondition !== 'new' && usedInfo) {
                usedInfo.style.display = 'flex'; // Mobile dùng flexbox cho card
                document.getElementById('val-pin').innerText = (currentVariant.battery_health || '99') + '%';
                document.getElementById('val-sac').innerText = currentVariant.charging_count || '0';
                // Nếu có ram trong data variant
                const ramEl = document.getElementById('val-ram');
                if(ramEl) ramEl.innerText = currentVariant.ram || 'N/A';
            } else if(usedInfo) {
                usedInfo.style.display = 'none';
            }
        } else {
            priceEl.innerText = "Chưa có giá";
            if(stockEl) stockEl.innerText = "Vui lòng chọn đủ tùy chọn";
        }
    }

    // 3. Sự kiện click vào các nút biến thể (Dùng chung class .ss-pd-v-item như desktop)
    items.forEach(item => {
        item.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            const value = this.getAttribute('data-value');

            // Xóa active trong cùng nhóm (selector-condition, selector-size, selector-color)
            const parentGroup = this.closest('.m-v-list');
            parentGroup.querySelectorAll('.ss-pd-v-item').forEach(btn => btn.classList.remove('active'));
            
            // Thêm active cho nút vừa chọn
            this.classList.add('active');

            // Cập nhật giá trị đã chọn
            if (type === 'condition') selectedCondition = value;
            if (type === 'size') selectedSize = value;
            if (type === 'color') selectedColor = value;

            updateDisplay();
        });
    });

    // 4. Xử lý nút MUA NGAY (Gửi qua Messenger)
    buyBtn.addEventListener('click', function(e) {
        e.preventDefault();

        if (!selectedCondition || !selectedSize || !selectedColor) {
            alert('Vui lòng chọn đầy đủ Tình trạng, Dung lượng và Màu sắc!');
            return;
        }

        if (!currentVariant) {
            alert('Xin lỗi, phiên bản này hiện không khả dụng!');
            return;
        }

        // Lấy text hiển thị
        const sizeText = document.querySelector(`.selector-size .ss-pd-v-item.active`).innerText.trim();
        const colorText = document.querySelector(`.selector-color .ss-pd-v-item.active`).innerText.trim();
        const conditionText = selectedCondition === 'new' ? 'Máy mới 100%' : 'Máy cũ/Like New';

        // Soạn nội dung tin nhắn
        let message = `Chào Shop, mình muốn mua điện thoại (Mobile):\n`;
        message += `📱 Sản phẩm: ${phoneName}\n`;
        message += `✨ Tình trạng: ${conditionText}\n`;
        message += `💾 Dung lượng: ${sizeText}\n`;
        message += `🎨 Màu sắc: ${colorText}\n`;
        message += `💰 Giá: ${priceEl.innerText}\n`;
        message += `🆔 SKU: ${currentVariant.sku}\n`;
        message += `🔗 Link: ${currentUrl}`;

        const encodedMessage = encodeURIComponent(message);
        
        // Link m.me hoạt động tốt nhất trên mobile để mở ứng dụng Messenger
        const messengerUrl = `https://m.me/${pageId}?text=${encodedMessage}`;

        // Mở ứng dụng Messenger
        window.location.href = messengerUrl;
    });
});
</script>

<style>
    /* Highlight nút khi được chọn */
    .ss-pd-v-item.active {
        border: 2px solid #ef4444 !important;
        color: #ef4444 !important;
        background-color: #fef2f2 !important;
        position: relative;
    }

    /* Thêm icon check nhỏ nếu muốn giống mobile style hiện đại */
    .ss-pd-v-item.active::after {
        content: '✓';
        position: absolute;
        top: -5px;
        right: -5px;
        background: #ef4444;
        color: white;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Đảm bảo khung thông tin máy cũ hiện thị đẹp trên mobile */
    .m-pd-used-card {
        display: none; /* Ẩn mặc định */
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 8px;
        padding: 12px;
        margin: 15px 0;
        justify-content: space-around;
    }
    
    .m-used-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-size: 13px;
    }

    .m-used-item i {
        color: #3b82f6;
        margin-bottom: 4px;
    }
</style>