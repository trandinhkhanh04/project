<?php $this->load->view('admin-layout/component-admin/breadcrumb'); ?>

<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div style="display: flex; justify-content: space-between" class="ibox-title title-table">
                <h4 class="text-primary mb-0">Cập nhật Shipper</h4>
                <a href="<?= base_url('shipperadmin') ?>" class="btn btn-secondary">Quay lại</a>
            </div>
            <div class="ibox-content">
                <form action="<?= base_url('shipperadmin/update/' . $shipper->ShipperID) ?>" method="post">
                    <div class="form-group">
                        <label for="Name">Họ và tên</label>
                        <input type="text" class="form-control" id="Name" name="Name" value="<?= htmlspecialchars($shipper->Name) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Phone">Số điện thoại</label>
                        <input type="text" class="form-control" id="Phone" name="Phone" value="<?= htmlspecialchars($shipper->Phone) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Address">Địa chỉ</label>
                        <input type="text" class="form-control" id="Address" name="Address" value="<?= htmlspecialchars($shipper->Address) ?>">
                    </div>
                    <div class="form-group">
                        <label for="Status">Trạng thái</label>
                        <select name="Status" class="form-control">
                            <option value="1" <?= $shipper->Status == 1 ? 'selected' : '' ?>>Đang hoạt động</option>
                            <option value="0" <?= $shipper->Status == 0 ? 'selected' : '' ?>>Ngưng hoạt động</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="<?= base_url('shipperadmin') ?>" class="btn btn-secondary ml-2">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
