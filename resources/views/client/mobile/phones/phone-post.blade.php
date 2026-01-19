<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- KHAI BÁO BIẾN ---
        let selectedCondition = null,
            selectedSize = null,
            selectedColor = null,
            currentVariant = null;

        const pageId = "61575141059562";
        const phoneName = "{{ $phone->name }}";
        const currentUrl = window.location.href;

        // DOM Elements
        const priceEl = document.getElementById('ss-pd-main-price');
        const stockEl = document.getElementById('ss-pd-stock-status');
        const skuEl = document.getElementById('ss-pd-sku');
        const buyBtn = document.getElementById('btn-add-to-cart'); // Nút Mua Ngay
        const usedInfo = document.getElementById('ss-pd-used-info');

        // --- 1. HÀM TẠO MÃ REF (Đồng bộ với Desktop) ---
        function generateRefCode(variant) {
            const nameSlug = "{{ Str::slug($phone->name, '_') }}";
            const sizeText = document.querySelector(`.ss-pd-v-item[data-type="size"].active`)?.innerText.trim()
                .replace(/\s+/g, '') || '0';
            const vId = variant ? variant.id : 'ORDER';
            return `M_MUA_${vId}_${nameSlug}_${sizeText}`.toUpperCase();
        }

        // --- 2. HÀM TỰ ĐỘNG CHỌN BIẾN THỂ RẺ NHẤT ---
        function selectDefaultVariant() {
            if (typeof VARIANT_DATA !== 'undefined' && VARIANT_DATA.length > 0) {
                const cheapest = VARIANT_DATA.reduce((min, v) => v.price < min.price ? v : min, VARIANT_DATA[
                    0]);

                document.querySelector(
                    `.ss-pd-v-item[data-type="condition"][data-value="${cheapest.condition}"]`)?.click();
                document.querySelector(`.ss-pd-v-item[data-type="size"][data-value="${cheapest.size_id}"]`)
                    ?.click();
                document.querySelector(`.ss-pd-v-item[data-type="color"][data-value="${cheapest.color_id}"]`)
                    ?.click();
            }
        }

        // --- 3. CẬP NHẬT GIAO DIỆN ---
        function updateDisplay() {
            if (typeof VARIANT_DATA === 'undefined') return;

            currentVariant = VARIANT_DATA.find(v =>
                v.condition === selectedCondition &&
                v.size_id == selectedSize &&
                v.color_id == selectedColor
            );

            if (currentVariant) {
                priceEl.innerText = new Intl.NumberFormat('vi-VN').format(currentVariant.price) + 'w';
                if (skuEl) skuEl.innerText = currentVariant.sku || 'N/A';
                if (stockEl) {
                    stockEl.innerText = currentVariant.stock > 0 ? "Còn hàng (Sẵn sàng giao)" :
                        "Hàng đặt trước (3-5 ngày)";
                    stockEl.style.color = currentVariant.stock > 0 ? '#27ae60' : '#e67e22';
                }
                if (selectedCondition !== 'new' && usedInfo) {
                    usedInfo.style.display = 'flex';
                    document.getElementById('val-pin').innerText = (currentVariant.battery_health || '9x') +
                        '%';
                    document.getElementById('val-sac').innerText = currentVariant.charging_count || 'Ít';
                } else if (usedInfo) {
                    usedInfo.style.display = 'none';
                }
            } else {
                priceEl.innerText = "Giá: Liên hệ";
                if (stockEl) {
                    stockEl.innerText = "Hàng đặt trước (Liên hệ shop)";
                    stockEl.style.color = "#3498db";
                }
                if (usedInfo) usedInfo.style.display = 'none';
            }
        }

        // Sự kiện click chọn biến thể
        document.querySelectorAll('.ss-pd-v-item').forEach(item => {
            item.addEventListener('click', function() {
                const type = this.getAttribute('data-type');
                this.closest('.m-v-list').querySelectorAll('.ss-pd-v-item').forEach(btn => btn
                    .classList.remove('active'));
                this.classList.add('active');
                if (type === 'condition') selectedCondition = this.getAttribute('data-value');
                if (type === 'size') selectedSize = this.getAttribute('data-value');
                if (type === 'color') selectedColor = this.getAttribute('data-value');
                updateDisplay();
            });
        });

        // --- 4. XỬ LÝ GỬI TIN NHẮN & THỐNG KÊ ---
        if (buyBtn) {
            buyBtn.addEventListener('click', function(e) {
                e.preventDefault();

                if (!selectedCondition || !selectedSize || !selectedColor) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Thông báo',
                        text: 'Vui lòng chọn đầy đủ tùy chọn!',
                        confirmButtonColor: '#0084FF'
                    });
                    return;
                }

                let sizeText = document.querySelector('.ss-pd-v-item.active[data-type="size"]')
                    ?.innerText.trim() || "";
                let colorText = document.querySelector('.ss-pd-v-item.active[data-type="color"]')
                    ?.innerText.trim() || "";
                const conditionLabel = selectedCondition === 'new' ? 'Máy mới 100%' : 'Máy cũ/Like New';
                const finalPrice = currentVariant ? new Intl.NumberFormat('vi-VN').format(currentVariant
                    .price) + 'w' : "Liên hệ";

                // Tạo link Messenger với ref
                const refCode = generateRefCode(currentVariant);
                let message =
                    `Chào Shop, mình muốn tư vấn máy:\n- Sản phẩm: ${phoneName}\n- Tình trạng: ${conditionLabel}\n- Cấu hình: ${sizeText} [${colorText}]\n- Giá: ${finalPrice}\n- Link: ${currentUrl}`;
                const messengerUrl =
                    `https://m.me/${pageId}?ref=${refCode}&text=${encodeURIComponent(message)}`;

                Swal.fire({
                    title: 'Gửi yêu cầu tư vấn',
                    html: `
        <div style="text-align: left; background: #f8f9fa; padding: 15px; border-radius: 10px; border: 1px solid #e9ecef;">
            <p style="margin: 0 0 8px 0;"><strong>Sản phẩm:</strong> {{ $phone->name }}</p>
            <p style="margin: 0 0 8px 0;"><strong>Cấu hình:</strong> ${sizeText} - ${colorText}</p>
            <p style="margin: 0 0 8px 0;"><strong>Tình trạng:</strong> ${selectedCondition == 'new' ? 'Mới 100%' : 'Like New'}</p>
            <p style="margin: 0; color: #0084FF;"><strong>Giá dự kiến:</strong> <span style="font-size: 1.1em; font-weight: bold;">${priceEl.innerText}</span></p>
        </div>
        <p style="margin-top: 15px; font-size: 0.9em; color: #666;">
            <i class="fas fa-info-circle"></i> Shop sẽ tư vấn chi tiết cho bạn qua Messenger ngay!
        </p>
    `,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#0084FF',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fab fa-facebook-messenger"></i> Mở Messenger ngay',
                    cancelButtonText: 'Để sau',
                    showClass: {
                        popup: 'animated fadeInDown faster'
                    },
                    hideClass: {
                        popup: 'animated fadeOutUp faster'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // --- GỬI THỐNG KÊ LÊN SERVER TRƯỚC KHI ĐI ---
                        fetch("{{ route('track.messenger') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                type: 'phone',
                                product_id: "{{ $phone->id }}",
                                variant_id: currentVariant ? currentVariant.id :
                                    null,
                                product_name: "{{ $phone->name }}",
                                product_slug: "{{ $phone->slug }}",
                                variant_info: `${conditionLabel} | ${sizeText} | ${colorText}`,
                                price: currentVariant ? currentVariant.price : 0
                            })
                        });

                        // Điều hướng mở App Messenger
                        window.location.href = messengerUrl;
                    }
                });
            });
        }

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
