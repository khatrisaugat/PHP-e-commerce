<?php
session_start();
require_once('./vendor/autoload.php');
use Ecommerce\Config\Config;
use Ecommerce\Config\Db;

//getting the base url
$baseUrl=Config::getBaseUrl(__DIR__);
//making a connection to the database
$Db=Db::Instance();

//check if the user is customer or admin
$isAdmin= Config::isAdminView($_SERVER['REQUEST_URI']);
$isRoutes= Config::isRoutes($_SERVER['REQUEST_URI']);
if($isRoutes=='true'){
    
    if(isset($_GET['url'])){
        require_once('./src/routes/Routes.php');
    }
}
$url = isset($_GET['url']) && $_GET['url']!='admin' ? $_GET['url'] : 'home';

$url = str_replace('.php', '', $url);

$url .= '.php';

$pagePath="";
// echo "main index";
//if the user is admin then redirect to the admin page
if($isAdmin=='true'){
    $url=str_replace('admin/','',$url);
    // echo $url;
    $pathUptoPages=$baseUrl.'/admin/';
    $pagePath = Config::root('view\admin\pages\\' . $url);
    require_once(Config::root("view\admin\index.php"));
    // echo $pagePath;
    // die;
    
}else{
    $pathUptoPages=$baseUrl.'/views/pages/';
    $pagePath = Config::root('view\pages\\' . $url);
    require_once(Config::root("view\index.php"));
}

// echo $baseUrl;
