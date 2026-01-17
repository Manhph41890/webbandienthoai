<style>
    .st-filter-wrapper {
        border: 1px solid #e3e6f0;
        max-width: fit-content;
    }

    .st-filter-select {
        outline: none;
        color: #4e73df;
        cursor: pointer;
        font-size: 0.9rem;
    }

    .st-filter-btn {
        transition: all 0.3s ease;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .st-filter-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
        /* Đảm bảo các wrapper lọc trông đồng nhất */
    .st-filter-wrapper {
        border: 1px solid #e3e6f0;
        transition: all 0.2s;
    }
    .st-filter-wrapper:hover {
        border-color: #4e73df;
    }
    input[type="date"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
    }
</style>

<!-- Nơi hiển thị thời gian -->

<script>
    function toggleCustomDate() {
        const select = document.getElementById('time_range');
        const customInputs = document.getElementById('custom_date_inputs');

        if (select.value === 'custom') {
            customInputs.setAttribute('style', 'display: flex !important');
        } else {
            customInputs.setAttribute('style', 'display: none !important');
            // Nếu không chọn custom thì tự động submit luôn cho tiện
            document.getElementById('filterForm').submit();
        }
    }

    // Kiểm tra lúc load trang nếu đang ở chế độ custom thì hiển thị ô nhập ngày
    // document.addEventListener('DOMContentLoaded', function() {
    //     if (document.getElementById('time_range').value === 'custom') {
    //         document.getElementById('custom_date_inputs').setAttribute('style', 'display: flex !important');
    //     }
    // });

    function updateClock() {
        const now = new Date();

        // Mảng tên các thứ trong tuần bằng tiếng Việt
        const daysOfWeek = ["Chủ Nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy"];
        const dayName = daysOfWeek[now.getDay()];

        // Định dạng ngày/tháng/năm
        const day = String(now.getDate()).padStart(2, '0');
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Tháng trong JS từ 0-11
        const year = now.getFullYear();

        // Định dạng giờ:phút:giây
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        // Chuỗi hiển thị: Thứ Hai, 15/05/2023 14:30:05
        const timeString = `${dayName}, ${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;

        document.getElementById('clock').innerText = timeString;
    }

    // Chạy hàm ngay lập tức khi trang load
    updateClock();

    // Cập nhật mỗi giây (1000ms)
    setInterval(updateClock, 1000);
</script>
