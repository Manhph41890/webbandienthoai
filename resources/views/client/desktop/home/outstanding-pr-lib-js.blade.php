<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ID Fanpage của bạn
        const PAGE_ID = "61575141059562";

        // Bắt sự kiện click trên toàn bộ container (Event Delegation)
        const productList = document.getElementById('product-list');

        if (productList) {
            productList.addEventListener('click', function(e) {
                // Tìm xem thẻ được click có phải là nút messenger không
                const btn = e.target.closest('.buy-via-messenger');
                if (!btn) return;

                e.preventDefault();

                // Lấy dữ liệu từ data attributes
                const name = btn.dataset.name;
                const price = btn.dataset.price;
                const link = btn.dataset.link;

                // 1. Tạo nội dung tin nhắn
                let message = `Chào Shop, mình muốn mua sản phẩm này:\n`;
                message += `📱 Sản phẩm: ${name}\n`;
                message += `💰 Giá: ${price}\n`;
                message += `🔗 Link: ${window.location.origin + link}`;

                const encodedMessage = encodeURIComponent(message);
                const messengerUrl = `https://m.me/${PAGE_ID}?text=${encodedMessage}`;

                // 2. Hiển thị xác nhận (Dùng SweetAlert2 cho đẹp)
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Mua hàng qua Messenger',
                        html: `Bạn muốn gửi yêu cầu đặt hàng cho:<br><b>${name}</b>`,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#0084FF',
                        confirmButtonText: 'Mở Messenger',
                        cancelButtonText: 'Đóng'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            openMessenger(messengerUrl);
                        }
                    });
                } else {
                    // Nếu không có SweetAlert2 thì mở trực tiếp
                    openMessenger(messengerUrl);
                }
            });
        }

        // Hàm hỗ trợ mở Messenger linh hoạt
        function openMessenger(url) {
            const isIphone = navigator.userAgent.match(/iPhone|iPad|iPod/i);
            if (isIphone) {
                window.location.href = url;
            } else {
                window.open(url, '_blank');
            }
        }
    });
</script>
