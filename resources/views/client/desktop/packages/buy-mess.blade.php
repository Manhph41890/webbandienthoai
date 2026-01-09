<script>
(function() {
    // --- CẤU HÌNH ---
    const pageUsername = "anhtoan270189"; // Username Fanpage của bạn
    const isIphone = navigator.userAgent.match(/iPhone|iPad|iPod/i);

    // Lắng nghe sự kiện click trên toàn trang
    document.addEventListener('click', function(e) {
        // Tìm xem phần tử bị click có phải nút MUA NGAY không
        const buyBtn = e.target.closest('.btn-buy-package');
        
        if (buyBtn) {
            e.preventDefault();

            // 1. Lấy thông tin từ thuộc tính data của nút
            const name = buyBtn.getAttribute('data-name');
            const price = buyBtn.getAttribute('data-price');
            const duration = buyBtn.getAttribute('data-duration');
            const carrier = buyBtn.getAttribute('data-carrier');
            const sim = buyBtn.getAttribute('data-sim');
            const currentUrl = window.location.href;

            // 2. Tạo nội dung tin nhắn
            let message = `Chào Shop, mình muốn đăng ký gói cước:\n`;
            message += `📦 Gói cước: ${name}\n`;
            message += `💰 Giá: ${price}\n`;
            message += `⏳ Thời hạn: ${duration} ngày\n`;
            message += `📶 Nhà mạng: ${carrier}\n`;
            message += `📱 Loại SIM: ${sim}\n`;
            message += `🔗 Link: ${currentUrl}`;

            const encodedMessage = encodeURIComponent(message);
            
            // Link Messenger (Dùng Username cho iPhone để tránh lỗi Guest Session)
            const messengerUrl = `https://m.me/${pageUsername}?text=${encodedMessage}`;

            // 3. Hiển thị thông báo xác nhận (SweetAlert2)
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Xác nhận đăng ký',
                    html: `Bạn đang chọn gói <b>${name}</b>.<br>Hệ thống sẽ mở Messenger để gửi yêu cầu!`,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#0084FF',
                    confirmButtonText: 'Gửi ngay',
                    cancelButtonText: 'Đóng',
                    showClass: { popup: '' }, // Tắt hiệu ứng để mượt trên mobile
                    hideClass: { popup: '' }
                }).then((result) => {
                    if (result.isConfirmed) {
                        redirectMessenger(messengerUrl);
                    }
                });
            } else {
                // Nếu không có SweetAlert thì chuyển hướng luôn
                redirectMessenger(messengerUrl);
            }
        }
    });

    // Hàm chuyển hướng tối ưu cho từng nền tảng
    function redirectMessenger(url) {
        if (isIphone) {
            // iPhone ưu tiên href để nhảy thẳng vào App
            window.location.href = url;
        } else {
            // Android xử lý tốt hơn với assign hoặc mở tab mới nếu cần
            window.location.assign(url);
        }
    }
})();
</script>