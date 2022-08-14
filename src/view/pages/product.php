<?php
use Ecommerce\Controller\ProductController;
$product=ProductController::getProductById($_GET['pid']);
$images=ProductController::getProductImages($_GET['pid']);
$option_groups=ProductController::getOptionGroupsInProduct($_GET['pid']);
$product=$product[0];

?>
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Product details</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Product </a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><?=$product['product_name'];?></p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
<div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border" style="height: 500px;">
                        <?php
                        foreach($images as $image):
                        ?>
                        <div class="carousel-item <?=$image['image_id']==$product['featured_image_id']?'active':''?>">
                            <img class="w-100 h-100" src="<?=$baseUrl."/assets/images/".$image['image_src'];?>" alt="Image">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold"><?=$product['product_name'];?></h3>
                <h3 class="font-weight-semi-bold mb-4">NRs. <?=$product['product_price'];?></h3>
                <p class="mb-4"><?=$product['product_short_desc'];?></p>
                <form action="<?=$baseUrl?>/routes/addProductToCart?pid=<?=$_GET['pid']?>" method="POST">
                    <input type="hidden" name="price" value="<?=$product['product_price'];?>">
                    <?php
                        foreach($option_groups as $option_group):
                    
                    ?>
                    <div class="d-flex mb-3">
                        
                        <p class="text-dark font-weight-medium mb-0 mr-3"><?=$option_group['opt_group_name'];?></p>
                        
                        <?php
                        $product_options=ProductController::getOptionsByProductIdAndOptionGroupId($product['pid'],$option_group['option_group_id']);
                        foreach($product_options as $key=>$product_option):
                        ?>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="form-check-input" id="flexRadioDefault<?=++$key;?>" name="<?=$option_group['opt_group_name'];?>" value="<?=$product_option['option_name'] ?>">
                                <label for="size-1"><?=$product_option['option_name'] ?> </label>
                            </div>
                            <?php endforeach; ?>
                    </div>
                    <?php endforeach;  ?>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus" type="button">
                                <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary text-center" name="quantity" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus" type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3" type="submit" name="addToCart"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                </form>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                        <p><?=$product['product_short_desc'];?></p>
                        <p><?=$product['product_desc'];?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
