<?php
use Ecommerce\Config\Config;
use Ecommerce\Controller\AuthController;
use Ecommerce\Controller\ProductController;
use Ecommerce\Model\UserModel;

$url=Config::getRoute($_GET['url']);
//Login routes for admin
    //admin login route
    if($url=='AdminLogin'){
        $logged_in=(new UserModel())->Adminlogin($_POST['username'], md5($_POST['password']));
        if($logged_in==1){
            header('Location: '.$baseUrl.'/admin');
        }
    }
    //admin logout route
    if($url=='AdminLogout'){
        AuthController::logout();
        header('Location: '.$baseUrl.'/admin/');
        die;
    }
//Login routes for admin ended
//Login routes for user
    //user login route
    if($url=='loginUser'){
        $logged_in=(new UserModel())->Userlogin($_POST['username'], md5($_POST['password']));
        if($logged_in==1){
            header('Location: '.$baseUrl.'/');
        }else{
            $_SESSION['error']='Invalid username or password';
            header('Location: '.$baseUrl.'/login');
        }
    }
    //user logout route
    if($url=='logout'){
        AuthController::logout();
        header('Location: '.$baseUrl.'/');
        die;
    }
    //register user route
    if($url=='registerUser'){
        if(isset($_POST['submit'])){
            unset($_POST['submit']);
            $_POST['ut_id']=2;
            $_POST['password']=md5($_POST['password']);
            $logged_in=(new UserModel())->registerUser($_POST);
        }
        if($logged_in==1){
            header('Location: '.$baseUrl.'/');
        }else{
            header('Location: '.$baseUrl.'/register');
        }
    }
//Login routes for user ended

//category routes
    //category insert Route
    if($url=='insertCategories'){
        if(isset($_POST['submit']))
            unset($_POST['submit']);
        ProductController::insertCategories($_POST);
        header('Location: '.$baseUrl.'/admin/add_categories');
    }

    //category delete route
    if($url=='deleteCategories'){
        if(isset($_GET['did'])){
            if(isset($_GET['action']) && $_GET['action']=='d'){
                $id=$_GET['did'];
                ProductController::deleteCategories($id);
                header('Location: '.$baseUrl.'/admin/add_categories');
            }
        }
    }
    //category update route
    if($url=='updateCategories'){
        if(isset($_POST['update']))
            unset($_POST['update']);
        ProductController::updateCategories($_POST,$_GET['id']);
        header('Location: '.$baseUrl.'/admin/add_categories');
    }
//category routes ended

//sub category routes
    //sub category insert Route
    if($url=='insertSubCategories'){
        if(isset($_POST['submit']))
            unset($_POST['submit']);
        ProductController::insertSubCategories($_POST);
        header('Location: '.$baseUrl.'/admin/add_sub_categories');
    }
    //sub category delete route
    if($url=='deleteSubCategories'){
        if(isset($_GET['did'])){
            if(isset($_GET['action']) && $_GET['action']=='d'){
                $id=$_GET['did'];
                ProductController::deleteSubCategories($id);
                header('Location: '.$baseUrl.'/admin/add_sub_categories');
            }
        }
    }
    //sub category update route
    if($url=='updateSubCategories'){
        if(isset($_POST['update']))
            unset($_POST['update']);
        ProductController::updateSubCategories($_POST,$_GET['id']);
        header('Location: '.$baseUrl.'/admin/add_sub_categories');
    }
//sub category routes ended

//options routes
    //option insert Route
    if($url=='insertOptions'){
        if(isset($_POST['submit']))
        unset($_POST['submit']);
        ProductController::insertOptions($_POST);
        header('Location: '.$baseUrl.'/admin/add_option');
    }
    //option delete route
    if($url=='deleteOptions'){
        if(isset($_GET['did'])){
            if(isset($_GET['action']) && $_GET['action']=='d'){
                $id=$_GET['did'];
                ProductController::deleteOptions($id);
                header('Location: '.$baseUrl.'/admin/add_option');
            }
        }
    }
    //option update route
    if($url=='updateOptions'){
        if(isset($_POST['update']))
            unset($_POST['update']);
        ProductController::updateOptions($_POST,$_GET['id']);
        header('Location: '.$baseUrl.'/admin/add_option');
    }
//options routes ended

