<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hồ sơ cá nhân</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-card {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .form-label {
            font-weight: 500;
        }
    </style>
</head>
<body>
<?php $this->load->view('shipper/layout/header'); ?>
<?php $this->load->view('shipper/layout/sidebar'); ?>

<div class="container mt-5">
    <div class="col-md-8 mx-auto profile-card">
        <h3 class="mb-4">👤 Hồ sơ cá nhân</h3>

        <?php if ($this->session->flashdata('msg')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('msg') ?></div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('shipper/updateProfile') ?>">
            <div class="mb-3">
                <label class="form-label">Tên</label>
                <input type="text" name="name" value="<?= $shipper->Name ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="phone" value="<?= $shipper->Phone ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <input type="text" name="address" value="<?= $shipper->Address ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="<?= $shipper->Email ?>" class="form-control" required>
            </div>

            <!-- Trường nhập mật khẩu hiện tại -->
            <div class="mb-3">
                <label class="form-label">Mật khẩu hiện tại (nếu muốn đổi mật khẩu)</label>
                <input type="password" name="current_password" class="form-control" >
            </div>

            <!-- Trường nhập mật khẩu mới -->
            <div class="mb-3">
                <label class="form-label">Mật khẩu mới (nếu muốn đổi)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <!-- Trường xác nhận lại mật khẩu -->
            <div class="mb-3">
                <label class="form-label">Nhập lại mật khẩu mới</label>
                <input type="password" name="confirm_password" class="form-control">
            </div>


            <button type="submit" class="btn btn-primary w-100">💾 Lưu thay đổi</button>
        </form>

        <a href="<?= base_url('shipper/dashboard') ?>" class="btn btn-secondary mt-3 w-100">🔙 Quay lại Dashboard</a>
    </div>
</div>
<?php $this->load->view('shipper/layout/footer'); ?>
</body>
</html>
