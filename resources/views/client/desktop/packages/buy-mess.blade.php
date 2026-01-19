<script>
    (function() {
        // --- 1. CẤU HÌNH ---
        const pageUsername = "dienthoaituoiduyen";
        const isIphone = navigator.userAgent.match(/iPhone|iPad|iPod/i);

        document.addEventListener('click', function(e) {
            const buyBtn = e.target.closest('.btn-buy-package');

            if (buyBtn) {
                e.preventDefault();

                // 2. Lấy thông tin từ data attributes
                const packageId = buyBtn.getAttribute('data-id'); // Cần thêm data-id vào nút
                const name = buyBtn.getAttribute('data-name');
                const priceText = buyBtn.getAttribute('data-price');
                const duration = buyBtn.getAttribute('data-duration');
                const carrier = buyBtn.getAttribute('data-carrier');
                const sim = buyBtn.getAttribute('data-sim');
                const currentUrl = window.location.href;

                // Xử lý giá về dạng số để Dashboard cộng dồn (ví dụ "50,000w" -> 50000)
                const priceNumeric = parseFloat(priceText.replace(/[^0-9.]/g, '')) || 0;

                // 3. Tạo mã REF (Để Admin biết khách nhấn từ iPhone hay Android)
                const refCode = `PACK_${isIphone ? 'IP' : 'AD'}_${packageId}`.toUpperCase();

                // 4. Soạn tin nhắn
                let message = `Chào Shop, mình muốn đăng ký gói cước:\n`;
                message += `📦 Gói cước: ${name}\n`;
                message += `💰 Giá: ${priceText}\n`;
                message += `⏳ Thời hạn: ${duration} ngày\n`;
                message += `📶 Nhà mạng: ${carrier}\n`;
                message += `📱 Loại SIM: ${sim}\n`;
                message += `🔗 Link: ${currentUrl}`;

                const messengerUrl =
                    `https://m.me/${pageUsername}?ref=${refCode}&text=${encodeURIComponent(message)}`;

                // 5. Hiển thị thông báo xác nhận
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Xác nhận đăng ký',
                        html: `Bạn đang chọn gói <b>${name}</b>.<br>Hệ thống sẽ mở Messenger để gửi yêu cầu!`,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#0084FF',
                        confirmButtonText: 'Gửi ngay',
                        cancelButtonText: 'Đóng',
                        reverseButtons: isIphone
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // --- GỬI THỐNG KÊ TRƯỚC KHI CHUYỂN HƯỚNG ---
                            sendTracking(packageId, name, priceNumeric, carrier, duration, sim);
                            redirectMessenger(messengerUrl);
                        }
                    });
                } else {
                    sendTracking(packageId, name, priceNumeric, carrier, duration, sim);
                    redirectMessenger(messengerUrl);
                }
            }
        });

        // --- HÀM GỬI THỐNG KÊ VỀ DATABASE ---
        function sendTracking(id, name, price, carrier, duration, sim) {
            fetch("{{ route('track.messenger') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}" // Laravel CSRF Token
                },
                body: JSON.stringify({
                    type: 'package',
                    product_id: id || 0,
                    product_name: name,
                    product_slug: 'package-' + id,
                    variant_info: `Mạng: ${carrier} | Hạn: ${duration} ngày | SIM: ${sim}`,
                    price: price
                })
            }).catch(err => console.error("Tracking Error:", err));
        }

        function redirectMessenger(url) {
            if (isIphone) {
                window.location.href = url;
            } else {
                window.location.assign(url);
            }
        }
    })();
</script>
