@extends('admin.layouts')

@section('title', 'Admin Dashboard')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6a0dad;
            /* Deep Purple */
            --secondary-color: #8a2be2;
            /* Blue Violet */
            --text-dark: #212529;
            --text-muted: #6c757d;
            --bg-light: #f8f9fa;
            --card-bg: #ffffff;
            --border-radius-lg: 0.8rem;
            --border-radius-md: 0.5rem;
            --box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.08);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        /* General Card Styling */
        .card {
            border: none;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--box-shadow);
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .card-header {
            background-color: var(--card-bg);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: var(--border-radius-lg) var(--border-radius-lg) 0 0;
            padding: 1.25rem 1.5rem;
        }

        .card-header h6 {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Info Cards */
        .info-card .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .info-card .icon-wrapper {
            background-color: rgba(var(--bs-primary-rgb, 106, 13, 173), 0.1);
            color: var(--primary-color);
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .info-card .text-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .info-card .value {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        /* Customizing specific info card colors */
        .info-card.users .icon-wrapper {
            background-color: rgba(106, 13, 173, 0.1);
            color: #6a0dad;
        }

        .info-card.phones .icon-wrapper {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .info-card.brands .icon-wrapper {
            background-color: rgba(23, 162, 184, 0.1);
            color: #17a2b8;
        }

        .info-card.orders .icon-wrapper {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        /* Chart Area */
        .chart-area,
        .chart-bar {
            position: relative;
            height: 300px;
        }

        /* Table Styling */
        .table-responsive {
            border-radius: var(--border-radius-md);
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f2f3f7;
            color: var(--text-dark);
            font-weight: 600;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 1.25rem;
            vertical-align: middle;
        }

        .table tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .badge {
            font-weight: 600;
            padding: 0.4em 0.8em;
            border-radius: var(--border-radius-md);
            font-size: 0.8em;
        }

        /* Custom Badge Colors (adjust based on your Order status names) */
        .badge-pending {
            background-color: #ffc107;
            color: #6d4a00;
        }

        /* Warning yellow */
        .badge-processing {
            background-color: #007bff;
            color: #fff;
        }

        /* Primary blue */
        .badge-delivered {
            background-color: #28a745;
            color: #fff;
        }

        /* Success green */
        .badge-cancelled {
            background-color: #dc3545;
            color: #fff;
        }

        /* Danger red */

        /* Dashboard header */
        .dashboard-header {
            margin-bottom: 2.5rem;
        }

        .dashboard-header h1 {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 2rem;
        }

        .dashboard-header .btn {
            font-weight: 600;
            padding: 0.6rem 1.2rem;
            border-radius: var(--border-radius-md);
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.2s ease;
        }

        .dashboard-header .btn:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between dashboard-header">
            <h1 class="h3 mb-0">Tổng quan Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50 me-1"></i> Xuất báo cáo
            </a>
        </div>

        <!-- Content Row - Info Cards -->
        <div class="row">

            <!-- Total Users Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100 py-2 info-card users">
                    <div class="card-body">
                        <div>
                            <div class="text-label">Tổng số người dùng</div>
                            <div class="value">{{ $totalUsers }}</div>
                        </div>
                        <div class="icon-wrapper">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Phones Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100 py-2 info-card phones">
                    <div class="card-body">
                        <div>
                            <div class="text-label">Tổng số điện thoại</div>
                            <div class="value">{{ $totalPhone }}</div>
                        </div>
                        <div class="icon-wrapper">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Brands Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100 py-2 info-card brands">
                    <div class="card-body">
                        <div>
                            <div class="text-label">Tổng số thương hiệu</div>
                            <div class="value">{{ $totalCategories }}</div>
                        </div>
                        <div class="icon-wrapper">
                            <i class="fas fa-tags"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Orders Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100 py-2 info-card orders">
                    <div class="card-body">
                        <div>
                            <div class="text-label">Đơn hàng đang chờ xử lý</div>
                            <div class="value">{{ $pendingOrders }}</div>
                        </div>
                        <div class="icon-wrapper">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row - Charts & Revenue -->
        <div class="row">

            <!-- Area Chart - Monthly Revenue -->
            <div class="col-xl-8 col-lg-7">
                <div class="card mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0">Doanh thu theo tháng</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="monthlyRevenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Revenue Card -->
            <div class="col-xl-4 col-lg-5">
                <div class="card mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0">Tổng doanh thu</h6>
                    </div>
                    <div class="card-body">
                        <div class="row no-gutters align-items-center mb-3">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Tổng doanh thu đã hoàn thành</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <hr>
                        <p class="text-muted small mb-0">Doanh thu được tính từ các đơn hàng đã được giao thành công.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row - Best Selling Phones (Chart) & Latest Orders -->
        <div class="row">

            <!-- Best Selling Phones Chart -->
            <div class="col-lg-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0">Top Điện thoại bán chạy nhất</h6>
                    </div>
                    <div class="card-body">
                        @if ($bestSellingPhone->isEmpty())
                            <div class="alert alert-info mb-0 text-center">
                                <i class="fas fa-info-circle me-1"></i> Chưa có dữ liệu điện thoại bán chạy.
                            </div>
                        @else
                            <div class="chart-bar">
                                <canvas id="bestSellingPhonesChart"></canvas>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Latest Orders -->
            <div class="col-lg-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0">Đơn hàng mới nhất</h6>
                    </div>
                    <div class="card-body">
                        @if ($latestOrders->isEmpty())
                            <div class="alert alert-info mb-0 text-center">
                                <i class="fas fa-info-circle me-1"></i> Chưa có đơn hàng mới.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã ĐH</th>
                                            <th>Khách hàng</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestOrders as $order)
                                            <tr>
                                                <td>#{{ $order->id }}</td>
                                                <td>{{ $order->user->name ?? 'Khách vãng lai' }}</td>
                                                <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                                                <td>
                                                    <span class="badge badge-{{ strtolower($order->status) }}">
                                                        {{ $order->status }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row - Latest Customers -->
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0">Khách hàng mới nhất</h6>
                    </div>
                    <div class="card-body">
                        @if ($latestCustomers->isEmpty())
                            <div class="alert alert-info mb-0 text-center">
                                <i class="fas fa-info-circle me-1"></i> Chưa có khách hàng mới.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên khách hàng</th>
                                            <th>Email</th>
                                            <th>Ngày đăng ký</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestCustomers as $customer)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->email }}</td>
                                                <td>{{ $customer->created_at->format('d/m/Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <!-- Page level plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-gradient@0.4.0/dist/chartjs-plugin-gradient.min.js"></script>

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Inter',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#6c757d'; // Use Bootstrap's text-muted color

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep, // use '.' for thousands separator in VN
                dec = (typeof dec_point === 'undefined') ? ',' : dec_point, // use ',' for decimal point in VN
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // --- Monthly Revenue Chart ---
        var ctxMonthlyRevenue = document.getElementById("monthlyRevenueChart");
        var monthlyRevenueChart = new Chart(ctxMonthlyRevenue, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: "Doanh thu",
                    lineTension: 0.4, // Make the line smoother
                    backgroundColor: "transparent", // Use gradient plugin for fill
                    borderColor: 'var(--primary-color)',
                    pointRadius: 4,
                    pointBackgroundColor: 'var(--primary-color)',
                    pointBorderColor: '#ffffff',
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: 'var(--secondary-color)',
                    pointHoverBorderColor: 'var(--secondary-color)',
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: @json($chartData),
                    fill: 'start', // Start fill from the line
                    gradient: { // Gradient plugin settings
                        backgroundColor: {
                            axis: 'y',
                            colors: {
                                0: 'rgba(106, 13, 173, 0.4)', // Top color (lighter)
                                1: 'rgba(106, 13, 173, 0.05)' // Bottom color (transparent)
                            }
                        }
                    }
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7,
                            fontColor: 'var(--text-muted)'
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            fontColor: 'var(--text-muted)',
                            callback: function(value, index, values) {
                                return number_format(value) + ' VNĐ';
                            }
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, 0.05)",
                            zeroLineColor: "rgba(0, 0, 0, 0.05)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "#ffffff",
                    bodyFontColor: "var(--text-dark)",
                    titleMarginBottom: 10,
                    titleFontColor: 'var(--primary-color)',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: true,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' VNĐ';
                        },
                        title: function(tooltipItem, chart) {
                            return 'Tháng ' + tooltipItem[0].label; // Customize title to show 'Tháng'
                        }
                    }
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                animation: {
                    duration: 1500,
                    easing: 'easeInOutQuart'
                }
            }
        });

        // --- Best Selling Phones Bar Chart ---
        var ctxBestSelling = document.getElementById("bestSellingPhonesChart");
        var bestSellingPhonesChart = new Chart(ctxBestSelling, {
            type: 'horizontalBar', // Use horizontal bar for better readability with product names
            data: {
                labels: @json($bestSellingPhone->pluck('name')),
                datasets: [{
                    label: "Số lượng bán",
                    backgroundColor: 'var(--primary-color)',
                    hoverBackgroundColor: 'var(--secondary-color)',
                    borderColor: 'var(--primary-color)',
                    borderWidth: 1,
                    data: @json($bestSellingPhone->pluck('sold_count')),
                }]
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontColor: 'var(--text-muted)',
                            callback: function(value, index, values) {
                                if (Math.floor(value) === value) { // Only show integers
                                    return value;
                                }
                            }
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, 0.05)",
                            zeroLineColor: "rgba(0, 0, 0, 0.05)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            fontColor: 'var(--text-dark)'
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "#ffffff",
                    bodyFontColor: "var(--text-dark)",
                    titleFontColor: 'var(--primary-color)',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: true,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ' + number_format(tooltipItem.xLabel) + ' chiếc';
                        }
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeInOutQuart'
                }
            }
        });
    </script>
@endpush