//options group routes
    //option group insert Route
    if($url=='insertOptionGroups'){
        if(isset($_POST['submit']))
        unset($_POST['submit']);
        ProductController::insertOptionGroups($_POST);
        header('Location: '.$baseUrl.'/admin/add_option_groups');
    }
    //option group delete route
    if($url=='deleteOptionGroups'){
        if(isset($_GET['did'])){
            if(isset($_GET['action']) && $_GET['action']=='d'){
                $id=$_GET['did'];
                ProductController::deleteOptionGroups($id);
                header('Location: '.$baseUrl.'/admin/add_option_groups');
            }
        }
    }
    //update option group route
    if($url=='updateOptionGroups'){
        if(isset($_POST['update']))
            unset($_POST['update']);
        ProductController::updateOptionGroups($_POST,$_GET['id']);
        header('Location: '.$baseUrl.'/admin/add_option_groups');
    }
//options group routes ended

//products routes
//product insert Route
    if($url=='insertProduct'){
        if(isset($_POST['submit']))
        unset($_POST['submit']);
        ProductController::insertProducts($_POST,$_FILES);
        header('Location: '.$baseUrl.'/admin/add_products');
    }
    //product delete route
    if($url=='deleteProduct'){
        if(isset($_GET['did'])){
            if(isset($_GET['action']) && $_GET['action']=='d'){
                $id=$_GET['did'];
                ProductController::deleteProducts($id);
                header('Location: '.$baseUrl.'/admin/display_products');
            }
        }
    }
    //insert product options route
    if($url=='insertProductOptions'){
        if(isset($_POST['submit']))
        unset($_POST['submit']);
        ProductController::insertProductOptions($_POST);
        header('Location: '.$baseUrl.'/admin/add_options_to_products?id='.$_GET['id']);
    }
    //delete product options route
    if($url=='deleteProductOptions'){
        if(isset($_GET['did'])){
            if(isset($_GET['action']) && $_GET['action']=='d'){
                $id=$_GET['did'];
                ProductController::deleteProductOptions($id);
                header('Location: '.$baseUrl.'/admin/add_options_to_products?id='.$_GET['id']);
            }
        }
    }
    //set Featured Image
    if($url=='setFeaturedImage'){
        if(isset($_POST['submit']))
            unset($_POST['submit']);
        ProductController::setFeaturedImage($_POST,$_GET['id']);
        header('Location: '.$baseUrl.'/admin/edit_products?id='.$_GET['id']);
    }

    //delete image
    if($url=='deleteImage'){
        if(isset($_GET['did'])){
            if(isset($_GET['action']) && $_GET['action']=='d'){
                $id=$_GET['did'];
                ProductController::deleteImage($id);
                
                header('Location: '.$baseUrl.'/admin/edit_products?id='.$_GET['id']);
            }
        }
    }
    // add images to product
    if($url=='addImagesToProduct'){
        if(isset($_POST['submit']))
            unset($_POST['submit']);
        ProductController::addImagesToProduct($_FILES,$_GET['id']);
        header('Location: '.$baseUrl.'/admin/edit_products?id='.$_GET['id']);
    }

    //update product route
    if($url=='updateProduct'){
        if(isset($_POST['update']))
            unset($_POST['update']);
        ProductController::updateProducts($_POST,$_GET['id']);
        header('Location: '.$baseUrl.'/admin/display_products');
    }
//products routes ended

//order routes
    //update orders route
    if($url=='updateOrder'){
        if(isset($_POST['update']))
            unset($_POST['update']);
        ProductController::updateOrders($_POST);
        header('Location: '.$baseUrl.'/admin/orders_manage');
    }
//order routes ended

//cart routes
    //add product to cart route
    if($url=='addProductToCart'){
        if(isset($_POST['addToCart']))
            unset($_POST['addToCart']);
        $_POST['pid']=$_GET['pid'];
        // print_r($_POST);
        // die;
        ProductController::insertProductsToCart($_POST);
        header('Location: '.$baseUrl.'/cart');
    }
    //update cart route
    if($url=='updateCart'){
        if(isset($_POST['update']))
            unset($_POST['update']);
        ProductController::updateCart($_POST,$_GET['cid']);
        header('Location: '.$baseUrl.'/cart');
    }
    //remove product from cart route
    if($url=='removeProductFromCart'){
       if(isset($_POST['removeVal'])){
              ProductController::removeProductFromCart($_POST['removeVal']);
              header('Location: '.$baseUrl.'/cart');
       }
    }
//cart routes ended

//checkout route
    //checkout route
    if($url=='checkout'){
        if(isset($_POST['submit']))
            unset($_POST['submit']);
        // print_r($_POST);
        // die;
        
        ProductController::checkout($_POST);
        $_SESSION['message']="Product checkout sucessfully";
        header('Location: '.$baseUrl.'/cart');
    }

