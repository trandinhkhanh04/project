<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Shipper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
        .dashboard-header {
            background-color: #fdfdfd;
            border: 1px solid #e3e6ea;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        .dashboard-title {
            font-size: 22px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .dashboard-subtitle {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 0;
        }

        .table th, .table td {
            vertical-align: middle;
        }
        .btn-primary {
            background-color: #0d6efd;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
        .logout-btn {
            margin-top: 20px;
        }

        /* gd thong ke */
        .card-summary {
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        .card-summary h6 {
            font-size: 14px;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .card-summary .value {
            font-size: 32px;
            font-weight: bold;
            color: #333;
        }
        .card-summary .label {
            font-size: 14px;
            color: #777;
        }

    </style>
</head>
<body>
<?php $this->load->view('shipper/layout/header'); ?>
<?php $this->load->view('shipper/layout/sidebar'); ?>

<h3>📦 Thống kê đơn hàng</h3>
<div class="row">
    <div class="col-md-3">
        <div class="card-summary">
            <h6>Đang giao</h6>
            <div class="value"><?= $delivering ?></div>
            <div class="label">Đơn hàng đang giao</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-summary">
            <h6>Đã giao</h6>
            <div class="value"><?= $delivered ?></div>
            <div class="label">Đơn hàng đã giao</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-summary">
            <h6>Đã hủy</h6>
            <div class="value"><?= $canceled ?></div>
            <div class="label">Đơn hàng đã hủy</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-summary">
            <h6>Tổng tiền</h6>
            <div class="value"><?= number_format($total_money) ?>₫</div>
            <div class="label">Tổng tiền đã giao</div>
        </div>
    </div>
</div>

<hr>
<h4>📈 Biểu đồ số đơn hàng theo ngày</h4>

<!-- Bọc canvas bằng div để kiểm soát kích thước -->
<div style="max-width: 100%; width: 100%; height: 300px;">
    <canvas id="ordersChart" style="width:100%; height:100%;"></canvas>
</div>

<?php $this->load->view('shipper/layout/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const chartData = <?= json_encode($chart_data) ?>;
    const labels = chartData.map(item => item.order_date);
    const data = chartData.map(item => item.total);

    const ctx = document.getElementById('ordersChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Đơn hàng theo ngày',
                data: data,
                backgroundColor: 'rgba(75,192,192,0.2)',
                borderColor: 'rgba(75,192,192,1)',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            display: true,
            labels: {
                font: {
                    size: 14
                }
            }
        }
    },
    scales: {
        x: {
            ticks: {
                callback: function(value, index, values) {
                    // Hiển thị nhãn ngày bình thường
                    return labels[index];
                },
                stepSize: 1,
                font: {
                    size: 12
                }
            }
        },
        y: {
            beginAtZero: true,
            ticks: {
                stepSize: 1, // Đảm bảo hiển thị số nguyên
                precision: 0, // Không có số thập phân
                font: {
                    size: 12
                }
            }
        }
    }
}

    });
</script>

</body>
</html>
