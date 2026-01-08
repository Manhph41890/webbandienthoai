<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lưu trữ các DOM elements
        const priceEl = document.getElementById('ss-pd-main-price');
        const skuEl = document.getElementById('ss-pd-sku');
        const stockStatusEl = document.getElementById('ss-pd-stock-status');
        const buyBtn = document.getElementById('btn-buy-now');

        let selectedCondition = null,
            selectedSize = null,
            selectedColor = null,
            currentVariant = null;

        // --- 1. HÀM TỰ ĐỘNG CHỌN BIẾN THỂ RẺ NHẤT KHI LOAD TRANG ---
        function selectDefaultVariant() {
            if (VARIANT_DATA.length > 0) {
                // Tìm biến thể có giá thấp nhất
                const cheapest = VARIANT_DATA.reduce((min, v) => v.price < min.price ? v : min, VARIANT_DATA[
                    0]);

                // Kích hoạt click giả lập
                document.querySelector(
                    `.ss-pd-v-item[data-type="condition"][data-value="${cheapest.condition}"]`)?.click();
                document.querySelector(`.ss-pd-v-item[data-type="size"][data-value="${cheapest.size_id}"]`)
                    ?.click();
                document.querySelector(`.ss-pd-v-item[data-type="color"][data-value="${cheapest.color_id}"]`)
                    ?.click();
            }
        }

        // --- 2. CẬP NHẬT GIAO DIỆN ---
        function updateDisplay() {
            // Tìm biến thể khớp trong DATA
            currentVariant = VARIANT_DATA.find(v =>
                v.condition === selectedCondition &&
                v.size_id == selectedSize &&
                v.color_id == selectedColor
            );

            if (currentVariant) {
                // Trường hợp có sẵn hàng/có trong database
                priceEl.innerText = new Intl.NumberFormat('vi-VN').format(currentVariant.price) + 'đ';
                skuEl.innerText = currentVariant.sku || 'N/A';
                stockStatusEl.innerText = "Còn hàng";
                stockStatusEl.style.color = "#16a34a";
                // Hiển thị thêm thông tin máy cũ nếu có
                if (selectedCondition !== 'new') {
                    document.getElementById('ss-pd-used-info').style.display = 'block';
                    document.getElementById('val-pin').innerText = currentVariant.pin || '9x%';
                    document.getElementById('val-sac').innerText = currentVariant.sac_lan || 'Ít';
                } else {
                    document.getElementById('ss-pd-used-info').style.display = 'none';
                }
            } else {
                // TRƯỜNG HỢP KHÔNG CÓ SẴN (Cải thiện theo ý bạn)
                priceEl.innerText = "Giá: Liên hệ";
                skuEl.innerText = "Đặt hàng";
                stockStatusEl.innerText = "Hàng đặt trước (Liên hệ)";
                stockStatusEl.style.color = "#ea580c";
                document.getElementById('ss-pd-used-info').style.display = 'none';
            }

            // Logic làm mờ (Optionally) - Bạn có thể thêm class để báo hiệu các option không có sẵn
            updateAvailableUI();
        }

        // --- 3. LOGIC LÀM MỜ CÁC OPTION KHÔNG CÓ TRONG KHO (NHƯNG VẪN CHO CHỌN) ---
        function updateAvailableUI() {
            // Hàm này có thể mở rộng để thêm class 'opacity-50' vào các nút màu sắc/dung lượng 
            // mà sự kết hợp đó không tồn tại trong VARIANT_DATA để khách biết là hàng cần đặt trước.
        }

        // --- 4. SỰ KIỆN CLICK CHỌN ---
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

                updateDisplay();
            });
        });

        // --- 5. XỬ LÝ NÚT MUA NGAY ---
        if (buyBtn) {
            buyBtn.onclick = function(e) {
                e.preventDefault();

                if (!selectedCondition || !selectedSize || !selectedColor) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Chú ý',
                        text: 'Vui lòng chọn đầy đủ tùy chọn!'
                    });
                    return;
                }

                const sizeText = document.querySelector(`.ss-pd-v-item[data-type="size"].active`).innerText
                    .trim();
                const colorText = document.querySelector(`.ss-pd-v-item[data-type="color"].active`)
                    .innerText.trim();

                // Lấy giá an toàn (từ object nếu có, nếu không thì ghi Liên hệ)
                const finalPrice = currentVariant ? new Intl.NumberFormat('vi-VN').format(currentVariant
                    .price) + 'đ' : "Liên hệ";

                let message = `Chào Shop, mình muốn tư vấn sản phẩm này:\n`;
                message += `📱 Sản phẩm: {{ $phone->name }}\n`;
                message += `✨ Tình trạng: ${selectedCondition == 'new' ? 'Mới 100%' : 'Like New'}\n`;
                message += `💾 Cấu hình: ${sizeText} - ${colorText}\n`;
                message += `💰 Giá dự kiến: ${finalPrice}\n`;
                message += `🔗 Link: ${window.location.href}`;

                const messengerUrl = `https://m.me/100090503628117?text=${encodeURIComponent(message)}`;

                Swal.fire({
                    title: 'Gửi yêu cầu tư vấn',
                    html: `Bạn đang chọn bản: <b>${sizeText} - ${colorText}</b><br>Giá: <b>${finalPrice}</b>`,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Mở Messenger'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open(messengerUrl, '_blank');
                    }
                });
            };
        }

        // Chạy mặc định khi load
        selectDefaultVariant();
    });
</script>

<style>
    /* Nút đang được chọn */
    .ss-pd-v-item.active {
        border: 2px solid #0084FF !important;
        background-color: #f0f7ff;
        position: relative;
    }

    /* Thêm icon check nhỏ khi chọn */
    .ss-pd-v-item.active::after {
        content: '✓';
        position: absolute;
        top: -8px;
        right: -5px;
        background: #0084FF;
        color: white;
        font-size: 10px;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Hiệu ứng cho nút nếu bạn muốn báo hiệu hàng không có sẵn (tùy chọn) */
    .ss-pd-v-item.not-in-stock {
        border-style: dashed;
        opacity: 0.7;
    }
</style>
