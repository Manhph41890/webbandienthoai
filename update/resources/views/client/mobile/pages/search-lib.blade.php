<style>
    .btn-buy-package {
        position: relative;
        overflow: hidden;
        /* Để ẩn dải sáng thừa */
        display: inline-flex;
        align-items: center;
        padding: 14px 100px;
        background-color: #ff4757;
        /* Màu đỏ nổi bật */
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        margin-left: 25px;
    }

    /* Hiệu ứng quét sáng */
    .btn-buy-package::after {
        content: "";
        position: absolute;
        top: -50%;
        left: -60%;
        width: 20%;
        height: 200%;
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(30deg);
        transition: 0s;
    }

    .btn-buy-package:hover::after {
        left: 120%;
        transition: 0.6s;
    }

    .btn-buy-package:hover {
        background-color: #ff6b81;
        box-shadow: 0 0 20px rgba(255, 71, 87, 0.5);
    }
</style>
