
<style>
/* CSS Nâng Cấp Giao Diện */
.card-gradient-primary { background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); }
.card-gradient-success { background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%); }
.card-gradient-warning { background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%); }
.card-gradient-info { background: linear-gradient(135deg, #36b9cc 0%, #258391 100%); }

.dashboard-filter-modern {
    transition: all 0.3s ease;
    border: 1px solid #eee;
}
.dashboard-filter-modern:hover {
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.1) !important;
}

.transition-all { transition: all 0.3s ease; }
.transition-all:hover { transform: translateY(-2px); }

.badge-soft-info {
    background-color: #e0f4ff;
    color: #0099ff;
    padding: 5px 12px;
    border-radius: 50px;
}

.btn-light-primary {
    background-color: #f0f3ff;
    color: #4e73df;
    border: none;
}

.rounded-xl { border-radius: 15px !important; }

/* Custom Scrollbar cho bảng */
.table-responsive::-webkit-scrollbar {
    height: 5px;
}
.table-responsive::-webkit-scrollbar-thumb {
    background: #e3e6f0;
    border-radius: 10px;
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        // 1. Biểu đồ Chuyên mục (Bar Chart)
        const ctxCat = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCat, {
            type: 'bar',
            data: {
                labels: {!! json_encode($catNames) !!}, // ['iPhone', 'Samsung', 'Oppo',...]
                datasets: [{
                    label: 'Số lượng sản phẩm',
                    data: {!! json_encode($catCounts) !!},
                    backgroundColor: '#1a222d',
                    borderRadius: 8,
                    barThickness: 30,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { drawBorder: false, color: '#f0f0f0' } },
                    x: { grid: { display: false } }
                }
            }
        });

        // 2. Biểu đồ Nhà mạng (Doughnut Chart)
        const ctxCarrier = document.getElementById('carrierChart').getContext('2d');
        new Chart(ctxCarrier, {
            type: 'doughnut',
            data: {
                labels: ['SK', 'KT', 'LGU+'],
                datasets: [{
                    data: {!! json_encode($carrierData) !!}, // [40, 30, 30]
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: { backgroundColor: "rgb(255,255,255)", bodyFontColor: "#858796", borderColor: '#dddfeb', borderWidth: 1, xPadding: 15, yPadding: 15, displayColors: false, caretPadding: 10 },
                legend: { display: false },
                cutout: '70%',
            }
        });
    });
</script>
@endpush