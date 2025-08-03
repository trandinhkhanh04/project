<?php $this->load->view('pages/component/slider'); ?>
<section>
    <div class="container">
        <div class="row">
            <?php $this->load->view('pages/component/sidebar'); ?>
            <div class="col">
                <!-- <div class="col-sm-9 padding-right"> -->
                <div class="features_items">
                    <?php if (isset($Name)) : ?>
                    <h2 class="title text-center" style="color: brown;"><?php echo $Name; ?></h2>
                    <?php else : ?>
                    <h2 class="title text-center" style="color: brown;">Sản phẩm</h2>
                    <?php endif; ?>
                    <?php if (empty($allproduct_pagination)) : ?>
                        <p class="text-center">Không có sản phẩm.</p>
                    <?php else : ?>
                        <?php foreach ($allproduct_pagination as $key => $allPro) : ?>
                            <form action="<?php echo base_url('add-to-cart') ?>" method="POST">

                    <!-- test -->

                    <div class="col-sm-3">
                    <form action="<?php echo base_url('add-to-cart') ?>" method="POST">
                        <input type="hidden" value="<?php echo $allPro->ProductID ?>" name="ProductID">
                        <input type="hidden" value="1" name="Quantity">

                        <div class="product-image-wrapper">
                        <a href="<?php echo base_url('san-pham/' . $allPro->ProductID . '/' . $allPro->Slug) ?>" class="product-link">
                            <div class="productinfo text-center">
                            <img src="<?php echo base_url('uploads/product/' . $allPro->Image) ?>" alt="<?php echo $allPro->Name ?>" />
                            <p class="product-name"><?php echo $allPro->Name ?></p>
                            </div>
                        </a>

                        <div class="product-footer">
                            <div class="product-price">
                            <?php if (isset($allPro->Promotion) && $allPro->Promotion != 0): 
                                $price_no_Promotion = $allPro->Selling_price;
                                $Selling_price = $price_no_Promotion * (1 - $allPro->Promotion / 100);
                            ?>
                                <span class="discounted-price"><?php echo number_format($Selling_price, 0, ',', '.') ?> đ</span>
                                <span class="original-price"><?php echo number_format($price_no_Promotion, 0, ',', '.') ?> đ</span>
                            <?php else: ?>
                                <?php echo number_format($allPro->Selling_price, 0, ',', '.') ?> đ
                            <?php endif; ?>
                            </div>

                            <div class="product-icons">
                            <button type="submit"><i class="fa fa-shopping-cart"></i></button>
                            </div>
                        </div>
                        </div>
                    </form>
                    </div>
                    <!-- end test -->

                        </form>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo $links; ?>
             
        </div>
    </div>
</section>
