<script>
    (function() {
        // --- 1. KHỞI TẠO BIẾN TRẠNG THÁI ---
        let selectedCondition = null;
        let selectedSize = null;
        let selectedColor = null;
        let currentVariant = null;

        const pageUsername = "hanofarmer";
        const phoneName = "{{ $phone->name }}";
        const currentUrl = window.location.href;

        // Các phần tử DOM cần tương tác
        const priceEl = document.getElementById('ss-pd-main-price');
        const stockEl = document.getElementById('ss-pd-stock-status');
        const skuEl = document.getElementById('ss-pd-sku');
        const usedInfo = document.getElementById('ss-pd-used-info');

        // --- 2. HÀM TỰ ĐỘNG CHỌN BIẾN THỂ RẺ NHẤT (UX iPhone) ---
        function selectDefaultVariant() {
            if (typeof VARIANT_DATA !== 'undefined' && VARIANT_DATA.length > 0) {
                // Tìm biến thể giá thấp nhất trong mảng dữ liệu
                const cheapest = VARIANT_DATA.reduce((min, v) => v.price < min.price ? v : min, VARIANT_DATA[0]);

                // Giả lập click vào các nút tương ứng
                // Sử dụng setTimeout để đảm bảo DOM đã render hoàn toàn trên Safari
                setTimeout(() => {
                    const btnCond = document.querySelector(
                        `.ss-pd-v-item[data-type="condition"][data-value="${cheapest.condition}"]`);
                    const btnSize = document.querySelector(
                        `.ss-pd-v-item[data-type="size"][data-value="${cheapest.size_id}"]`);
                    const btnColor = document.querySelector(
                        `.ss-pd-v-item[data-type="color"][data-value="${cheapest.color_id}"]`);

                    if (btnCond) btnCond.click();
                    if (btnSize) btnSize.click();
                    if (btnColor) btnColor.click();
                }, 100);
            }
        }

        // --- 3. CẬP NHẬT GIAO DIỆN (Xử lý hàng ảo/Hàng đặt trước) ---
        function updateDisplay() {
            if (typeof VARIANT_DATA === 'undefined') return;

            // Tìm biến thể khớp trong DB
            currentVariant = VARIANT_DATA.find(v =>
                v.condition === selectedCondition &&
                v.size_id == selectedSize &&
                v.color_id == selectedColor
            );

            if (currentVariant) {
                // Trường hợp CÓ hàng trong dữ liệu
                const formattedPrice = new Intl.NumberFormat('vi-VN').format(currentVariant.price) + 'đ';
                if (priceEl) priceEl.innerText = formattedPrice;
                if (skuEl) skuEl.innerText = currentVariant.sku || 'N/A';
                if (stockEl) {
                    stockEl.innerText = currentVariant.stock > 0 ? "Sẵn hàng tại shop" : "Hàng đặt trước";
                    stockEl.style.color = currentVariant.stock > 0 ? '#27ae60' : '#f39c12';
                }

                // Hiển thị info máy cũ (Pin/Sạc)
                if (selectedCondition !== 'new' && usedInfo) {
                    usedInfo.style.display = 'flex';
                    const pin = document.getElementById('val-pin');
                    const sac = document.getElementById('val-sac');
                    if (pin) pin.innerText = (currentVariant.battery_health || '9x') + '%';
                    if (sac) sac.innerText = currentVariant.charging_count || 'Ít';
                } else if (usedInfo) {
                    usedInfo.style.display = 'none';
                }
            } else {
                // TRƯỜNG HỢP KHÁCH CHỌN BIẾN THỂ KHÔNG CÓ TRONG DB (Hàng đặt trước theo yêu cầu)
                if (priceEl) priceEl.innerText = "Giá: Liên hệ";
                if (skuEl) skuEl.innerText = "Custom Order";
                if (stockEl) {
                    stockEl.innerText = "Hàng đặt riêng (Vui lòng chat)";
                    stockEl.style.color = "#3498db";
                }
                if (usedInfo) usedInfo.style.display = 'none';
            }
        }

        // --- 4. LẮNG NGHE SỰ KIỆN (Event Delegation) ---
        document.addEventListener('click', function(e) {
            const item = e.target.closest('.ss-pd-v-item');
            if (item) {
                const type = item.getAttribute('data-type');
                const value = item.getAttribute('data-value');
                const parentGroup = item.closest('.m-v-list');

                if (parentGroup) {
                    parentGroup.querySelectorAll('.ss-pd-v-item').forEach(btn => btn.classList.remove(
                        'active'));
                }
                item.classList.add('active');

                if (type === 'condition') selectedCondition = value;
                if (type === 'size') selectedSize = value;
                if (type === 'color') selectedColor = value;

                updateDisplay();
                return;
            }

            // Xử lý nút MUA NGAY
            const buyBtn = e.target.closest('#btn-add-to-cart');
            if (buyBtn) {
                e.preventDefault();

                // Chỉ yêu cầu chọn đủ 3 thuộc tính, không cần currentVariant phải tồn tại
                if (!selectedCondition || !selectedSize || !selectedColor) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Thiếu thông tin',
                        text: 'Vui lòng chọn đầy đủ các tùy chọn máy!',
                        confirmButtonColor: '#0084FF'
                    });
                    return;
                }

                // Lấy thông tin text thực tế từ nút đang Active
                let sizeText = "";
                let colorText = "";
                document.querySelectorAll('.ss-pd-v-item.active').forEach(el => {
                    if (el.getAttribute('data-type') === 'size') sizeText = el.innerText.trim();
                    if (el.getAttribute('data-type') === 'color') colorText = el.innerText.trim();
                });

                const conditionLabel = selectedCondition === 'new' ? 'Máy mới 100%' : 'Like New/99%';
                const priceText = priceEl ? priceEl.innerText : "Liên hệ";
                const orderType = currentVariant ? (currentVariant.stock > 0 ? "Mua sẵn" : "Đặt hàng") :
                    "Đặt hàng theo yêu cầu";

                // Tạo nội dung tin nhắn chuyên nghiệp
                let message = `Chào Hanofarmer, mình muốn tư vấn mua máy:\n`;
                message += `📱 Model: ${phoneName}\n`;
                message += `✨ Tình trạng: ${conditionLabel}\n`;
                message += `💾 Cấu hình: ${sizeText} - ${colorText}\n`;
                message += `💰 Giá hiện tại: ${priceText}\n`;
                message += `📦 Loại đơn: ${orderType}\n`;
                message += `🔗 Link: ${currentUrl}`;

                const messengerUrl = `https://m.me/${pageUsername}?text=${encodeURIComponent(message)}`;

                // Hiển thị thông báo xác nhận theo phong cách iOS
                Swal.fire({
                    title: 'Xác nhận tư vấn',
                    html: `Bạn đang quan tâm bản <b>${sizeText}</b> màu <b>${colorText}</b>.<br>Hệ thống sẽ kết nối bạn tới Messenger!`,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#0084FF',
                    confirmButtonText: 'Mở Messenger',
                    cancelButtonText: 'Để sau',
                    reverseButtons: true, // iPhone thường để nút Confirm bên phải
                    showClass: {
                        popup: 'animated fadeInDown faster'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Trên iOS, window.location.href hoạt động ổn định nhất để kích hoạt Deep Link
                        window.location.href = messengerUrl;
                    }
                });
            }
        });

        // Tự động chạy chọn mặc định khi load
        if (document.readyState === 'complete') {
            selectDefaultVariant();
        } else {
            window.addEventListener('load', selectDefaultVariant);
        }
    })();
</script>

<style>
    /* Tối ưu hóa phản hồi chạm cho iPhone */
    #btn-add-to-cart,
    .ss-pd-v-item {
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
        transition: transform 0.1s ease;
    }

    .ss-pd-v-item:active {
        transform: scale(0.96);
        /* Hiệu ứng nhấn nhẹ trên iOS */
    }

    /* Hiệu ứng active rõ ràng hơn */
    .ss-pd-v-item.active {
        border: 2px solid #0084FF !important;
        background-color: #f0f7ff !important;
        font-weight: bold;
    }
</style>
