<section  id="cart_items">
	<div class="container">
		<?php $this->load->view("pages/component/breadcrumb.php");?>
		<div class="table-responsive cart_info">
			<?php
			if ($this->cart->contents()) {
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu" style="background-color: #808080;">
							<td scope="col" class="description">Hình ảnh</td>
							<td scope="col" class="image">Sản phẩm</td>
							<td scope="col" class="price">Đơn giá</td>
							<td scope="col" class="quantity">Số lượng</td>
							<td scope="col" class="in_stock">Tồn kho</td>
							<td scope="col" class="total">Thành tiền</td>
							<td scope="col"></td> 
						</tr>
					</thead>
					<tbody>
						<?php
						$subtotal = 0;
						$total = 0;
						foreach ($this->cart->contents() as $items) {
							$subtotal = $items['qty'] * $items['price'];
							$total += $subtotal;
							?>
							<tr>
								<td style="width: 200px;" class="cart_product">
									<img src="<?php echo base_url('uploads/product/' . $items['options']['image']) ?>"
										width="150" height="150" alt="<?php echo $items['name'] ?>">
								</td>
								<td class="cart_description">
									<h4>
										<p><?php echo $items['name'] ?></p>
									</h4>
								</td>
								<td class="cart_price">
									<p><?php echo number_format($items['price'], 0, ',', '.') ?> VND</p>
								</td>
								<td class="cart_quantity">
									<form action="<?php echo base_url('update-cart-item') ?>" method="POST">

										<div class="cart_quantity_button">
											<input type="hidden" value="<?php echo $items['rowid'] ?>" name="rowid">
											<?php
											if ($items['qty'] > $items['options']['in_stock']) {
												?>
												<!-- <input class="cart_quantity_input" type="number" min="1" name="quantity"
													value="<?php echo $items['options']['in_stock'] ?>" autocomplete="off"> -->
												
													<!-- gio hang ajax -->
												<input class="cart_quantity_input auto-update-qty" type="number" min="1"
													name="quantity" value="<?php echo $items['qty'] ?>"
													data-rowid="<?php echo $items['rowid'] ?>" 
													data-max="<?php echo $items['options']['in_stock'] ?>">
												<!-- gio hang ajax -->

												<?php
											} else {
												?>
												<!-- <input class="cart_quantity_input" type="number" min="1" name="quantity"
													value="<?php echo $items['qty'] ?>" autocomplete="off"> -->
												
												<!-- gio hang ajax -->
												<input class="cart_quantity_input auto-update-qty" type="number" min="1"
													name="quantity" value="<?php echo $items['qty'] ?>"
													data-rowid="<?php echo $items['rowid'] ?>" 
													data-max="<?php echo $items['options']['in_stock'] ?>">
												<!-- gio hang ajax -->

												<?php
											}
											?>
											<!-- <input type="submit" name="capnhat" class="btn btn-warning"
												value="Cập nhật"></input> -->
										</div>
									</form>
								</td>
								<td class="in_stock">
									<p><?php echo $items['options']['in_stock'] ?></p>
								</td>
								<td class="cart_total">
									<p class="cart_total_price"><?php echo number_format($subtotal, 0, ',', '.') ?> VND</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete"
										href="<?php echo base_url('delete-item/' . $items['rowid']) ?>"><i
											class="fa fa-times"></i></a>
								</td>
							</tr>


							<?php
						}
						?>

					</tbody>

				</table>
				<div style="position: relative; width: 100%; height: 100px">

			
				<div style=" display: flex; position: absolute; right: 15px; top: -10px;">
                        <h3>TỔNG THANH TOÁN:<h3 style="color: #FE980F; margin-left: 10px">
                        <?php echo number_format($total,0, ',','.') ?> VNĐ</h3></h3>
						
                </div>

				<div style=" display: flex; position: absolute; right: 15px; top: 55px;">	
				<a style="margin-right: 30px" href="<?php echo base_url('delete-all-cart') ?>"
							class="btn btn-danger">Xóa tất cả</a>
				<a href="<?php echo base_url('checkout') ?>" class="btn btn-success">Đặt hàng</a>
				</div>
				


						
				</div>
				
				<?php
			} else {
				echo '<span class="text text-danger">Hãy thêm sản phẩm vào giỏ hàng</span>';
			}

			?>
		</div>
	</div>
</section> <!--/#cart_items-->
<!-- gio hang ajax -->
 <script>
document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll(".auto-update-qty");

    inputs.forEach(function (input) {
        input.addEventListener("change", function () {
            const rowid = this.getAttribute("data-rowid");
            const quantity = parseInt(this.value);
            const max = parseInt(this.getAttribute("data-max"));

            // Kiểm tra tồn kho
            if (quantity > max) {
                alert("Số lượng vượt quá tồn kho!");
                this.value = max;
                return;
            }

            // Gửi AJAX request
            fetch("<?php echo base_url('update-cart-item-ajax') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "X-Requested-With": "XMLHttpRequest"
                },
                body: `rowid=${rowid}&quantity=${quantity}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reload trang để cập nhật tổng tiền
                    location.reload();
                } else {
                    alert(data.message || "Lỗi cập nhật giỏ hàng.");
                }
            })
            .catch(error => {
                console.error("Lỗi:", error);
                alert("Không thể cập nhật giỏ hàng.");
            });
        });
    });
});
</script>
