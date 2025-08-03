<section>
	<div class="container">
		<div class="row">
			<?php $this->load->view('pages/component/sidebar'); ?>

			<!-- <div class="col-sm-9 padding-right"> -->
				<div class="col">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center" style="color: brown;"><?php echo $Name ?></h2>
					<?php
					foreach ($allproductbybrand_pagination as $key => $braPro) {
						?>
						<form action="<?php echo base_url('add-to-cart') ?>" method="POST">
							<!-- <div class="col-sm-3">
								<div class="product-image-wrapper">
									<input type="hidden" value="<?php echo $braPro->ProductID ?>" name="ProductID">
									<input type="hidden" value="1" name="Quantity">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="<?php echo base_url('uploads/product/' . $braPro->Image) ?>"
												alt="<?php echo $braPro->Name ?>" />
											<h2><?php echo number_format($braPro->Selling_price, 0, ',', '.') ?> VND</h2>
											<p><?php echo $braPro->Name ?></p>
											<a href="<?php echo base_url('san-pham/' . $braPro->ProductID . '/' . $braPro->Slug) ?>"
												class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Chi tiết</a>
											<button type="submit" class="btn btn-fefault cart" style="background-color: #808080;">
												<i class="fa fa-shopping-cart"></i>
												Thêm vào giỏ
											</button>
										</div>
									</div>
								</div>
							</div> -->
							<div class="col-sm-3">
  <form action="<?php echo base_url('add-to-cart') ?>" method="POST">
    <input type="hidden" value="<?php echo $braPro->ProductID ?>" name="ProductID">
    <input type="hidden" value="1" name="Quantity">

    <div class="product-image-wrapper">
      <a href="<?php echo base_url('san-pham/' . $braPro->ProductID . '/' . $braPro->Slug) ?>" class="product-link">
        <div class="productinfo text-center">
          <img src="<?php echo base_url('uploads/product/' . $braPro->Image) ?>" alt="<?php echo $braPro->Name ?>" />
          <p class="product-name"><?php echo $braPro->Name ?></p>
        </div>
      </a>

      <div class="product-footer">
        <div class="product-price">
          <?php if (isset($braPro->Promotion) && $braPro->Promotion != 0): 
              $price_no_Promotion = $braPro->Selling_price;
              $Selling_price = $price_no_Promotion * (1 - $braPro->Promotion / 100);
          ?>
              <span class="discounted-price"><?php echo number_format($Selling_price, 0, ',', '.') ?> đ</span>
              <span class="original-price"><?php echo number_format($price_no_Promotion, 0, ',', '.') ?> đ</span>
          <?php else: ?>
              <?php echo number_format($braPro->Selling_price, 0, ',', '.') ?> đ
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
					<?php echo $links ?>
				</div><!--features_items-->


			</div>
		</div>
	</div>
</section>