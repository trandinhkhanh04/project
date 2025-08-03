<style>
        .search-bar {
            display: flex;
            align-items: center;
            border: 2px solid rgb(145, 156, 165);  /* Đường viền xanh dương */
            border-radius: 20px;         /* Bo góc tròn */
            overflow: hidden;
            width: 100%;
            max-width: 400px;            /* Giới hạn chiều rộng */
        }

        .search-input {
            border: none;
            padding: 20px 15px;
            outline: none;
            flex: 1;                    /* Input chiếm toàn bộ không gian còn lại */
        }

        .search-btn {
            background-color: rgb(145, 156, 165);  /* Màu xanh dương */
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 0;           /* Loại bỏ bo góc của nút */
        }

        .search-btn:hover {
            background-color:rgb(64, 100, 123);  /* Màu khi hover */
        }

		.shop-menu {
    	padding-top: 10px;
    	padding-bottom: 10px;
		} 

		
    </style>

<header id="header">
	<div class="header-middle" style="background-color: #f2f2f2; "><!--header-middle-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<!-- <div class="logo pull-left">
						 <a href="<?php echo base_url('/') ?>"><img style="width: 100px" src="<?php echo base_url('frontend/image/logo2.png') ?>" alt="" /></a>
						<h3><a><span>Noir Essence</span></a></h3> 
					</div> -->
					<div class="logo pull-left"><a href="<?php echo base_url('/') ?>"><img style="width: 150px" src="<?php echo base_url('frontend/image/logo9.png') ?>" alt="" /></a>
    <!-- <h3><a><span>Noir Essence</span></a></h3> -->
</div>

				</div>
				<div class="col-sm-8">
	<div class="shop-menu pull-right">
		<ul class="nav navbar-nav">
			<?php if ($this->session->userdata('logged_in_customer') || $this->session->userdata('logged_in_admin')): ?>
				<?php
				$session_data = $this->session->userdata('logged_in_customer') ?? $this->session->userdata('logged_in_admin');
				?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #f2f2f2;">
						<i class="fa fa-user"></i>
						<b><?php echo $session_data['username'] ?></b>
						<i class="fa-solid fa-caret-down"></i>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown" style="text-align: center;">
						<a class="dropdown-item" href="<?php echo base_url('profile-user'); ?>" style="background-color: #f2f2f2;">
							<h5>Thông tin cá nhân</h5>
						</a>
					</div>
				</li>

				<?php if ($this->session->userdata('logged_in_admin')): ?>
					<li>
						<a href="<?php echo base_url('dashboard'); ?>" style="background-color: #f2f2f2;"><i class="fa fa-cogs"></i> </a>
					</li>
				<?php endif; ?>

				<li>
					<a href="<?php echo base_url('checkout') ?>" style="background-color: #f2f2f2;"><i class="fa fa-crosshairs"></i> </a>
				</li>
				<li>
					<a href="<?php echo base_url('dang-xuat') ?>" style="background-color: #f2f2f2;"><i class="fa fa-sign-out"></i> </a>
				</li>
			<?php else: ?>
				<li>
					<a href="<?php echo base_url('dang-nhap') ?>" style="background-color: #f2f2f2;"><i class="fa fa-sign-in"></i> </a>
				</li>
			<?php endif; ?>
			<li>
				<a href="<?php echo base_url('gio-hang') ?>" style="background-color: #f2f2f2;"><i class="fa fa-shopping-cart"></i> </a>
			</li>
			<li>
				<a href="<?php echo base_url('order_customer/listOrder') ?>" style="background-color: #f2f2f2;"><i class="fa fa-list"></i> </a>
			</li>
		</ul>
	</div>
</div>


			</div>
		</div>
	</div><!--/header-middle-->

	<div class="header-bottom"><!--header-bottom-->
		<div class="container">
			<div class="row">
				<div class="col-sm-7">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse"
							data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="mainmenu pull-left">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="<?php echo base_url('/') ?>" class="active">Trang chủ</a></li>
							<li class="dropdown"><a href="#">Hương<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									<?php
									foreach ($category as $key => $cate) {
									?>
										<li><a
												href="<?php echo base_url('danh-muc/' . $cate->CategoryID . '/' . $cate->Slug) ?>"><?php echo $cate->Name ?></a>
										</li>
									<?php } ?>
								</ul>
							</li>

							<li class="dropdown"><a href="#">Giới tính <i class="fa fa-angle-down"></i></a>
    <ul role="menu" class="sub-menu">
        <li><a href="<?= base_url('gioi-tinh/nam') ?>">Nam</a></li>
        <li><a href="<?= base_url('gioi-tinh/nu') ?>">Nữ</a></li>
        <li><a href="<?= base_url('gioi-tinh/unisex') ?>">Unisex</a></li>
    </ul>
</li>




							<!-- <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu">
										<li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
									</ul>
								</li>
								<li><a href="404.html">404</a></li>
								<li><a href="contact-us.html">Contact</a></li> -->
							<!-- <li><a href="<?php echo base_url('predict') ?>">Chẩn đoán bệnh</a></li> -->
							<li><a href="<?php echo base_url('product-on-sale') ?>">Sản phẩm đang được giảm giá</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-5">

					<!-- <div class="search_box pull-right">
						<form action="<?php echo base_url('search-product') ?>" method="GET">
							<input type="text" name="keyword" placeholder="Tên sản phẩm..." id="searchKeyword" value="<?php echo $this->input->get('keyword'); ?>" />
							<input type="submit" class="btn btn-default" value="Tìm kiếm" />
						</form>
					</div> -->
					<!-- thanh tim kiem  -->
					<!-- <form action="<?php echo base_url('search-product') ?>" method="GET">
						<div class="search-bar">
            				<input type="text" name="keyword" id="searchKeyword" class="form-control search-input" placeholder="Tìm kiếm...
							"value="<?php echo html_escape($this->input->get('keyword')); ?>">
            				<button type="submit" value="Search" class="btn search-btn">
                			<i class="fa fa-search"></i>
           				 </button>
        			</div>
					</form> -->

					<form action="<?php echo base_url('search-product') ?>" method="GET">
						<div class="search-bar">
							<input type="text" name="keyword" id="searchKeyword" class="form-control search-input" placeholder="Tìm kiếm..."value="<?php echo html_escape($this->input->get('keyword')); ?>">
							<button type="button" onclick="startVoiceSearch()" class="btn btn-secondary">
							<i class="fa fa-microphone"></i>
							</button>
							<button type="submit" value="Search" class="btn search-btn">
							<i class="fa fa-search"></i>
							</button>
						</div>
					</form>
						<!-- <p id="voiceStatus" style="color: green; font-weight: bold;"></p> -->



					<!-- tk anh -->
					<!-- <div class="container mt-5 mb-5"> 
    <h3 class="text-center mb-4">Tìm kiếm sản phẩm bằng hình ảnh</h3>

    <form action="<?= base_url('searchbyimage/search'); ?>" method="post" enctype="multipart/form-data" class="text-center">
        <div class="form-group">
            <input type="file" name="image" accept="image/*" required class="form-control-file mb-3" style="display: inline-block;">
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i> Tìm kiếm
        </button>
    </form>
</div> -->



				</div>
			</div>
		</div>
	</div>

	
									
</header>