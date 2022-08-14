<?php
use Ecommerce\Config\Config;
use Ecommerce\Controller\AuthController;
if(AuthController::isAdminLoggedIn()!=1){

    require_once(Config::root('view\admin\login.php')); 
    // echo AuthController::isAdminLoggedIn();
}else{
    // echo AuthController::isAdminLoggedIn();
    require_once Config::root('view\admin\layouts\header.php');
    require_once Config::root('view\admin\layouts\sidebar.php');
    // echo $pagePath;
    // die;
    if (file_exists($pagePath) && is_file($pagePath)) {
        // echo $pagePath;
        require_once $pagePath;
    } else {
        echo "<h1>Page not found 404</h1>";
    }
    require_once Config::root('view\admin\layouts\footer.php');
}