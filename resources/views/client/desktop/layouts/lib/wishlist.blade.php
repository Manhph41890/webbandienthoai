<style>
    .spc-heart-btn.active i {
        color: #ff4757;
        animation: heartPop 0.3s linear;
    }

    @keyframes heartPop {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.4);
        }

        100% {
            transform: scale(1);
        }
    }
</style>

<script>
    document.addEventListener('click', function(e) {
        // Tìm phần tử gần nhất có class là nút yêu thích (trái tim hoặc dấu X)
        const btn = e.target.closest('.spc-heart-btn, .btn-favorite');
        if (!btn) return;

        e.preventDefault();
        const id = btn.dataset.id;
        const type = btn.dataset.type;
        const icon = btn.querySelector('i');

        // Hiệu ứng mờ dần khi nhấn xóa (tăng trải nghiệm người dùng)
        const productItem = btn.closest('.product-item');
        if (window.location.pathname.includes('/wishlist') && productItem) {
            productItem.style.opacity = '0.5';
        }

        fetch('{{ route('wishlist.toggle') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id,
                    type
                })
            })
            .then(res => res.json())
            .then(data => {
                // 1. Cập nhật icon nếu là nút trái tim
                if (data.status === 'added') {
                    btn.classList.add('active');
                    if (icon) icon.classList.replace('fa-regular', 'fa-solid');
                } else {
                    btn.classList.remove('active');
                    if (icon) icon.classList.replace('fa-solid', 'fa-regular');

                    // 2. Xử lý xóa phần tử nếu đang ở trang danh sách yêu thích
                    if (window.location.pathname.includes('/wishlist') && productItem) {
                        productItem.style.transform = 'scale(0.8)';
                        productItem.style.transition = '0.3s';
                        setTimeout(() => {
                            productItem.remove();

                            // Kiểm tra nếu không còn sản phẩm nào thì reload để hiện thông báo "Trống"
                            const remainingItems = document.querySelectorAll('.product-item');
                            if (remainingItems.length === 0) {
                                location.reload();
                            }
                        }, 300);
                    }
                }

                // 3. Cập nhật số lượng trên icon menu cho toàn web
                const badges = document.querySelectorAll('.wishlist-count');
                badges.forEach(badge => {
                    badge.innerText = data.count;
                    // Hiệu ứng nảy số badge
                    badge.style.transform = 'scale(1.3)';
                    setTimeout(() => badge.style.transform = 'scale(1)', 200);
                });
            })
            .catch(err => {
                if (productItem) productItem.style.opacity = '1';
                console.error('Lỗi:', err);
            });
    });
</script>
