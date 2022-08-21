<?php
use Ecommerce\Controller\ProductController;
$subcategories=ProductController::getSubcategories();
?>
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Buy from us</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Homepage</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Categories Start -->
    <div class="container-fluid pt-5">
                <?php
                    if(isset($_SESSION['message'])){?>
                        <div class="alert alert-success error">
                    <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                        ?>
                        </div>
                        <?php
                    }
                ?>
        <div class="row px-xl-5 pb-3">
            <?php
            foreach($subcategories as $subcategory){
                // $produts=$obj->Select("products JOIN images ON images.image_id=products.featured_image_id","*","sub_cat_id",array($subcategory['sub_cat_id']));
                $produts=ProductController::getProductsBySubcategoryId($subcategory['sub_cat_id']);
                ?>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;height:500px;">
                        <p class="text-right"><?=count($produts) ?> Products</p>
                        <a href="sub_category?sub_category=<?=$subcategory['sub_cat_id']; ?>" class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid" src="<?=$baseUrl."/assets/images/".$produts[0]['image_src'];?>" alt="">
                        </a>
                        <h5 class="font-weight-semi-bold m-0"><?=$subcategory['sub_cat_title'];?></h5>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <!-- Categories End -->

<!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            <?php
            // $products=$obj->Select("products JOIN images ON images.image_id=products.featured_image_id ORDER BY pid DESC LIMIT 8 ");
            $products=ProductController::getAllProducts(8,"DESC");
            // print_r($produts);
            // DIE();
            foreach($products as $product){
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
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
            
        </div>
    </div>
    <!-- Products End -->