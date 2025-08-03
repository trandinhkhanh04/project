<!-- <div class="container mt-5 mb-5">
    <h3 class="text-center mb-4">Tìm kiếm sản phẩm bằng hình ảnh</h3>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <form action="<?= base_url('searchbyimage/search'); ?>" method="post" enctype="multipart/form-data" class="text-center">
        <div class="form-group">
            <input type="file" name="image" accept="image/*" required class="form-control-file mb-3" style="display: inline-block;">
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i> Tìm kiếm
        </button>
    </form>
</div> -->

<div class="container mt-5 mb-5"> 
    <h3 class="text-center mb-4">Tìm kiếm sản phẩm bằng hình ảnh</h3>

    <form action="<?= base_url('searchbyimage/search'); ?>" method="post" enctype="multipart/form-data" class="text-center">
        <div class="form-group">
            <input type="file" name="image" accept="image/*" required class="form-control-file mb-3" style="display: inline-block;">
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i> Tìm kiếm
        </button>
    </form>
</div>

