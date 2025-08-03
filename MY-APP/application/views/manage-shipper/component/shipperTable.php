<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<table class="table table-striped table-bordered mt20 mb20">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên</th>
            <th scope="col">SĐT</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($shippers as $key => $shipper): ?>
            <tr>
                <td><?= $start + $key + 1 ?></td>
                <td><?= $shipper->Name ?></td>
                <td><?= $shipper->Phone ?></td>
                <td><?= $shipper->Address ?></td>
                <td>
                    <?php if ($shipper->Status == 1): ?>
                        <span class="badge bg-success">Đang hoạt động</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Ngưng hoạt động</span>
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <a href="<?= base_url('shipperadmin/edit/' . $shipper->ShipperID) ?>" class="btn btn-success">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="<?= base_url('shipperadmin/delete/' . $shipper->ShipperID) ?>" 
                        class="btn btn-danger" 
                        onclick="return confirm('Bạn có chắc chắn muốn xóa shipper này không?');">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="text-center">
    <?= $links ?>
</div>
