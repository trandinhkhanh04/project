<?php $this->load->view('admin-layout/component-admin/breadcrumb'); ?>
<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div style="display: flex; justify-content: space-between" class="ibox-title title-table">
                <h2><?= $title ?></h2>
            </div>
            <div class="ibox-content">
                <?php $this->load->view('manage-shipper/component/filter'); ?>
                <br>
                <div class="text-right mb-3">
                    <a href="<?= base_url('shipperadmin/create') ?>" class="btn btn-success">
                        <i class="fa fa-plus"></i> Thêm shipper
                    </a>
                </div>


                <?php $this->load->view('manage-shipper/component/shipperTable'); ?>
            </div>
        </div>
    </div>
</div>
