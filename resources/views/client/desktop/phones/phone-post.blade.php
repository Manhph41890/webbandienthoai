<script>
    document.addEventListener('DOMContentLoaded', function() {
        const data = window.VARIANT_DATA;
        if (!data) return;

        const priceEl = document.getElementById('ss-pd-main-price');
        const skuEl = document.getElementById('ss-pd-sku');
        const stockStatusEl = document.getElementById('ss-pd-stock-status');
        const buyBtn = document.getElementById('btn-buy-now');

        let selectedCondition = null,
            selectedSize = null,
            selectedColor = null,
            currentVariant = null;

        // 1. Hàm tạo mã REF chuyên nghiệp
        function generateRefCode(variant) {
            // Định dạng: MUA_[ID]_[Tên không dấu]_[Dung lượng]
            const nameSlug = "{{ Str::slug($phone->name, '_') }}";
            const sizeName = document.querySelector(`.ss-pd-v-item[data-type="size"].active`)?.innerText.trim()
                .replace(/\s+/g, '') || '0';
            return `MUA_${variant.id}_${nameSlug}_${sizeName}`.toUpperCase();
        }

        function updateDisplay() {
            currentVariant = data.find(v =>
                v.condition === selectedCondition &&
                v.size_id == selectedSize &&
                v.color_id == selectedColor
            );

            if (currentVariant) {
                priceEl.innerText = new Intl.NumberFormat('vi-VN').format(currentVariant.price) + 'w';
                if (skuEl) skuEl.innerText = currentVariant.sku || 'N/A';
                stockStatusEl.innerText = "Sẵn hàng tại Toàn Hồng Korea";
                stockStatusEl.style.color = "#16a34a";

                const usedInfo = document.getElementById('ss-pd-used-info');
                if (selectedCondition !== 'new' && usedInfo) {
                    usedInfo.style.display = 'flex';
                    document.getElementById('val-pin').innerText = (currentVariant.battery_health || '98') +
                    '%';
                    document.getElementById('val-sac').innerText = (currentVariant.charging_count || 'Ít') +
                        ' lần';
                } else if (usedInfo) {
                    usedInfo.style.display = 'none';
                }
            }
        }

        // 2. Hàm sao chép hiện đại hơn
        async function copyToClipboard(text) {
            try {
                await navigator.clipboard.writeText(text);
            } catch (err) {
                // Fallback cho trình duyệt cũ
                const el = document.createElement('textarea');
                el.value = text;
                document.body.appendChild(el);
                el.select();
                document.execCommand('copy');
                document.body.removeChild(el);
            }
        }

        document.querySelectorAll('.ss-pd-v-item').forEach(item => {
            item.addEventListener('click', function() {
                const type = this.dataset.type;
                document.querySelectorAll(`.ss-pd-v-item[data-type="${type}"]`).forEach(btn =>
                    btn.classList.remove('active'));
                this.classList.add('active');
                if (type === 'condition') selectedCondition = this.dataset.value;
                if (type === 'size') selectedSize = this.dataset.value;
                if (type === 'color') selectedColor = this.dataset.value;
                updateDisplay();
            });
        });

        if (buyBtn) {
            buyBtn.onclick = async function(e) {
                e.preventDefault();

                if (!currentVariant) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Chọn cấu hình',
                        text: 'Vui lòng chọn đủ Tình trạng, Dung lượng và Màu sắc!'
                    });
                    return;
                }

                const sizeText = document.querySelector(`.ss-pd-v-item[data-type="size"].active`)
                    .innerText.trim();
                const colorText = document.querySelector(`.ss-pd-v-item[data-type="color"].active`)
                    .innerText.trim();
                const refCode = generateRefCode(currentVariant);

                // Nội dung tin nhắn để khách Paste (Dự phòng cho Desktop)
                let message = `🛒 ĐƠN ĐẶT HÀNG:\n`;
                message += `Sản phẩm: {{ $phone->name }}\n`;
                message += `Cấu hình: ${sizeText} - ${colorText}\n`;
                message += `Tình trạng: ${selectedCondition == 'new' ? 'Mới 100%' : 'Like New'}\n`;
                message += `Giá: ${priceEl.innerText}\n`;
                message += `Mã SP: ${currentVariant.sku}\n`;
                message += `Link: ${window.location.href}`;

                // Link Messenger kết hợp cả REF và TEXT
                const pageUsername = "anhtoan270189";
                const messengerUrl =
                    `https://m.me/${pageUsername}?ref=${refCode}&text=${encodeURIComponent(message)}`;

                // Thực hiện sao chép
                await copyToClipboard(message);

                // Thông báo chuyên nghiệp
                Swal.fire({
                    title: 'Đang mở Messenger...',
                    html: `
                        <div style="text-align: left; background: #f4f4f4; padding: 10px; border-radius: 8px; font-size: 0.9em;">
                            ${message.replace(/\n/g, '<br>')}
                        </div>
                        <p style="margin-top:15px; color: #d33; font-weight: bold;">
                           <i class="fas fa-copy"></i> Đã tự động sao chép thông tin!
                        </p>
                        <small>Nếu ô chat trống, bạn chỉ cần <b>Dán (Ctrl+V)</b> và gửi nhé.</small>
                    `,
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Mở Chat & Gửi đơn',
                    cancelButtonText: 'Ở lại trang',
                    confirmButtonColor: '#0084FF'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open(messengerUrl, '_blank');
                    }
                });
            };
        }

        // Chọn mặc định
        if (data.length > 0) {
            const cheapest = data.reduce((min, v) => v.price < min.price ? v : min, data[0]);
            document.querySelector(`.ss-pd-v-item[data-type="condition"][data-value="${cheapest.condition}"]`)
                ?.click();
            document.querySelector(`.ss-pd-v-item[data-type="size"][data-value="${cheapest.size_id}"]`)
        ?.click();
            document.querySelector(`.ss-pd-v-item[data-type="color"][data-value="${cheapest.color_id}"]`)
                ?.click();
        }
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
        background: #ff0000;
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
