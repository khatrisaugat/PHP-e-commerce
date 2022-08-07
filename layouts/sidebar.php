<?php
$categories=$obj->Select("categories");
// print_r($categories);
// die();
?>

<div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse  navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 position-absolute col-lg-11" id="navbar-vertical" style="background-color:#fff ;z-index:999;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <!-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">Dresses <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="" class="dropdown-item">Men's Dresses</a>
                                <a href="" class="dropdown-item">Women's Dresses</a>
                                <a href="" class="dropdown-item">Baby's Dresses</a>
                            </div>
                        </div> -->
                        <?php
                        foreach($categories as $category){
                            ?>
                            <?php
                                $subcategories=$obj->Select("sub_categories","*","cat_id",array($category['cat_id']));
                                // print_r($subcategories);
                                if(count($subcategories)>0){
                                ?>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link" data-toggle="dropdown"><?php echo $category['cat_title']; ?> <i class="fa fa-angle-down float-right mt-1"></i></a>
                                
                                <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0" style="top: inherit;">
                                    <?php
                                    
                                    foreach($subcategories as $subcategory){
                                        ?>
                                        <a href="<?=base_url()?>sub_category?category=<?=$subcategory['sub_cat_id']?>" class="dropdown-item"><?php echo $subcategory['sub_cat_title']; ?></a>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                }else{
                                    ?>
                                    <a href="" class="nav-link"><?php echo $category['cat_title']; ?></a>
                                    <?php
                                }
                            }

                        ?>
                        <!-- <a href="" class="nav-item nav-link">Shirts</a>
                        <a href="" class="nav-item nav-link">Jeans</a>
                        <a href="" class="nav-item nav-link">Swimwear</a>
                        <a href="" class="nav-item nav-link">Sleepwear</a>
                        <a href="" class="nav-item nav-link">Sportswear</a>
                        <a href="" class="nav-item nav-link">Jumpsuits</a>
                        <a href="" class="nav-item nav-link">Blazers</a>
                        <a href="" class="nav-item nav-link">Jackets</a>
                        <a href="" class="nav-item nav-link">Shoes</a> -->
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0" style="position:static ;">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="<?=base_url();?>" class="nav-item nav-link">Home</a>
                            <a href="<?=base_url();?>cart" class="nav-item nav-link">Shopping Cart</a>
                            <!-- <a href="<?=base_url();?>checkout" class="nav-item nav-link">Checkout</a> -->
                            <!-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                    <a href="checkout.html" class="dropdown-item">Checkout</a>
                                </div>
                            </div> -->
                            <a href="<?=base_url();?>contact" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            <?php
                            if(isset ($_SESSION['user']) && $_SESSION['user']['ut_id']==2){
                                ?>
                            <a href="" class="nav-item nav-link"><?=$_SESSION['user']['username']?></a>
                            <a href="logout" class="nav-item nav-link">Logout</a>
                                <?php
                            }else{
                            ?>
                            <a href="<?=base_url()?>login" class="nav-item nav-link">Login</a>
                            <a href="<?=base_url()?>register" class="nav-item nav-link">Register</a>
                            <?php } ?>
                        </div>
                    </div>
                </nav>
                <?php

                // print_r($_SERVER);
                // die();
                if($_SERVER['REQUEST_URI']=="/college-project/" || $_SERVER['REQUEST_URI']=="/college-project/home"){   
                ?>
                <!-- <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="img/carousel-1.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                                    <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="height: 410px;">
                            <img class="img-fluid" src="img/carousel-2.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                                    <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div> -->
                <?php }
                ?>
            </div>
            