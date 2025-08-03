<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập Shipper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1c1c1c;
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .row {
            height: 100vh;
        }
        .form-section {
            background-color: #2c2c2c;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-box {
            background-color: #3d3d3d; 
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
        }
        .form-box h3 {
            color: #fff;
            margin-bottom: 25px;
        }
        .form-control {
            border-radius: 10px;
             background-color: #555;
            color: #fff;
            border: none;
        }
        .form-control:focus {
            background-color: #555;
            color: #fff;
        }
        .btn-login {
            background-color: #2575fc;
            color: #fff;
            font-weight: bold;
            border-radius: 10px;
        }
        .btn-login:hover {
            background-color: #1e5bd1;

        }
        .image-section {
            /* background: url('<?= base_url("assets/images/shipper-login.png") ?>') no-repeat center center; */
            background: url('https://cdn-icons-png.flaticon.com/512/1647/1647094.png') no-repeat center center;
            background-size: contain;
            background-color: #1a1a1a;
        }
        @media (max-width: 768px) {
            .image-section {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Ảnh minh họa -->
        <div class="col-md-6 image-section d-none d-md-block"></div>

        <!-- Form đăng nhập -->
        <div class="col-md-6 form-section">
            <div class="form-box">
                <h3 class="text-center">Đăng nhập Shipper</h3>

                <form method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label text-light">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email..." required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-light">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu..." required>
                    </div>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger py-2"><?= $error ?></div>
                    <?php endif; ?>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-login">Đăng nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
