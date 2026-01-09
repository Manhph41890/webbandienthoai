<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- KHAI BÁO BIẾN ---
        let selectedCondition = null,
            selectedSize = null,
            selectedColor = null,
            currentVariant = null;

        const pageId = "100063769254777";
        const phoneName = "{{ $phone->name }}";
        const currentUrl = window.location.href;

        // DOM Elements
        const priceEl = document.getElementById('ss-pd-main-price');
        const stockEl = document.getElementById('ss-pd-stock-status');
        const skuEl = document.getElementById('ss-pd-sku');
        const buyBtn = document.getElementById('btn-add-to-cart');
        const usedInfo = document.getElementById('ss-pd-used-info');

        // --- 1. HÀM TỰ ĐỘNG CHỌN BIẾN THỂ RẺ NHẤT (Default) ---
        function selectDefaultVariant() {
            if (typeof VARIANT_DATA !== 'undefined' && VARIANT_DATA.length > 0) {
                // Tìm biến thể giá thấp nhất
                const cheapest = VARIANT_DATA.reduce((min, v) => v.price < min.price ? v : min, VARIANT_DATA[
                0]);

                // Tìm và click vào các nút tương ứng
                const btnCond = document.querySelector(
                    `.ss-pd-v-item[data-type="condition"][data-value="${cheapest.condition}"]`);
                const btnSize = document.querySelector(
                    `.ss-pd-v-item[data-type="size"][data-value="${cheapest.size_id}"]`);
                const btnColor = document.querySelector(
                    `.ss-pd-v-item[data-type="color"][data-value="${cheapest.color_id}"]`);

                if (btnCond) btnCond.click();
                if (btnSize) btnSize.click();
                if (btnColor) btnColor.click();
            }
        }

        // --- 2. HÀM CẬP NHẬT GIAO DIỆN (Xử lý cả hàng không có sẵn) ---
        function updateDisplay() {
            if (typeof VARIANT_DATA === 'undefined') return;

            // Tìm biến thể trong database
            currentVariant = VARIANT_DATA.find(v =>
                v.condition === selectedCondition &&
                v.size_id == selectedSize &&
                v.color_id == selectedColor
            );

            if (currentVariant) {
                // TRƯỜNG HỢP: CÓ HÀNG TRONG HỆ THỐNG
                priceEl.innerText = new Intl.NumberFormat('vi-VN').format(currentVariant.price) + 'đ';
                if (skuEl) skuEl.innerText = currentVariant.sku || 'N/A';
                if (stockEl) {
                    stockEl.innerText = currentVariant.stock > 0 ? "Còn hàng (Sẵn sàng giao)" :
                        "Hàng đặt trước (3-5 ngày)";
                    stockEl.style.color = currentVariant.stock > 0 ? '#27ae60' : '#e67e22';
                }

                // Hiện thông số máy cũ nếu là máy cũ
                if (selectedCondition !== 'new' && usedInfo) {
                    usedInfo.style.display = 'flex';
                    document.getElementById('val-pin').innerText = (currentVariant.battery_health || '9x') +
                    '%';
                    document.getElementById('val-sac').innerText = currentVariant.charging_count || 'Ít';
                } else if (usedInfo) {
                    usedInfo.style.display = 'none';
                }
            } else {
                // TRƯỜNG HỢP: BIẾN THỂ KHÁCH CHỌN KHÔNG CÓ TRONG KHO (HÀNG ẢO)
                // Vẫn cho phép hiện thông tin nhưng báo là hàng đặt trước/Liên hệ
                priceEl.innerText = "Giá: Liên hệ";
                if (skuEl) skuEl.innerText = "Pre-Order";
                if (stockEl) {
                    stockEl.innerText = "Hàng đặt trước (Liên hệ shop)";
                    stockEl.style.color = "#3498db"; // Màu xanh dương cho hàng order
                }
                if (usedInfo) usedInfo.style.display = 'none';
            }
        }

        // --- 3. SỰ KIỆN CLICK ---
        document.querySelectorAll('.ss-pd-v-item').forEach(item => {
            item.addEventListener('click', function() {
                const type = this.getAttribute('data-type');
                const value = this.getAttribute('data-value');

                // Xóa active cùng nhóm
                this.closest('.m-v-list').querySelectorAll('.ss-pd-v-item').forEach(btn => btn
                    .classList.remove('active'));
                this.classList.add('active');

                if (type === 'condition') selectedCondition = value;
                if (type === 'size') selectedSize = value;
                if (type === 'color') selectedColor = value;

                updateDisplay();
            });
        });

        // --- 4. XỬ LÝ GỬI TIN NHẮN MESSENGER ---
        if (buyBtn) {
            buyBtn.addEventListener('click', function(e) {
                e.preventDefault();

                // Chỉ cần chọn đủ 3 loại là cho gửi, không quan tâm currentVariant có null hay không
                if (!selectedCondition || !selectedSize || !selectedColor) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Thông báo',
                        text: 'Vui lòng chọn đầy đủ Tình trạng, Dung lượng và Màu sắc!',
                        confirmButtonColor: '#0084FF'
                    });
                    return;
                }

                // Lấy text hiển thị để gửi tin nhắn (Cho chính xác tên màu/dung lượng)
                let sizeText = "",
                    colorText = "";
                document.querySelectorAll('.ss-pd-v-item.active').forEach(el => {
                    if (el.dataset.type === 'size') sizeText = el.innerText.trim();
                    if (el.dataset.type === 'color') colorText = el.innerText.trim();
                });

                const conditionLabel = selectedCondition === 'new' ? 'Máy mới 100%' : 'Máy cũ/Like New';

                // Lấy giá từ Variant nếu có, nếu không thì ghi Liên hệ
                const finalPrice = currentVariant ? new Intl.NumberFormat('vi-VN').format(currentVariant
                    .price) + 'đ' : "Liên hệ";
                const orderStatus = currentVariant ? (currentVariant.stock > 0 ? "Sẵn hàng" :
                    "Đặt hàng") : "Đặt hàng (Theo yêu cầu)";

                let message = `Chào Shop, mình muốn tư vấn điện thoại này:\n`;
                message += `📱 Sản phẩm: ${phoneName}\n`;
                message += `✨ Tình trạng: ${conditionLabel}\n`;
                message += `💾 Cấu hình: ${sizeText} - ${colorText}\n`;
                message += `💰 Giá: ${finalPrice}\n`;
                message += `🚚 Trạng thái: ${orderStatus}\n`;
                message += `🔗 Link: ${currentUrl}`;

                const messengerUrl = `https://m.me/${pageId}?text=${encodeURIComponent(message)}`;

                // Thông báo mượt cho Android
                Swal.fire({
                    title: 'Gửi yêu cầu',
                    html: `Shop sẽ tư vấn cho bạn bản <b>${sizeText}</b> màu <b>${colorText}</b> ngay qua Messenger!`,
                    icon: 'info',
                    confirmButtonColor: '#0084FF',
                    confirmButtonText: 'Mở Messenger ngay',
                    showClass: {
                        popup: 'animated fadeInDown faster'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Android xử lý location.href rất tốt để mở App
                        window.location.href = messengerUrl;
                    }
                });
            });
        }

        // --- 5. KHỞI TẠO MẶC ĐỊNH ---
        selectDefaultVariant();
    });
</script>

<style>
    /* Hiệu ứng khi nhấn nút trên mobile */
    .ss-pd-v-item:active {
        transform: scale(0.95);
    }

    /* Badge báo trạng thái kho hàng */
    .m-pd-stock-status {
        font-size: 12px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 4px;
        background: #f1f5f9;
    }
</style>
