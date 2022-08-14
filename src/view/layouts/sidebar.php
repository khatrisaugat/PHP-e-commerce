<?php
use Ecommerce\Controller\AuthController;
use Ecommerce\Controller\ProductController;
$categories=ProductController::getCategories();
?>

<div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse  navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 position-absolute col-lg-11" id="navbar-vertical" style="background-color:#fff ;z-index:999;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <?php
                        foreach($categories as $category){
                        $subcategories=ProductController::getSubCategoriesByCategoryId($category['cat_id']);
                                if(count($subcategories)>0){
                                ?>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link" data-toggle="dropdown"><?php echo $category['cat_title']; ?> <i class="fa fa-angle-down float-right mt-1"></i></a>
                                
                                <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0" style="top: inherit;">
                                    <?php
                                    
                                    foreach($subcategories as $subcategory){
                                        if($subcategory['cat_id']==$category['cat_id']){
                                        ?>
                                        <a href="<?=$baseUrl?>/sub_category?sub_category=<?=$subcategory['sub_cat_id']?>" class="dropdown-item"><?php echo $subcategory['sub_cat_title']; ?></a>
                                        <?php
                                        }
                                }
                                    ?>
                                </div>
                                <?php
                                }else{
                                    ?>
                                    <a href="<?=$baseUrl?>/sub_category?category=<?=$subcategory['cat_id']?>" class="nav-item nav-link"><?php echo $category['cat_title']; ?></a>
                                    <?php
                                }
                            }

                        ?>
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
                            <a href="<?=$baseUrl;?>" class="nav-item nav-link">Home</a>
                            <a href="<?=$baseUrl;?>/cart" class="nav-item nav-link">Shopping Cart</a>
                            <a href="<?=$baseUrl;?>/contact" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            <?php
                            if(AuthController::isUserLoggedIn()){
                                ?>
                            <a href="" class="nav-item nav-link"><?=$_SESSION['username']?></a>
                            <a href="<?=$baseUrl?>/routes/logout" class="nav-item nav-link">Logout</a>
                                <?php
                            }else{
                            ?>
                            <a href="<?=$baseUrl?>/login" class="nav-item nav-link">Login</a>
                            <a href="<?=$baseUrl?>/register" class="nav-item nav-link">Register</a>
                            <?php } ?>
                        </div>
                    </div>
                </nav>
            </div>
            