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


<!-- underline phía trên -->
<div class="row">
  <hr class="nav-underline">
</div>
<!-- test -->
<!-- Thanh điều hướng thương hiệu -->
<?php
  $current_brand_id = $this->uri->segment(2); // Lấy BrandID từ URL segment
?>

<div class="nav-tabs">
  <!-- TẤT CẢ -->
  <a href="<?php echo base_url('/') ?>" class="<?php echo empty($current_brand_id) ? 'active' : ''; ?>">TẤT CẢ</a>

  <!-- Các thương hiệu -->
  <?php foreach ($brand as $bra): ?>
    <a href="<?php echo base_url('thuong-hieu/' . $bra->BrandID . '/' . $bra->Slug) ?>"
       class="<?php echo ($bra->BrandID == $current_brand_id) ? 'active' : ''; ?>">
      <?php echo strtoupper($bra->Name); ?>
    </a>
  <?php endforeach; ?>
</div>

 <!-- danh mục -->
<!-- <div class="nav-tabs">
  <a href="<?php echo base_url('/') ?>" class="active">TẤT CẢ SẢN PHẨM</a>
  <?php foreach ($category as $key => $cate): ?>
    <a href="<?php echo base_url('danh-muc/' . $cate->CategoryID . '/' . $cate->Slug) ?>">
      <?php echo strtoupper($cate->Name) ?>
    </a>
  <?php endforeach; ?>
</div> -->
	<!-- end test -->	





<br><br>
	<!-- <div class="left-sidebar">
		<h2 style="color: brown;">Danh mục</h2>
		<div class="panel-group category-products" id="accordian">
			<?php
			foreach ($category as $key => $cate) {
				?>

				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a href="<?php echo base_url('danh-muc/' . $cate->CategoryID . '/' . $cate->Slug) ?>"><?php echo $cate->Name ?></a>
						</h4>
					</div>
				</div>

			<?php } ?>
		</div>

		<div class="brands_products">
			<h2 style="color: brown;">Thương hiệu</h2>
			<div class="brands-name">
				<?php
				foreach ($brand as $key => $bra) {
					?>

				    <ul class="nav nav-pills nav-stacked">
						<li>
							<a href="<?php echo base_url('thuong-hieu/' . $bra->BrandID . '/' . $bra->Slug) ?>"><?php echo $bra->Name ?></a>
						</li>
					</ul>

				<?php } ?>
			</div>
			
		</div>
<br><br>
	<div class="col">
		<h2 style="color: brown;">Lọc sản phẩm</h2>
						 <div class="row">
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
						<div class="row">
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
					</div> 

	</div>
</div> -->