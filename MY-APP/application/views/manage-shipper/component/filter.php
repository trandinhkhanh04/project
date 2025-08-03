<form id="filterForm" action="" method="get" class="mt20">
    <div class="filter-wapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div class="perpage">
                <select name="perpage" class="form-control input-sm perpage filter mr10 setupSelect2">
                    <?php for ($i = 10; $i <= 100; $i += 10): ?>
                        <option <?= ($perpage == $i) ? 'selected' : '' ?> value="<?= $i ?>"><?= $i ?> bản ghi</option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    <div class="mr20">
                        <select name="status" class="form-control setupSelect2">
                            <option value="">Tất cả trạng thái</option>
                            <option value="1" <?= ($status === '1') ? 'selected' : '' ?>>Đang hoạt động</option>
                            <option value="0" <?= ($status === '0') ? 'selected' : '' ?>>Ngưng hoạt động</option>
                        </select>
                    </div>
                    <div class="uk-search uk-flex uk-flex-middle">
                        <div class="input-group">
                            <input style="width: 250px" type="text" name="keyword" value="<?= htmlspecialchars($filter['keyword'] ?? '') ?>"
                                   placeholder="Tên / SĐT" class="form-control ml20">
                            <span class="input-group-btn">
                                <button style="border-radius: 0 5px 5px 0;" type="submit" class="btn btn-primary mb0 btn-sm">
                                    Tìm kiếm
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
