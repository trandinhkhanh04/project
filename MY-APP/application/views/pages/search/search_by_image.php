<div class="container">
    <h2>Tìm kiếm bằng ảnh</h2>
    <form action="<?= base_url('search/search_by_image') ?>" method="POST" enctype="multipart/form-data">
        <input type="file" name="query_image" accept="image/*" required>
        <button type="submit" class="btn btn-success">Tìm kiếm</button>
    </form>

    <?php if (!empty($results)) : ?>
        <h3>Kết quả:</h3>
        <div class="row">
            <?php foreach ($results as $img) : ?>
                <div class="col-md-3">
                    <img src="<?= base_url('uploads/product/' . $img) ?>" class="img-thumbnail" style="width:100%">
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
