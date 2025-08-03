<style> 
#slider {
    width: 100vw;
    margin: 0 auto;
    padding: 0;
    overflow: hidden;
}

.slider-img {
    width: 100vw;
    height: auto;
    max-height: 450px;
    object-fit: cover;
    display: block;
    margin: 0 auto;
}

.carousel-inner, .carousel-item {
    width: 98%;
}

</style>
<section id="slider" style="padding: 0; margin: 0;">
    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php foreach ($sliders as $key => $slide): ?>
                <li data-target="#slider-carousel" data-slide-to="<?= $key ?>" class="<?= $key == 0 ? 'active' : '' ?>"></li>
            <?php endforeach; ?>
        </ol>

        <div class="carousel-inner">
            <?php foreach ($sliders as $key => $slide): ?>
                <div class="carousel-item item <?= $key == 0 ? 'active' : '' ?>">
                    <img src="<?= base_url('uploads/sliders/' . $slide->image) ?>" class="slider-img" alt="<?= $slide->title ?>">
                </div>
            <?php endforeach; ?>
        </div>

        <a class="carousel-control-prev" href="#slider-carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#slider-carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</section>



<!-- <section id="slider">

    <div class="container">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide"  data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>
                    
                    <div class="carousel-inner">

                        <?php 
                            foreach ($sliders as $key => $slide) {
                        ?>
                        <div style="margin: 0 auto" class="item <?php echo ($key==0)?'active' : ''; ?>">
                            <div class="col-sm-11">
                                <img style="width: 930px; height: 300px;" src="<?php echo base_url('uploads/sliders/'.$slide->image) ?>" class="girl img-responsive" alt="<?php echo $slide->title ?>" />
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                       <i class="fa fa-angle-right"></i>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section> -->


