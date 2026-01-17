<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Cấu hình chung cho Chart.js
    Chart.defaults.font.family = 'Nunito',
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.color = '#858796';

    // 1. Biểu đồ Cột (Chuyên mục) - Sử dụng Gradient
    var ctxCat = document.getElementById("categoryChart").getContext('2d');
    var gradientBg = ctxCat.createLinearGradient(0, 0, 0, 400);
    gradientBg.addColorStop(0, 'rgba(78, 115, 223, 0.8)');
    gradientBg.addColorStop(1, 'rgba(78, 115, 223, 0.1)');

    var categoryChart = new Chart(ctxCat, {
        type: 'bar',
        data: {
            labels: {!! json_encode($catNames) !!},
            datasets: [{
                label: "Số lượng sản phẩm",
                backgroundColor: gradientBg,
                borderColor: "#4e73df",
                borderWidth: 2,
                borderRadius: 5,
                data: {!! json_encode($catCounts) !!},
                maxBarThickness: 50,
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: "#f8f9fc",
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                }
            }
        }
    });

    // 2. Biểu đồ Tròn (Doanh thu/Đơn hàng) - Thay thế cho nhà mạng
    var ctxRev = document.getElementById("revenueChart").getContext('2d');
    var revenueChart = new Chart(ctxRev, {
        type: 'doughnut',
        data: {
            labels: ["Điện thoại", "Gói cước"],
            datasets: [{
                data: [{{ $phoneMessCount }}, {{ $packageMessCount }}],
                backgroundColor: ['#4e73df', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
                cutout: '75%',
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                }
            }
        }
    });
</script>
