<section>
	<div class="container">
		<div class="row">
			<?php $this->load->view('pages/component/sidebar'); ?>

			<div class="col">

				<?php
				if (!empty($product_details)) {
					$pro_det = $product_details;
				?>
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product <?php echo ($pro_det->total_remaining == 0) ? 'out-of-stock' : ''; ?>">
								<img style="width: 300px; height: 300px"
									src="<?php echo base_url('uploads/product/' . $pro_det->Image) ?>"
									alt="<?php echo $pro_det->Name ?>" />
							</div>
						</div>


						<form action="<?php echo base_url('add-to-cart') ?>" method="POST">
							<div class="col-sm-7" style="padding-left: 0; text-align: left;">

								<div class="product-information"><!--/product-information-->
									<h2><?php echo $pro_det->Name ?></h2>
									<input type="hidden" value="<?php echo $pro_det->ProductID ?>" name="ProductID">
									<span>
										<?php
										// Kiểm tra giá trị của $allPro->discount
										if (isset($pro_det->Promotion) && $pro_det->Promotion != 0) {
											// Tính giá giảm
											$price_no_Promotion = $pro_det->Selling_price;
											$pro_det->Selling_price = $pro_det->Selling_price * (1 - $pro_det->Promotion / 100);
										?>
											<h2>
												<span><?php echo number_format($pro_det->Selling_price, 0, ',', '.') ?>
													VND</span>
												<label
													style="text-decoration: line-through; margin-top: 5px"><?php echo number_format($price_no_Promotion, 0, ',', '.') ?>
													VND</label>
												<br>

											</h2>
										<?php
										} else {
											// Hiển thị giá gốc nếu discount bằng 0
										?>
											<h2><span><?php echo number_format($pro_det->Selling_price, 0, ',', '.') ?>
													VND</span></h2>
											<br>
										<?php
										}
										?>

										<br>
										<label>Tồn kho: <?php echo $pro_det->total_remaining ?></label>
										<input type="number" min="1" value="1" name="Quantity" />
										<button type="submit" class="btn btn-fefault cart" style="background-color: #808080;">
											<i class="fa fa-shopping-cart"></i>
											Thêm vào giỏ hàng
										</button>
									</span>

									<p><b>Tình trạng:</b>
										<?php
										if ($pro_det->total_remaining > 0) {
											echo "Còn hàng";
										} else {
											echo "Hết hàng";
										}
										?>
									</p>

									<!-- <p><b>Tình trạng:</b>
										<?php
										if ($pro_det->total_remaining > 0) {
											echo "Còn hàng";
										} else {
											echo "Hết hàng";
										}
										?>
									</p> -->

									<p style="text-align: justify; text-justify: inter-word"><b>Mô tả:</b>
										<?php echo $pro_det->Description ?></p>

									<p><b>Thương hiệu:</b> <?php echo $pro_det->tenthuonghieu ?> </p>
									<p><b>Danh mục:</b> <?php echo $pro_det->tendanhmuc ?></p>

									<p><b>Giới tính:</b> 
										<?php 
											$gender = strtolower(trim($pro_det->set));  // xử lý chuẩn hóa chữ và bỏ khoảng trắng
											if ($gender == 'nam') {
												echo 'Nam';
											} elseif ($gender == 'nữ') {
												echo 'Nữ';
											} elseif ($gender == 'unisex') {
												echo 'Unisex';
											} else {
												echo 'Không xác định';
											}
										?>
									</p>


									<!-- <p><b>Công dụng sản phẩm:</b> <?php echo $pro_det->Product_use ?></p> -->
									<a href=""><img src="images/product-details/share.png" class="share img-responsive"
											alt="" /></a>
								</div><!--/product-information-->
							</div>
						</form>
					</div><!--/product-details-->
				<?php } ?>

				<div class="category-tab shop-details-tab" style="padding-left: 0; text-align: left;"><!--category-tab-->
					<div class="col-sm-12">

						<ul class="nav" style="text-align: left; padding-left: 0;">
  							<li class="active">
    							<a href="#reviews" data-toggle="tab" style="color: white;">Đánh giá</a>

  							</li>
						</ul>


					</div>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="reviews">
							<div class="col-sm-12">
								<?php if (!empty($product_reviews)): ?>
									<?php foreach ($product_reviews as $review): ?>
										<div class="review-box mb20 p15" style="border: 1px solid #eee; border-radius: 8px; background: #fafafa;">
											<div class="review-header mb10">
												<strong><i class="fa fa-user"></i> <?php echo htmlspecialchars($review->reviewer_name); ?></strong>
												<span class="ml10 text-muted"><i class="fa fa-clock-o"></i> <?php echo date('d/m/Y H:i', strtotime($review->created_at)); ?></span>
												<span class="ml10">
													<?php for ($i = 1; $i <= 5; $i++): ?>
														<i class="fa fa-star<?php echo ($i <= $review->rating) ? ' text-warning' : '-o'; ?>"></i>
													<?php endfor; ?>
												</span>
											</div>
											<div class="review-comment mb10">
												<p><?php echo nl2br(htmlspecialchars($review->comment)); ?></p>
											</div>

											<?php if (!empty($review->reply)): ?>
												<div class="review-reply p10 mt10" style="background: #f0f0f0; border-left: 4px solid #007bff; border-radius: 5px;">
													<strong>Phản hồi:</strong>
													<p class="mb0"><?php echo nl2br(htmlspecialchars($review->reply)); ?></p>
												</div>
											<?php endif; ?>
										</div>


										<!-- <div class="review-box mb-4 p-3 border rounded shadow-sm bg-white">
											<div class="review-header d-flex align-items-center justify-content-between mb-2">
												<div class="d-flex align-items-center">
													<i class="fa fa-user-circle fa-lg text-primary mr-2"></i>
													<strong class="mr-3"><?php echo htmlspecialchars($review->reviewer_name); ?></strong>
													<span class="text-muted small">
														<i class="fa fa-clock-o mr-1"></i><?php echo date('d/m/Y H:i', strtotime($review->created_at)); ?>
													</span>
												</div>
												<div class="review-rating">
													<?php for ($i = 1; $i <= 5; $i++): ?>
														<i class="fa fa-star<?php echo ($i <= $review->rating) ? ' text-warning' : '-o text-muted'; ?>" style="<?php echo ($i <= $review->rating) ? 'color: #ffc107;' : ''; ?>"></i>
													<?php endfor; ?>
												</div>
											</div>

											<div class="review-comment mb-2 pl-1 pr-1">
												<p class="mb-1"><?php echo nl2br(htmlspecialchars($review->comment)); ?></p>
											</div>

											<?php if (!empty($review->reply)): ?>
												<div class="review-reply mt-3 p-3 border-left" style="border-left: 4px solid #0d6efd; background: #f8f9fa; border-radius: 4px;">
													<div class="font-weight-bold text-primary mb-1">Phản hồi từ quản trị viên:</div>
													<p class="mb-0"><?php echo nl2br(htmlspecialchars($review->reply)); ?></p>
												</div>
											<?php endif; ?>
										</div> -->

										

									<?php endforeach; ?>
								<?php else: ?>
									<div class="alert alert-info text-center">Chưa có đánh giá nào cho sản phẩm này.</div>
								<?php endif; ?>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>
</section>