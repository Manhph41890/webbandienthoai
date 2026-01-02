<script>
    // Thay thế đoạn xử lý trong buyBtn.addEventListener
    buyBtn.addEventListener('click', function() {
        if (!selectedCondition || !selectedSize || !selectedColor) {
            alert('Vui lòng chọn đầy đủ Tình trạng, Dung lượng và Màu sắc!');
            return;
        }

        if (!currentVariant) {
            alert('Xin lỗi, phiên bản này hiện không khả dụng!');
            return;
        }

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

        // 1. Thực hiện Copy vào bộ nhớ đệm
        navigator.clipboard.writeText(message).then(function() {
            // 2. Thông báo cho người dùng
            alert(
                'Thông tin đơn hàng đã được sao chép! Bạn chỉ cần "Dán" (Ctrl+V) vào tin nhắn cho Shop nhé.');

            // 3. Mở Messenger
            // Dùng m.me là link chuẩn nhất để mở ứng dụng/web messenger
            const messengerUrl = `https://m.me/${pageId}`;
            window.open(messengerUrl, '_blank');
        }).catch(function(err) {
            console.error('Không thể copy: ', err);
            // Backup nếu copy lỗi thì vẫn mở link
            window.open(`https://m.me/${pageId}`, '_blank');
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
