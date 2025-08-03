<style>
  body {
    font-family: 'Helvetica Neue', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #fff;
    text-align: center;
  }

  .nav-tabs {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 40px;
    margin-top: 20px;
    font-size: 18px;
    font-weight: bold;
  }

  .nav-tabs a {
    text-decoration: none;
    color: #555;
    transition: color 0.3s;
  }

  .nav-tabs a:hover,
  .nav-tabs a.active {
    color: black;
    border-bottom: 1px solid black;
    padding-bottom: 5px;
  }

  hr.nav-underline {
    width: 80px;
    margin: 10px auto;
    border: 0.5px solid #ccc;
  }
  /* gd bra, cat */
  .product-image-wrapper {
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    padding: 15px;
    margin-bottom: 30px;
    transition: transform 0.2s;
    height: 100%;
    position: relative;
  }

  .product-image-wrapper:hover {
    transform: translateY(-5px);
  }

  .productinfo img {
    max-height: 180px;
    object-fit: contain;
    margin-bottom: 10px;
  }

  .product-name {
    font-weight: bold;
    font-size: 15px;
    text-align: center;
    margin: 5px 0;
    color: #000;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }

  .product-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
  }

  .product-price {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #b20000;
    font-weight: bold;
    font-size: 15px;
  }

  .original-price {
    color: #999;
    font-size: 13px;
    text-decoration: line-through;
    font-weight: normal;
  }

  .product-icons button {
    border: none;
    background: none;
    color: #555;
    font-size: 18px;
    cursor: pointer;
    padding: 0;
  }

  .product-icons i:hover {
    color: #000;
  }

  .product-link {
    color: inherit;
    text-decoration: none;
    display: block;
  }
/* thanh loc */
/* Nút mở modal lọc */
#btn-open-filter {
  margin-left: 0;
  display: block;
  margin-bottom: 15px;
}

/* Modal nền */
.filter-modal {
  display: none;
  position: fixed;
  z-index: 9999;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.4);
}

/* Nội dung hộp lọc */
.filter-content {
  background: #fff;
  width: 90%;
  max-width: 720px;
  margin: 60px auto;
  padding: 30px 20px 40px;
  border-radius: 12px;
  position: relative;
  box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}

/* Nút đóng modal */
.close-filter {
  position: absolute;
  top: 10px;
  right: 20px;
  font-size: 26px;
  cursor: pointer;
  color: #888;
  transition: color 0.2s ease;
}

.close-filter:hover {
  color: #333;
}

/* Form lọc theo */
.form-group label {
  font-weight: 600;
  margin-bottom: 5px;
  display: block;
}

.form-control.select-filter {
  padding: 8px;
  border-radius: 6px;
  border: 1px solid #ccc;
}

/* Nút lọc theo giá */
.d-flex.gap-2 {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 10px;
}

.d-flex.gap-2 a.btn {
  border-radius: 8px;
  padding: 6px 12px;
  transition: background-color 0.2s ease;
}

.d-flex.gap-2 a.btn:hover {
  background-color: #e9ecef;
}
</style>

<section>
    <div class="container">
        <div class="row">
            
            <div class="col">
                <div class="features_items">
                    <h2 class="title text-center" style="color: brown;">Kết quả tìm kiếm bằng hình ảnh</h2>

                    <?php if (!empty($results)): ?>
                         <?php foreach ($results as $product): ?>
                            <div class="col-sm-3">
                                <form action="<?= base_url('add-to-cart') ?>" method="POST">
                                    <input type="hidden" name="ProductID" value="<?= $product['ProductID']; ?>">
                                    <input type="hidden" name="Quantity" value="1">

                                    <div class="product-image-wrapper">
                                        <a href="<?= base_url('san-pham/' . $product['ProductID'] . '/' . $product['Slug']) ?>" class="product-link">
                                            <div class="productinfo text-center">
                                                <img src="<?= base_url('uploads/product/' . $product['Image']); ?>" alt="<?= $product['Name']; ?>" />
                                                <p class="product-name"><?= $product['Name']; ?></p>
                                            </div>
                                        </a>

                                        <div class="product-footer">
                                            <div class="product-price">
                                                <?php if (!empty($product['Promotion']) && $product['Promotion'] != 0): 
                                                    $price = $product['Selling_price'];
                                                    $discounted = $price * (1 - $product['Promotion'] / 100);
                                                ?>
                                                    <span class="discounted-price"><?= number_format($discounted, 0, ',', '.'); ?> đ</span>
                                                    <span class="original-price"><?= number_format($price, 0, ',', '.'); ?> đ</span>
                                                <?php else: ?>
                                                    <?= number_format($product['Selling_price'], 0, ',', '.'); ?> đ
                                                <?php endif; ?>
                                            </div>

                                            <div class="product-icons">
                                                <button type="submit"><i class="fa fa-shopping-cart"></i></button>
                                            </div>

                                            

                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php endforeach; ?> 
                        
                    <?php else: ?>
                        <p class="text-center text-muted">Không tìm thấy sản phẩm nào phù hợp với ảnh đã chọn.</p>
                    <?php endif; ?>

                    <div class="text-center mt-4">
                        <a href="<?= base_url('searchbyimage'); ?>" class="btn btn-secondary">🔙 Tìm ảnh khác</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
