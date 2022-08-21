<?php
namespace Ecommerce\Config;

use Ecommerce\Controller\ProductController;

class Config
{
    public static function getBaseUrl($path=''){
        $path=explode('\\',$path);
        self::$config['base_url']=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".end($path);
        return self::$config['base_url'];

    }
    public static $config = [
        'db' => [
            'host' => 'localhost',
            'user' => 'root',
            'password' => '',
            'dbname' => 'col_project'
        ],
        'site_name' => 'NepShop',
        'paths' => [
            'views' => 'views',
            'controllers' => 'controllers',
            'models' => 'models',
            'assets' => 'assets',
            'admin'=>'admin'
        ],
        'table_names'=>[
            'users'=>'users',
            'categories'=>'categories',
            'sub_categories'=>'sub_categories',
            'products'=>'products',
            'options'=>'options',
            'option_groups'=>'option_groups',
            'product_options'=>'product_options',
            'orders'=>'orders',
            'order_details'=>'order_details',
            'cart'=>'cart',
            'images'=>'images',
            'product_images'=>'product_images',
            'user_type'=>'user_type'
        ],
    ];
    public static function isAdminView($path){
        if (strpos($path, 'admin') !== false) {
            return 'true';
        }else{
            return 'false';
        }
    }
    public static function isRoutes($path){
        if (strpos($path, 'routes') !== false) {
            return 'true';
        }else{
            return 'false';
        }
    }
    public static function root($path = ''){
        $path = trim($path, '/');
        $docPath = dirname(dirname(__FILE__)) . '\\' . $path;
        return $docPath;
    }
    public static function getRoute($url=''){
        $url=explode('/',$url);
        $url=end($url);
        $url=explode('?',$url);
        $url=$url[0];
        return $url;
    }
    public static function getAssetsPath(){
        $assetsurl=self::root();
        $assetsurl=str_replace('src','assets',$assetsurl);
        return $assetsurl;
    }

//indexing
public static function Indexing(){
    $products=ProductController::getAllProducts();
    foreach ($products as $product) {
        $sound="";

        //according to product name 
        if($product['product_name']!=null){
            $words=explode(" ",$product['product_name']);
            foreach ($words as $word) {
                $word=strtolower($word);
                $sound.=metaphone($word)." ";
            }
        }
        //according to product description
        if($product['product_short_desc']!=null){
            $words=explode(" ",$product['product_short_desc']);
            foreach ($words as $word) {
                $word=strtolower($word);
                $sound.=metaphone($word)." ";
            }
        }
        //according to product category
        if($product['cat_title']!=null){
            $words=explode(" ",$product['cat_title']);
            foreach ($words as $word) {
                $word=strtolower($word);
                $sound.=metaphone($word)." ";
            }
        }
    
        //according to product sub category
        if($product['sub_cat_title']!=null){
            $words=explode(" ",$product['sub_cat_title']);
            foreach ($words as $word) {
                $word=strtolower($word);
                $sound.=metaphone($word)." ";
            }
        }
        //according to product sub category description
        if($product['sub_cat_desc']!=null){
            $words=explode(" ",$product['sub_cat_desc']);
            foreach ($words as $word) {
                $word=strtolower($word);
                $sound.=metaphone($word)." ";
            }
        }
        $updateVal['indexing']=$sound;
        // $obj->Update("products",$updateVal,"pid",array($product['pid']));
        ProductController::updateProducts($updateVal,$product['pid']);
        // echo $sound;
    //   echo $product['product_name'];
    }
}



}
