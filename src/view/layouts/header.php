<?php

use Ecommerce\Controller\AuthController;
use Ecommerce\Controller\ProductController;
if(AuthController::isUserLoggedIn())
    $count=ProductController::getCountOfCartProductsByUserId($_SESSION['uid']);
else 
    $count=0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>NepShop - Shop with us</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?=$baseUrl?>/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?=$baseUrl?>/assets/css/frontendcss/style.css" rel="stylesheet">
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Nep</span>Shop</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="search.php" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products" name="search" value="<?=isset($_POST['search'])?$_POST['search']:'';?>">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="<?= $baseUrl.'/cart'?>" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge"><?=$count;?></span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <!-- Footer code here -->
        </div>
    </div>