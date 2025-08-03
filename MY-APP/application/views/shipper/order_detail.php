<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php $this->load->view('shipper/layout/header'); ?>
<?php $this->load->view('shipper/layout/sidebar'); ?>

<?php
$status_labels = [
    1 => 'Đơn hàng đang được xử lý',
    2 => 'Đang chuẩn bị hàng',
    3 => 'Đang giao',
    4 => 'Giao hàng thành công',
    5 => 'Hủy đơn'
];

$status_text = isset($status_labels[$order->Order_Status]) ? $status_labels[$order->Order_Status] : 'Chưa xác định';
?>

<div class="container mt-5">
    <h3>Chi tiết đơn hàng: <?= $order->Order_Code ?></h3>
    <p><strong>Khách hàng:</strong> <?= $order->Customer_Name ?></p>
    <p><strong>SĐT:</strong> <?= $order->Phone ?></p>
    <p><strong>Địa chỉ:</strong> <?= $order->Address ?></p>
    <p><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($order->Date_Order)) ?></p>
    <p><strong>Giá tiền:</strong> <?= number_format($order->TotalAmount, 0, ',', '.') ?> đ</p>
    <p><strong>Trạng thái:</strong> <?= $status_text ?></p>

    <?php if ($order->Order_Status == 3): ?>
        <form method="post" action="<?= base_url('shipper/confirm_delivery') ?>">
            <input type="hidden" name="OrderID" value="<?= $order->OrderID ?>">
            <button type="submit" name="status" value="4" class="btn btn-success">✅ Đã giao</button>
            <button type="submit" name="status" value="5" class="btn btn-danger">❌ Không giao được</button>
        </form>
    <?php else: ?>
        <div class="alert alert-info mt-3">Đơn hàng đã hoàn tất hoặc hủy.</div>
    <?php endif; ?>

    <a href="<?= base_url('shipper/dashboard') ?>" class="btn btn-secondary mt-3">🔙 Quay lại</a>
</div>
<?php $this->load->view('shipper/layout/footer'); ?>
</body>
</html>
