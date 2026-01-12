<script>
    (function() {
        // --- CẤU HÌNH ---
        const pageUsername = "anhtoan270189"; // USERNAME FANPAGE (Tránh dùng ID số để iPhone ko lỗi)
        const isIphone = navigator.userAgent.match(/iPhone|iPad|iPod/i);

        // Sử dụng Event Delegation để bắt sự kiện click cho tất cả nút MUA NGAY
        document.addEventListener('click', function(e) {
            // Tìm element gần nhất có class .btn-buy-package (xử lý khi click trúng icon <i>)
            const buyBtn = e.target.closest('.btn-buy-package');

            if (buyBtn) {
                e.preventDefault();

                // 1. Thu thập dữ liệu từ thuộc tính data
                const name = buyBtn.getAttribute('data-name');
                const price = buyBtn.getAttribute('data-price');
                const duration = buyBtn.getAttribute('data-duration');
                const carrier = buyBtn.getAttribute('data-carrier');
                const sim = buyBtn.getAttribute('data-sim');
                const currentUrl = window.location.href;

                // 2. Soạn tin nhắn (Tối ưu cho hiển thị Messenger)
                let message = `Chào Shop, mình muốn đăng ký gói cước:\n`;
                message += `📦 Gói cước: ${name}\n`;
                message += `💰 Giá: ${price}\n`;
                message += `⏳ Thời hạn: ${duration} ngày\n`;
                message += `📶 Nhà mạng: ${carrier}\n`;
                message += `📱 Loại SIM: ${sim}\n`;
                message += `🔗 Link: ${currentUrl}`;

                // Mã hóa tin nhắn chuẩn URL
                const encodedMessage = encodeURIComponent(message);
                const messengerUrl = `https://m.me/${pageUsername}?text=${encodedMessage}`;

                // 3. Hiển thị SweetAlert xác nhận
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Xác nhận đăng ký',
                        html: `Bạn đang chọn gói <b>${name}</b>.<br>Hệ thống sẽ mở Messenger để gửi đơn hàng!`,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#0084FF',
                        confirmButtonText: 'Mở Messenger',
                        cancelButtonText: 'Để sau',
                        showClass: {
                            popup: ''
                        }, // Tắt hiệu ứng hiện để mượt hơn trên mobile
                        hideClass: {
                            popup: ''
                        } // Tắt hiệu ứng ẩn
                    }).then((result) => {
                        if (result.isConfirmed) {
                            handleRedirect(messengerUrl);
                        }
                    });
                } else {
                    // Nếu trang không có SweetAlert thì chuyển hướng trực tiếp
                    handleRedirect(messengerUrl);
                }
            }
        });

        // Hàm chuyển hướng tối ưu cho từng OS
        function handleRedirect(url) {
            if (isIphone) {
                // iPhone/Safari: Dùng location.href để kích hoạt Deep Link vào App Messenger tốt nhất
                window.location.href = url;
            } else {
                // Android/Desktop: Dùng window.open để mở tab mới
                window.open(url, '_blank');
            }
        }
    })();
</script>
