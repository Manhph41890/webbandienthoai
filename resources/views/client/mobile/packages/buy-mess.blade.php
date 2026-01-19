<script>
    (function() {
        // --- 1. CẤU HÌNH ---
        const pageUsername = "dienthoaituoiduyen";
        const isIphone = navigator.userAgent.match(/iPhone|iPad|iPod/i);

        document.addEventListener('click', function(e) {
            const buyBtn = e.target.closest('.btn-buy-package');

            if (buyBtn) {
                e.preventDefault();

                // 2. Thu thập dữ liệu từ thuộc tính data
                const packageId = buyBtn.getAttribute('data-id'); // QUAN TRỌNG: Cần có data-id trong HTML
                const name = buyBtn.getAttribute('data-name');
                const priceText = buyBtn.getAttribute('data-price');
                const duration = buyBtn.getAttribute('data-duration');
                const carrier = buyBtn.getAttribute('data-carrier');
                const sim = buyBtn.getAttribute('data-sim');
                const currentUrl = window.location.href;

                // Xử lý giá về dạng số để Dashboard cộng dồn doanh thu (ví dụ "50,000w" -> 50000)
                const priceNumeric = parseFloat(priceText.replace(/[^0-9.]/g, '')) || 0;

                // 3. Tạo mã REF để Admin biết khách đến từ thiết bị nào & gói nào
                const platform = isIphone ? 'IPHONE' : 'ANDROID';
                const refCode = `M_PACK_${platform}_${packageId}`.toUpperCase();

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

                // 5. Hiển thị SweetAlert xác nhận
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
                            popup: ''
                        },
                        hideClass: {
                            popup: ''
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // --- GỬI THỐNG KÊ LÊN SERVER ---
                            sendTrackingData(packageId, name, priceNumeric, carrier, duration, sim);

                            // Chuyển hướng mở Messenger
                            handleRedirect(messengerUrl);
                        }
                    });
                } else {
                    sendTrackingData(packageId, name, priceNumeric, carrier, duration, sim);
                    handleRedirect(messengerUrl);
                }
            }
        });

        // HÀM GỬI DỮ LIỆU THỐNG KÊ (TRACKING)
        function sendTrackingData(id, name, price, carrier, duration, sim) {
            fetch("{{ route('track.messenger') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}" // Laravel bảo mật
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

        // Hàm chuyển hướng tối ưu cho từng OS
        function handleRedirect(url) {
            if (isIphone) {
                // iPhone/Safari: Dùng location.href để kích hoạt Deep Link vào App Messenger tốt nhất
                window.location.href = url;
            } else {
                // Android/Chrome: Dùng assign để kích hoạt Intent tốt hơn window.open
                window.location.assign(url);
            }
        }
    })();
</script>
