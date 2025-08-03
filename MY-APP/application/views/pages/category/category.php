<section>
	<div class="container">
		<div class="row">
			<?php $this->load->view('pages/component/sidebar'); ?>
<!-- loc sp -->
<!-- Nút mở hộp lọc -->
<button id="btn-open-filter" class="btn btn-light "style="margin-left: 0; display: block;">
  <i class="fas fa-filter"></i> Lọc
</button>

<!-- Modal lọc sản phẩm -->
<div id="filter-modal" class="filter-modal">
  <div class="filter-content">
    <!-- Nút đóng -->
    <span class="close-filter">&times;</span>

    <!-- Tiêu đề -->
    <h2 style="color: brown;">Lọc sản phẩm</h2>

    <!-- Hộp lọc theo -->
    <div class="row mb-3">
      <div class="form-group">
        <h2><label for="select-filter">Lọc theo</label></h2>
        <select id="select-filter" class="form-control select-filter" onchange="location = this.value;">
          <option value="0">---Lọc theo---</option>
          <option value="?kytu=asc">Ký tự A-Z</option>
          <option value="?kytu=desc">Ký tự Z-A</option>
          <option value="?gia=asc">Giá tăng dần</option>
          <option value="?gia=desc">Giá giảm dần</option>
        </select>
      </div>
    </div>

    <!-- Phần lọc giá -->
<h2>Giá</h2>
                <div class="d-flex flex-wrap gap-2">
                    <a href="?from=0&to=2000000" class="btn btn-outline-secondary btn-sm">Dưới 2 triệu</a>
                    <a href="?from=2000000&to=4000000" class="btn btn-outline-secondary btn-sm">Từ 2 - 4 triệu</a>
                    <a href="?from=4000000&to=7000000" class="btn btn-outline-secondary btn-sm">Từ 4 - 6 triệu</a>

                </div>
  </div>
</div>
 <br><br>
			<!-- <div class="col-sm-9 padding-right"> -->
				<div class="col">
				<div class="features_items"><!--features_items-->
					<!-- <div class="row">
						 <div class="col-md-3">
							<div class="form-group">
								<label for="exampleFormControlSelect1">Lọc theo</label>
								<select id="select-filter" class="form-control select-filter">
									<option value="0">---Lọc theo---</option>
									<option value="?kytu=asc">Ký tự A-Z</option>
									<option value="?kytu=desc">Ký tự Z-A</option>
									<option value="?gia=asc">Giá tăng dần</option>
									<option value="?gia=desc">Giá giảm dần</option>
								</select>
							</div>
						</div>
						<div class="col-md-7">
							<form method="GET">
								<p>
									<label for="amount">Price range:</label>
									<input type="text" id="amount" readonly=""
										style="border:0; color:#f6931f; font-weight:bold;">
									<input type="hidden" class="price_from" name="from">
									<input type="hidden" class="price_to" name="to">
									<input type="submit" class="btn btn-primary filter-price" value="Lọc giá sản phẩm">
								</p>

								<div id="slider-range"></div>
							</form>

						</div> 
					</div>  -->
				

					<h2 class="title text-center" style="color: brown;"><?php echo $Name ?></h2>
					<?php
					foreach ($allproductbycate_pagination as $key => $catePro) {
						?>
						<form action="<?php echo base_url('add-to-cart') ?>" method="POST">
							<!-- <div class="col-sm-3">
								<div class="product-image-wrapper">
									<input type="hidden" value="<?php echo $catePro->ProductID ?>" name="ProductID">
									<input type="hidden" value="1" name="Quantity">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="<?php echo base_url('uploads/product/' . $catePro->Image) ?>"
												alt="<?php echo $catePro->Name ?>" />
											<h2><?php echo number_format($catePro->Selling_price, 0, ',', '.') ?> VND</h2>
											<p><?php echo $catePro->Name ?></p>
											<a href="<?php echo base_url('san-pham/' . $catePro->ProductID . '/' . $catePro->Slug) ?>"
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
    <input type="hidden" value="<?php echo $catePro->ProductID ?>" name="ProductID">
    <input type="hidden" value="1" name="Quantity">

    <div class="product-image-wrapper">
      <a href="<?php echo base_url('san-pham/' . $catePro->ProductID . '/' . $catePro->Slug) ?>" class="product-link">
        <div class="productinfo text-center">
          <img src="<?php echo base_url('uploads/product/' . $catePro->Image) ?>" alt="<?php echo $catePro->Name ?>" />
          <p class="product-name"><?php echo $catePro->Name ?></p>
        </div>
      </a>

      <div class="product-footer">
        <div class="product-price">
          <?php if (isset($catePro->Promotion) && $catePro->Promotion != 0): 
              $price_no_Promotion = $catePro->Selling_price;
              $Selling_price = $price_no_Promotion * (1 - $catePro->Promotion / 100);
          ?>
              <span class="discounted-price"><?php echo number_format($Selling_price, 0, ',', '.') ?> đ</span>
              <span class="original-price"><?php echo number_format($price_no_Promotion, 0, ',', '.') ?> đ</span>
          <?php else: ?>
              <?php echo number_format($catePro->Selling_price, 0, ',', '.') ?> đ
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
<!-- khung loc sp -->
<script>
	
  const btnOpen = document.getElementById("btn-open-filter");
  const modal = document.getElementById("filter-modal");
  const closeBtn = document.querySelector(".close-filter");

  btnOpen.onclick = () => modal.style.display = "block";
  closeBtn.onclick = () => modal.style.display = "none";

  window.onclick = (e) => {
    if (e.target === modal) modal.style.display = "none";
  };
  
</script>




