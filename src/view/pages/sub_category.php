<?php
use Ecommerce\Controller\ProductController;
$category=false;
$id=0;
foreach(array_keys($_GET) as $key){
    if($key=='category'){
        $id=$_GET['category'];
        $category=true;
    }else if($key=='sub_category'){
        $id=$_GET['sub_category'];
    }
}
if($category){
    $products=ProductController::getProductsByCategoryId($id);
}else{
    $products=ProductController::getProductsBySubCategoryId($id);
}


?>
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3"><?=$category?$products[0]['cat_title']:$products[0]['sub_cat_title'];?></h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href=""><?=$category?"Category":"Sub-Category";?></a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><?=$category?$products[0]['cat_details']:$products[0]['sub_cat_desc'];?></p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2"><?=$products[0]['sub_cat_title'];?></span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            <?php
            foreach($products as $product):
            ?>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4" style="height: 500px;">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="<?=$baseUrl."/assets/images/".$product['image_src']; ?>" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3"><?=$product['product_name']; ?></h6>
                        <div class="d-flex justify-content-center">
                            <h6>Nrs. <?=$product['product_price']; ?></h6><h6 class="text-muted ml-2"><del>Nrs. <?=$product['product_price']; ?></del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="product?pid=<?=$product['pid'];?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <!-- <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a> -->
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>