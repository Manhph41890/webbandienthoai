document.addEventListener('click', function (event) {
    const dropdown = document.querySelector('.user-dropdown-content');
    const trigger = document.querySelector('.dropdown-trigger');

    if (dropdown && trigger) {
        if (!trigger.contains(event.target) && !dropdown.contains(event.target)) {
            // Logic đóng menu nếu dùng class 'active' thay vì hover
        }
    }
});