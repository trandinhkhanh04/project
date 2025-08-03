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
    </style>
</head>
<body>

<?php $this->load->view('shipper/layout/header'); ?>
<?php $this->load->view('shipper/layout/sidebar'); ?>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
<?php endif; ?>

<div class="row text-center mb-4">
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border">
            <div class="card-header bg-white text-muted" style="font-weight: 600; font-size: 14px;">
                ĐÃ GIAO
            </div>
            <div class="card-body">
                <h1 class="card-title" style="font-size: 36px; color: #333;"><?= $count_delivered ?></h1>
                <p class="card-text text-muted" style="margin-top: -10px;">Đơn hàng đã giao</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border">
            <div class="card-header bg-white text-muted" style="font-weight: 600; font-size: 14px;">
                ĐANG GIAO
            </div>
            <div class="card-body">
                <h1 class="card-title" style="font-size: 36px; color: #333;"><?= $count_shipping ?></h1>
                <p class="card-text text-muted" style="margin-top: -10px;">Đơn hàng đang giao</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border">
            <div class="card-header bg-white text-muted" style="font-weight: 600; font-size: 14px;">
                ĐÃ HỦY
            </div>
            <div class="card-body">
                <h1 class="card-title" style="font-size: 36px; color: #333;"><?= $count_canceled ?></h1>
                <p class="card-text text-muted" style="margin-top: -10px;">Đơn hàng đã hủy</p>
            </div>
        </div>
    </div>
</div>


<div class="container mt-4">
<div class="dashboard-header text-center mb-4 p-4">
    <h2 class="dashboard-title">📦 Đơn hàng được giao</h2>
    <p class="dashboard-subtitle">Danh sách các đơn hàng bạn đang phụ trách</p>
</div>


    <div class="d-flex justify-content-center mb-3">
    <?php
        $tabs = [
            ''   => 'Tất cả',
            '2'  => 'Đang chờ',
            '3'  => 'Đang giao',
            '4'  => 'Đã giao',
            '5'  => 'Đã hủy',
        ];
    ?>
    <ul class="nav nav-pills">
        <?php foreach ($tabs as $key => $label): ?>
            <li class="nav-item">
                <a class="nav-link <?= ($current_status == $key || ($key === '' && $current_status === null)) ? 'active' : '' ?>"
                   href="<?= base_url('shipper/dashboard?status=' . $key) ?>">
                    <?= $label ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

    <?php if (empty($orders)): ?>
        <div class="alert alert-info text-center shadow-sm">Không có đơn hàng nào.</div>
    <?php else: ?>
        <div class="table-responsive shadow-sm">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Giá tiền</th>
                        <th>Ngày tạo</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order->Order_Code ?></td>
                        <td><?= $order->Customer_Name ?? 'N/A' ?></td>
                        <td><?= $order->Phone ?? 'N/A' ?></td>
                        <td><?= $order->Address ?? 'N/A' ?></td>
                        <td><?= number_format($order->TotalAmount ?? 0, 0, ',', '.') ?> đ</td>
                        <td><?= !empty($order->Date_Order) ? date('d/m/Y H:i', strtotime($order->Date_Order)) : 'N/A' ?></td>
                        <td class="text-center">
                            <?php
                                switch ($order->Order_Status) {
                                    case 1: echo '<span class="badge bg-secondary">Đang chờ</span>'; break;
                                    case 2: echo '<span class="badge bg-warning text-dark">Chuẩn bị hàng</span>'; break;
                                    case 3: echo '<span class="badge bg-info text-dark">Đang giao</span>'; break;
                                    case 4: echo '<span class="badge bg-success">Đã giao</span>'; break;
                                    case 5: echo '<span class="badge bg-danger">Đã hủy</span>'; break;
                                    default: echo '<span class="badge bg-dark">Không rõ</span>'; break;
                                }
                            ?>
                        </td>
                        <td class="text-center">
                           <!-- Đúng -->
<a href="<?= base_url('shipper/orders/' . $order->Order_Code) ?>" class="btn btn-sm btn-outline-primary">
    Xem chi tiết
</a>

                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <!-- <div class="text-end logout-btn">
        <a href="<?= base_url('shipper/logout') ?>" class="btn btn-danger">🚪 Đăng xuất</a>
    </div> -->
</div>

<?php $this->load->view('shipper/layout/footer'); ?>
</body>
</html>
