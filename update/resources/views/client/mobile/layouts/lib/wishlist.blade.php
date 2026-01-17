<style>
    /* Hiệu ứng trái tim khi được thêm */
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

    /* Hiệu ứng nảy số Badge */
    @keyframes badgeBounce {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.5);
            color: #ff4d6d;
        }

        100% {
            transform: scale(1);
        }
    }

    /* Hiệu ứng thu nhỏ và biến mất khi xóa */
    .item-fade-out {
        opacity: 0 !important;
        transform: scale(0.5) !important;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .spc-heart-btn.active i {
        color: #ff4d6d !important;
        animation: heartPop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        font-weight: 900 !important;
    }

    /* Trạng thái đang xử lý (Tránh bấm liên tục) */
    .btn-loading {
        pointer-events: none;
        opacity: 0.6;
    }
</style>

<script>
    document.addEventListener('click', async function(e) {
        // 1. Tìm nút bấm
        const btn = e.target.closest('.spc-heart-btn, .btn-favorite, .wl-remove-btn');
        if (!btn) return;

        e.preventDefault();

        // Ngăn chặn bấm liên tục khi đang xử lý
        if (btn.classList.contains('btn-loading')) return;
        btn.classList.add('btn-loading');

        const id = btn.dataset.id;
        const type = btn.dataset.type;
        const icon = btn.querySelector('i');

        // Tìm phần tử cha (hỗ trợ cả cấu trúc cũ và mới)
        const productItem = btn.closest('.wl-phone-card, .wl-package-item, .product-item');

        try {
            const response = await fetch('{{ route('wishlist.toggle') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id,
                    type
                })
            });

            const data = await response.json();

            if (data.status === 'added') {
                btn.classList.add('active');
                if (icon) {
                    icon.classList.replace('fa-regular', 'fa-solid');
                }
            } else {
                btn.classList.remove('active');
                if (icon) {
                    icon.classList.replace('fa-solid', 'fa-regular');
                }

                // Xử lý riêng nếu đang ở trang Wishlist
                if (productItem && (window.location.pathname.includes('/wishlist') || document
                        .querySelector('.wl-mobile-wrapper'))) {
                    productItem.classList.add('item-fade-out');

                    // Đợi hiệu ứng CSS chạy xong rồi mới xóa Element
                    setTimeout(() => {
                        productItem.remove();

                        // Kiểm tra nếu hết sản phẩm thì hiện giao diện Trống (Không cần Reload)
                        const remainingItems = document.querySelectorAll(
                            '.wl-phone-card, .wl-package-item, .product-item');
                        if (remainingItems.length === 0) {
                            const contentArea = document.querySelector('.wl-content, .container');
                            const emptyState = document.querySelector('.wl-empty-state');

                            if (contentArea) contentArea.style.display = 'none';
                            if (emptyState) {
                                emptyState.style.display = 'block';
                            } else {
                                // Nếu không có sẵn div empty, thì mới reload
                                location.reload();
                            }
                        }
                    }, 400);
                }
            }

            // Cập nhật số lượng trên tất cả Badge đồng bộ
            const badges = document.querySelectorAll(
                '.wishlist-count, .wl-count-badge, .mobile-action-btn .badge');
            badges.forEach(badge => {
                badge.innerText = data.count;
                badge.style.animation = 'none';
                void badge.offsetWidth; // Trigger reflow
                badge.style.animation = 'badgeBounce 0.5s ease';
            });

        } catch (error) {
            console.error('Wishlist Error:', error);
        } finally {
            btn.classList.remove('btn-loading');
        }
    });
</script>
