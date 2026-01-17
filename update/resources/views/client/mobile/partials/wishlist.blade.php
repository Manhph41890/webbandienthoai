<a href="{{ route('wishlist.index') }}" class="wishlist-btn" style="margin-top: 9px">
    <i class="fa-regular fa-heart" style=""></i>
    <span class="wishlist-count">{{ $globalWishlistCount }}</span>
</a>

<style>
    @keyframes heartbeat {
    0% { transform: scale(1); }
    15% { transform: scale(1.3); }
    30% { transform: scale(1); }
    45% { transform: scale(1.15); }
    60% { transform: scale(1); }
}

.wishlist-btn:hover i {
    animation: heartbeat 0.8s infinite;
    font-weight: 900; /* Chuyển sang font-solid nếu dùng FontAwesome */
}
    .wishlist-btn {
    position: relative;
    text-decoration: none;
    font-size: 24px;
    color: #fff !important;
    transition: all 0.3s ease;
    display: inline-block;
}

/* Hiệu ứng đổi màu và phóng to nhẹ khi hover */
.wishlist-btn:hover {
    color: #ff4757 !important;
    transform: scale(1.1);
}

/* Badge số lượng sản phẩm */
.wishlist-count {
    position: absolute;
    top: -5px;
    right: -10px;
    background-color: #1E293C ;
    color: rgb(255, 255, 255);
    font-size: 10px;
    font-weight: bold;
    padding: 2px 6px;
    border-radius: 50%;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
</style>
