 <?php
 $subcategories=$obj->Select("sub_categories");

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
        <div class="row px-xl-5 pb-3">
            <?php
            foreach($subcategories as $subcategory){
                $produts=$obj->Select("products JOIN images ON images.image_id=products.featured_image_id","*","sub_cat_id",array($subcategory['sub_cat_id']));
                ?>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;height:500px;">
                        <p class="text-right"><?=count($produts) ?> Products</p>
                        <a href="sub_category?category=<?=$subcategory['sub_cat_id']; ?>" class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid" src="Admin/img/<?=$produts[0]['image_src'];?>" alt="">
                        </a>
                        <h5 class="font-weight-semi-bold m-0"><?=$subcategory['sub_cat_title'];?></h5>
                    </div>
                </div>
                <?php
            }
            ?>
            <!-- <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/cat-1.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Men's dresses</h5>
                </div>
            </div> -->
            <!-- <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/cat-2.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Women's dresses</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/cat-3.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Baby's dresses</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/cat-4.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Accerssories</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/cat-5.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Bags</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">15 Products</p>
                    <a href="" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/cat-6.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">Shoes</h5>
                </div>
            </div> -->
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
            $products=$obj->Select("products JOIN images ON images.image_id=products.featured_image_id ORDER BY pid DESC LIMIT 8 ");
            // print_r($produts);
            // DIE();
            foreach($products as $product){
            ?>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4" style="height: 500px;">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="Admin/img/<?=$product['image_src']; ?>" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3"><?=$product['product_name']; ?></h6>
                        <div class="d-flex justify-content-center">
                            <h6>Nrs. <?=$product['product_price']; ?></h6><h6 class="text-muted ml-2"><del>Nrs. <?=$product['product_price']; ?></del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="product?pid=<?=$product['pid'];?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
            
        </div>
    </div>
    <!-- Products End -->