<section>
    <div class="container">
        <div class="row">
            <?php $this->load->view('pages/component/sidebar'); ?>
            <div class="col">
                <div class="features_items">
                    <h2 class="title text-center" style="color: brown;">Danh sách sản phẩm giảm giá</h2>
                    <?php
                    foreach ($products_sale as $key => $allProOnSale) {
                        ?>
                        <form action="<?php echo base_url('add-to-cart') ?>" method="POST">
                            <!-- <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <input type="hidden" value="<?php echo $allProOnSale->ProductID ?>" name="ProductID">
                                    <input type="hidden" value="1" name="Quantity">
                                    <div class="single-products">
                                        <div class="productinfo text-center">

                                            //code cũ
                                            <div
                                                class="view-product <?php echo ($allProOnSale->total_remaining == 0) ? 'out-of-stock' : ''; ?>">
                                                <img style="width: 300px; height: 300px"
                                                    src="<?php echo base_url('uploads/product/' . $allProOnSale->Image) ?>"
                                                    alt="<?php echo $allProOnSale->Name ?>" />
                                            </div>
                                            //code cũ
                                            
                                            <img src="<?php echo base_url('uploads/product/' . $allProOnSale->Image) ?>"
                                                alt="<?php echo $allProOnSale->Name ?>" />

                                            <h2>
                                                <?php
                                                // Kiểm tra nếu có giảm giá
                                                if (isset($allProOnSale->Promotion) && $allProOnSale->Promotion != 0) {
                                                    // Tính giá sau giảm
                                                    $price_no_Promotion = $allProOnSale->Selling_price;
                                                    $Selling_price = $allProOnSale->Selling_price * (1 - $allProOnSale->Promotion / 100);
                                                    ?>
                                                    <span style="color: red" class="sale-label">Sale: </span>
                                                    <span
                                                        class="discounted-price"><?php echo number_format($Selling_price, 0, ',', '.') ?>
                                                        VND</span>
                                                    <?php
                                                } else {
                                                    // Nếu không có giảm giá
                                                    echo number_format($allProOnSale->Selling_price, 0, ',', '.') . " VND";
                                                }
                                                ?>
                                            </h2>

                                            <p><?php echo $allProOnSale->Name ?></p>
                                            <a href="<?php echo base_url('san-pham/' . $allProOnSale->ProductID . '/' . $allProOnSale->Slug) ?>"
                                                class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Chi tiết</a>
                                            <button type="submit" class="btn btn-default cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                Thêm vào giỏ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                           
        
                            <div class="col-sm-3">
  <form action="<?php echo base_url('add-to-cart') ?>" method="POST">
    <input type="hidden" value="<?php echo $allProOnSale->ProductID ?>" name="ProductID">
    <input type="hidden" value="1" name="Quantity">

    <div class="product-image-wrapper">
      <a href="<?php echo base_url('san-pham/' . $allProOnSale->ProductID . '/' . $allProOnSale->Slug) ?>" class="product-link">
        <div class="productinfo text-center">
          <img src="<?php echo base_url('uploads/product/' . $allProOnSale->Image) ?>" alt="<?php echo $allProOnSale->Name ?>" />
          <p class="product-name"><?php echo $allProOnSale->Name ?></p>
        </div>
      </a>

      <div class="product-footer">
        <div class="product-price">
          <?php if (isset($allProOnSale->Promotion) && $allProOnSale->Promotion != 0): 
              $price_no_Promotion = $allProOnSale->Selling_price;
              $Selling_price = $price_no_Promotion * (1 - $allProOnSale->Promotion / 100);
          ?>
              <span class="discounted-price"><?php echo number_format($Selling_price, 0, ',', '.') ?> đ</span>
              <span class="original-price"><?php echo number_format($price_no_Promotion, 0, ',', '.') ?> đ</span>
          <?php else: ?>
              <?php echo number_format($allProOnSale->Selling_price, 0, ',', '.') ?> đ
          <?php endif; ?>
        </div>

        <div class="product-icons">
          <button type="submit"><i class="fa fa-shopping-cart"></i></button>
        </div>
      </div>
    </div>
  </form>
</div>


                        </form>
                    <?php } ?>
                </div>
                <?php echo $links; ?>
            </div>
        </div>
    </div>
</section>