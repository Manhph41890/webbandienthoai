// Hiệu ứng đơn giản khi nhấn nút mua hàng
document.querySelectorAll('.btn-buy').forEach(button => {
    button.addEventListener('click', () => {
        alert('Đã thêm sản phẩm vào giỏ hàng!');
    });
});

// Bạn có thể thêm slider banner hoặc tính năng tìm kiếm ở đây