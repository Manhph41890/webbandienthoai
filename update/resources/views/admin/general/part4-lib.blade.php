<style>
    /* Toàn bộ class được đổi tiền tố st- để tránh xung đột */
    .st-card {
        border: none;
        border-radius: 20px;
        transition: transform 0.3s ease;
        position: relative;
        overflow: hidden;
        color: #fff;
        display: flex;
        flex-direction: column;
    }

    .st-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    /* .st-card:hover {
        transform: translateY(-5px);
    } */

    .st-card-body {
        padding: 1.25rem;
        flex: 1;
    }

    /* Gradients */
    .st-grad-1 {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    }

    .st-grad-2 {
        background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
    }

    .st-grad-3 {
        background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);
    }

    .st-grad-4 {
        background: linear-gradient(135deg, #6610f2 0%, #430b9e 100%);
    }

    .st-grad-5 {
        background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
    }

    .st-grad-6 {
        background: linear-gradient(135deg, #fd7e14 0%, #d4660b 100%);
    }

    .st-grad-7 {
        background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);
    }

    .st-grad-8 {
        background: linear-gradient(135deg, #5a5c69 0%, #373840 100%);
    }

    .st-label {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.75rem;
        font-weight: bold;
        text-uppercase: uppercase;
        margin-bottom: 4px;
    }

    .st-value {
        font-size: 1.75rem;
        font-weight: bold;
    }

    .st-value-sm {
        font-size: 1.1rem;
        font-weight: bold;
    }

    .st-text-warn {
        color: #f6c23e !important;
    }

    .st-icon-bg {
        position: absolute;
        right: 15px;
        top: 15px;
        opacity: 0.15;
        font-size: 3.5rem !important;
    }

    .st-detail-btn {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        cursor: pointer;
        transition: 0.3s;
    }

    .st-detail-btn:hover {
        background: rgba(255, 255, 255, 0.35);
    }

    /* Mũi tên xoay */
    .st-chevron {
        transition: transform 0.3s ease;
    }

    .st-detail-btn.active .st-chevron {
        transform: rotate(180deg);
    }

    /* Phần nội dung ẩn */
    .st-collapse-content {
        display: none;
        /* jQuery sẽ điều khiển */
        background: rgba(0, 0, 0, 0.15);
        font-size: 12.5px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .st-padding {
        padding: 15px 20px;
    }

    /* Hiệu ứng nháy online */
    .st-blink {
        animation: st-blink-anim 1s infinite;
    }

    @keyframes st-blink-anim {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.4;
        }

        100% {
            opacity: 1;
        }
    }
</style>

<script>
    $(document).ready(function() {
        // Sử dụng event 'click' tùy chỉnh để không phụ thuộc vào Bootstrap
        $('.st-detail-btn').off('click').on('click', function(e) {
            e.preventDefault();

            const targetSelector = $(this).attr('data-custom-target');
            const $target = $(targetSelector);
            const $btn = $(this);

            // Đóng các tab khác nếu muốn (optional - bỏ comment nếu muốn mở cái này đóng cái kia)
            /*
            $('.st-collapse-content').not($target).slideUp();
            $('.st-detail-btn').not($btn).removeClass('active');
            */

            // Toggle tab hiện tại
            $target.slideToggle(300);
            $btn.toggleClass('active');
        });
    });
</script>
