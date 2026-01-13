<script>
    (function() {
        // --- 1. CẤU HÌNH ---
        const pageUsername = "anhtoan270189";
        const isIphone = navigator.userAgent.match(/iPhone|iPad|iPod/i);

        // Sử dụng Event Delegation để bắt sự kiện click
        document.addEventListener('click', function(e) {
            const buyBtn = e.target.closest('.btn-buy-package');

            if (buyBtn) {
                e.preventDefault();

                // 2. Thu thập dữ liệu từ thuộc tính data
                const packageId = buyBtn.getAttribute('data-id'); // ID để lưu DB
                const name = buyBtn.getAttribute('data-name');
                const priceText = buyBtn.getAttribute('data-price');
                const duration = buyBtn.getAttribute('data-duration');
                const carrier = buyBtn.getAttribute('data-carrier');
                const sim = buyBtn.getAttribute('data-sim');
                const currentUrl = window.location.href;

                // Xử lý giá số để thống kê (ví dụ: "50,000w" -> 50000)
                const priceNumeric = parseFloat(priceText.replace(/[^0-9.]/g, '')) || 0;

                // 3. Tạo mã REF chuyên nghiệp (Tracking trên Inbox Admin)
                const platformPrefix = isIphone ? 'IP_' : 'AD_';
                const refCode = `${platformPrefix}PACK_${packageId}_${name.replace(/\s+/g, '_')}`
                    .toUpperCase();

                // 4. Soạn tin nhắn
                let message = `Chào Shop Toàn Hồng Korea, mình muốn đăng ký gói:\n`;
                message += `📦 Gói cước: ${name}\n`;
                message += `💰 Giá: ${priceText}\n`;
                message += `⏳ Thời hạn: ${duration} ngày\n`;
                message += `📶 Nhà mạng: ${carrier}\n`;
                message += `📱 Loại SIM: ${sim}\n`;
                message += `🔗 Link: ${currentUrl}`;

                const messengerUrl =
                    `https://m.me/${pageUsername}?ref=${refCode}&text=${encodeURIComponent(message)}`;

                // 5. Hiển thị SweetAlert xác nhận theo phong cách Mobile
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Xác nhận đăng ký',
                        html: `Hệ thống sẽ mở Messenger để bạn đăng ký gói <b>${name}</b> (${carrier})`,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#0084FF',
                        confirmButtonText: 'Mở Messenger',
                        cancelButtonText: 'Để sau',
                        reverseButtons: isIphone, // iPhone ưu tiên nút xác nhận bên phải
                        showClass: {
                            popup: 'animated fadeInDown faster'
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // --- GỬI THỐNG KÊ VỀ SERVER ---
                            trackMessengerClick(packageId, name, priceNumeric, carrier, duration,
                                sim);

                            // Chuyển hướng mở App
                            handleRedirect(messengerUrl);
                        }
                    });
                } else {
                    trackMessengerClick(packageId, name, priceNumeric, carrier, duration, sim);
                    handleRedirect(messengerUrl);
                }
            }
        });

        // HÀM GỬI THỐNG KÊ (TRACKING)
        function trackMessengerClick(id, name, price, carrier, duration, sim) {
            fetch("{{ route('track.messenger') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}" // CSRF Token bảo mật của Laravel
                },
                body: JSON.stringify({
                    type: 'package',
                    product_id: id,
                    product_name: name,
                    product_slug: 'package-' + id,
                    variant_info: `Mạng: ${carrier} | Hạn: ${duration} ngày | SIM: ${sim}`,
                    price: price
                })
            }).catch(err => console.error("Tracking Error:", err));
        }

        // HÀM CHUYỂN HƯỚNG TỐI ƯU
        function handleRedirect(url) {
            if (isIphone) {
                // iPhone/Safari: Dùng location.href tốt nhất để nhảy App
                window.location.href = url;
            } else {
                // Android/Chrome: Dùng location.assign để kích hoạt Intent
                window.location.assign(url);
            }
        }
    })();
</script>
