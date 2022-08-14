<?php
namespace Ecommerce\Controller;
use Ecommerce\Model\ProductModel;
use Ecommerce\Config\Config;

class ProductController{
    //insert categories
    public static function insertCategories($data){
        $productModel = new ProductModel();
        $lastInsertId=$productModel->Insert(Config::$config['table_names']['categories'],$data);
        return $lastInsertId;
    }
    //delete categories
    public static function deleteCategories($id){
        $productModel = new ProductModel();
        $productModel->delete(Config::$config['table_names']['categories'],
                                array([
                                    'field'=>'cat_id',
                                    'operator'=>'=',
                                    'value'=>$id
                                ]));
    }
    //update categories
    public static function updateCategories($data,$id){
        $productModel = new ProductModel();
        $productModel->update(Config::$config['table_names']['categories'],$data,
                                array([
                                    'field'=>'cat_id',
                                    'operator'=>'=',
                                    'value'=>$id
                                ]));
    }
    //insert subcategories
    public static function insertSubCategories($data){
        $productModel = new ProductModel();
        $lastInsertId=$productModel->Insert(Config::$config['table_names']['sub_categories'],$data);
        return $lastInsertId;
    }
    //delete subcategories
    public static function deleteSubCategories($id){
        $productModel = new ProductModel();
        return $productModel->delete(Config::$config['table_names']['sub_categories'],
                                array([
                                    'field'=>'sub_cat_id',
                                    'operator'=>'=',
                                    'value'=>$id
                                ]));
    }
    //update subcategories
    public static function updateSubCategories($data,$id){
        $productModel = new ProductModel();
        $productModel->update(Config::$config['table_names']['sub_categories'],$data,
                                array([
                                    'field'=>'sub_cat_id',
                                    'operator'=>'=',
                                    'value'=>$id
                                ]));
    }
    //insert options
    public static function insertOptions($data){
        $productModel = new ProductModel();
        $lastInsertId=$productModel->Insert(Config::$config['table_names']['options'],$data);
        return $lastInsertId;
    }
    //delete options
    public static function deleteOptions($id){
        $productModel = new ProductModel();
        $productModel->delete(Config::$config['table_names']['options'],
                                array([
                                    'field'=>'opt_id',
                                    'operator'=>'=',
                                    'value'=>$id
                                ]));
    }
    //update options
    public static function updateOptions($data,$id){
        $productModel = new ProductModel();
        $productModel->update(Config::$config['table_names']['options'],$data,
                                array([
                                    'field'=>'opt_id',
                                    'operator'=>'=',
                                    'value'=>$id
                                ]));
    }
    //insert option_groups
    public static function insertOptionGroups($data){
        $productModel = new ProductModel();
        $lastInsertId=$productModel->Insert(Config::$config['table_names']['option_groups'],$data);
        return $lastInsertId;
    }
    //delete option_groups
    public static function deleteOptionGroups($id){
        $productModel = new ProductModel();
        $productModel->delete(Config::$config['table_names']['option_groups'],
                                array([
                                    'field'=>'opt_group_id',
                                    'operator'=>'=',
                                    'value'=>$id
                                ]));
    }
    //update option_groups
    public static function updateOptionGroups($data,$id){
        $productModel = new ProductModel();
        $productModel->update(Config::$config['table_names']['option_groups'],$data,
                                array([
                                    'field'=>'opt_group_id',
                                    'operator'=>'=',
                                    'value'=>$id
                                ]));
    }
    //insert product options
    public static function insertProductOptions($data){
        $productModel = new ProductModel();
            foreach($data['opt_id'] as $opt_id){
        //$obj->Insert("product_options",array("product_id"=>$_GET['id'],"option_id"=>$opt_id,"option_group_id"=>$_POST['option_group_id']));
        $lastInsertId=$productModel->Insert(Config::$config['table_names']['product_options'],array(
                                            "product_id"=>$_GET['id'],
                                            "option_id"=>$opt_id,
                                            "option_group_id"=>$data['option_group_id']));
        // $_SESSION['message']="Inserted Successfully"; 
    }
        return $lastInsertId;
    }
    //delete product options
    public static function deleteProductOptions($id){
        $productModel = new ProductModel();
        $productModel->delete(Config::$config['table_names']['product_options'],
                                array([
                                    'field'=>'pro_opt_id',
                                    'operator'=>'=',
                                    'value'=>$id
                                ]));
    }
    //insert product
    public static function insertProducts($data,$files){
        $productModel = new ProductModel();
        // $data['featured_image_id']=$featured_image;
        $lastInsertId['pid']=$productModel->Insert(Config::$config['table_names']['products'],$data);
        $featured['featured_image_id']=self::insertImages($files,$lastInsertId['pid']);
        $productModel->Update(Config::$config['table_names']['products'],$featured,
                            array(['field'=>'pid','operator'=>'=','value'=>$lastInsertId['pid']]));
        Config::Indexing();
        return $lastInsertId;
    }
    //delete product
    public static function deleteProducts($id){
        $productModel = new ProductModel();
            // $product_images=$obj->Select("product_images JOIN images ON images.image_id=product_images.image_id","*","pid",array($id));
            $product_images=$productModel->getAll("product_images",
                                            array(['table'=>'images','on'=>'images.image_id=product_images.image_id']),
                                            array(['field'=>'pid','operator'=>'=','value'=>$id]));

            foreach($product_images as $image){
                // $obj->Delete('product_images',"pi_id",array($image['pi_id']));
                // $obj->Delete("images","image_id",array($image['image_id']));
                $productModel->delete(Config::$config['table_names']['product_images'],
                                array([
                                    'field'=>'pi_id',
                                    'operator'=>'=',
                                    'value'=>$image['pi_id']
                                ]));
                $productModel->delete(Config::$config['table_names']['images'],
                                        array([
                                            'field'=>'image_id',
                                            'operator'=>'=',
                                            'value'=>$image['image_id']
                                        ]));
                unlink(Config::getAssetsPath()."/images/".$image['image_src']);
            }
            // $obj->Delete("products","pid",array($id));
        $productModel->delete(Config::$config['table_names']['products'],
                                array([
                                    'field'=>'pid',
                                    'operator'=>'=',
                                    'value'=>$id
                                ]));
    }
    //insert images
    public static function insertImages($data,$product_id){
        $productModel = new ProductModel();
        $images=[];
        $featured=0;
        foreach($data['product_images']['tmp_name'] as $key=>$tmp_name){
            $file_name = $data['product_images']['name'][$key];
            // $file_size = $data['product_images']['size'][$key];
            $file_tmp = $data['product_images']['tmp_name'][$key];
            
            // $file_type = $data['product_images']['type'][$key];
            $file_ext  = pathinfo($file_name, PATHINFO_EXTENSION);;
            $extensions = array("jpeg","jpg","png");
            if(in_array($file_ext,$extensions)=== false){
                $_SESSION['error']="extension not allowed, please choose a JPEG or PNG file.";
                echo $_SESSION['error'];
                die();
                header("Location: add_products.php");
                exit;
            }else{
                $newName = uniqid().$file_name;
                $insert_id=0;
                if(move_uploaded_file($file_tmp,Config::getAssetsPath()."/images/".$newName)){
                    //  $insert_id=$obj->Insert("images",array("image_alt"=>$file_name,"image_src"=>$newName));
                    $insert_id=$productModel->Insert(Config::$config['table_names']['images'],array("image_alt"=>$file_name,"image_src"=>$newName));
                    $images[]=$insert_id;
                }
                if($key==0){
                    $featured=$insert_id;
                }
            }
        }
        foreach($images as $image){
        //$obj->Insert("product_images",array("pid"=>$id,"image_id"=>$image));
        $productModel->Insert(Config::$config['table_names']['product_images'],["pid"=>$product_id,"image_id"=>$image]);
        }
        return $featured;
    }
    //set featured image
    public static function setFeaturedImage($data,$id){
        $productModel = new ProductModel();
        $productModel->Update(Config::$config['table_names']['products'],array("featured_image_id"=>$data['featured_image_id']),
                            array(['field'=>'pid','operator'=>'=','value'=>$id]));
    }

    //delete product image
    public static function deleteImage($id){
        $productModel = new ProductModel();
        //     if($id==$product[0]['featured_image_id']){
        //         $_SESSION['error'] = "Featured image cannot be deleted";
        //     }
        //     $obj->delete('product_images',"image_id",array($id));
        //     $image=$obj->select("images","*","image_id",array($id));
        //     unlink("img/".$image[0]['image_src']);
        //     $obj->delete('images',"image_id",array($id));
        $productModel->delete(Config::$config['table_names']['product_images'],
                                array([
                                    'field'=>'image_id',
                                    'operator'=>'=',
                                    'value'=>$id
                                ]));
        $image=$productModel->getAll("images",
                                    array(),
                                    array(['field'=>'image_id','operator'=>'=','value'=>$id]));
        unlink(Config::getAssetsPath()."/images/".$image[0]['image_src']);
        $productModel->delete(Config::$config['table_names']['images'],
                                array([
                                    'field'=>'image_id',
                                    'operator'=>'=',
                                    'value'=>$id
                                ]));
    }
    //add images to product
    public static function addImagesToProduct($data,$id){
        $productModel = new ProductModel();
        $images=[];
        $featured=0;
        foreach($data['product_images']['tmp_name'] as $key=>$tmp_name){
            $file_name = $data['product_images']['name'][$key];
            // $file_size = $data['product_images']['size'][$key];
            $file_tmp = $data['product_images']['tmp_name'][$key];
            // $file_type = $data['product_images']['type'][$key];
            $file_ext  = pathinfo($file_name, PATHINFO_EXTENSION);;
            $extensions = array("jpeg","jpg","png");
            if(in_array($file_ext,$extensions)=== false){
                $_SESSION['error']="extension not allowed, please choose a JPEG or PNG file.";
                echo $_SESSION['error'];
                die();
                header("Location: edit_products?id=".$id);
                exit;
            }else{
                $newName = uniqid().$file_name;
                $insert_id=0;
                if(move_uploaded_file($file_tmp,Config::getAssetsPath()."/images/".$newName)){
                    $insert_id=$productModel->Insert(Config::$config['table_names']['images'],array("image_alt"=>$file_name,"image_src"=>$newName));
                    $productModel->Insert(Config::$config['table_names']['product_images'],["pid"=>$id,"image_id"=>$insert_id]);
                }
            }
        }
    }
    //update product
    public static function updateProducts($data,$id){
        $productModel = new ProductModel();
        $productModel->Update(Config::$config['table_names']['products'],$data,
                            array(['field'=>'pid','operator'=>'=','value'=>$id]));
    }
    //get categories
    public static function getCategories($id=0){
        $productModel = new ProductModel();
        if($id>0){
            return $productModel->getAll(Config::$config['table_names']['categories'],[],
                                            array(['field'=>'cat_id','operator'=>'=','value'=>$id]));
        }else{
            return $productModel->getAll(Config::$config['table_names']['categories']);
        }
        // return $result;
    }
    //get subcategories
    public static function getSubCategories($id=0){
        $productModel = new ProductModel();
        if($id==0){
        //getAll(tablename,join,where,clause)
        //tablename=string,join=array(['table'=>'','on'=>''])
        //where=array(['field'=>'','operator'=>'','value'=''])
        //clause=array(['type'=>'','operator'=>'','value'=''])
        return $productModel->getAll(Config::$config['table_names']['sub_categories'],
                                        array(['table'=>'categories','on'=>'sub_categories.cat_id = categories.cat_id'])
                                        );
        }else{
            return $productModel->getAll(Config::$config['table_names']['sub_categories'],
            array(['table'=>'categories','on'=>'sub_categories.cat_id = categories.cat_id']),
            array(['field'=>'sub_cat_id','operator'=>'=','value'=>$id]));
        }
    }
    //get subcategories by category id
    public static function getSubCategoriesByCategoryId($id){
        $productModel = new ProductModel();
        return $productModel->getAll(Config::$config['table_names']['sub_categories'],
                                        array(['table'=>'categories','on'=>'sub_categories.cat_id = categories.cat_id']),
                                        array(['field'=>'categories.cat_id','operator'=>'=','value'=>$id]));
    }
    //get options
    public static function getOptions($id=0){
        $productModel = new ProductModel();
        if($id==0){
            return $productModel->getAll(Config::$config['table_names']['options']);
        }else{
            return $productModel->getAll(Config::$config['table_names']['options'],[],
                                            array(['field'=>'opt_id','operator'=>'=','value'=>$id]));
        }
        //return $result;
    }
    //get option_groups
    public static function getOptionGroups($id=0){
        $productModel = new ProductModel();
        if($id==0){
            return $productModel->getAll(Config::$config['table_names']['option_groups']);
        }else{
            return $productModel->getAll(Config::$config['table_names']['option_groups'],[],
                                            array(['field'=>'opt_group_id','operator'=>'=','value'=>$id]));
        }
    }
    //get orders    
    public static function getOrderDetails(){
        $productModel = new ProductModel();
        $result = $productModel->getAll(Config::$config['table_names']['order_details'],
                                        array(['table'=>'orders','on'=>'orders.oid = order_details.oid'],
                                            ['table'=>'users','on'=>'users.uid = orders.uid'],
                                            ['table'=>'products','on'=>'products.pid=order_details.pid'])
                                        );
        return $result;
    }
    //update order
    public static function updateOrders($data){
        $productModel = new ProductModel();
        $id=$data['oid'];
        unset($data['oid']);
        $productModel->update(Config::$config['table_names']['orders'],$data,
                                array(['field'=>'oid','operator'=>'=','value'=>$id]));
    }
    //get all products
    public static function getAllProducts($limit='',$orderby=''){
        $productModel = new ProductModel();
        if($limit!=''){
            $result = $productModel->getAll(Config::$config['table_names']['products'],
                                            array(['table'=>'images','on'=>'images.image_id = products.featured_image_id'],
                                            ['table'=>'sub_categories','on'=>'sub_categories.sub_cat_id=products.sub_cat_id'],
                                            ['table'=>'categories','on'=>'categories.cat_id=sub_categories.cat_id']),
                                            array(),array(['type'=>'ORDER BY','operator'=>'pid','value'=>$orderby],['type'=>'LIMIT','value'=>$limit]));
        }else{
        $result = $productModel->getAll(Config::$config['table_names']['products'],
                                        array(['table'=>'images','on'=>'images.image_id = products.featured_image_id'],
                                        ['table'=>'sub_categories','on'=>'sub_categories.sub_cat_id=products.sub_cat_id'],
                                        ['table'=>'categories','on'=>'categories.cat_id=sub_categories.cat_id']
                                        )
                                        );
        }
        return $result;
    }
    //get product by id
    public static function getProductById($id){
        $productModel = new ProductModel();
        $result = $productModel->getAll(Config::$config['table_names']['products'],
                                        array(['table'=>'images','on'=>'images.image_id = products.featured_image_id'],
                                        ['table'=>'sub_categories','on'=>'sub_categories.sub_cat_id=products.sub_cat_id'],
                                        ['table'=>'categories','on'=>'categories.cat_id=sub_categories.cat_id']
                                        ),
                                        array(['field'=>'products.pid','operator'=>'=','value'=>$id])
                                        );
        return $result;
    }
    //get products
    public static function getProducts($field='',$operator='',$value='',$limit='',$groupby=''){
        $productModel = new ProductModel();
        if($limit==''){
            return $productModel->getAll(Config::$config['table_names']['products'],
                                        array(
                                            ['table'=>'images','on'=>'images.image_id = products.featured_image_id'],
                                            ['table'=>'sub_categories','on'=>'sub_categories.sub_cat_id=products.sub_cat_id'],
                                            ['table'=>'categories','on'=>'categories.cat_id=sub_categories.cat_id']),
                                        array(
                                            ['field'=>$field,'operator'=>$operator,'value'=>$value]),
                                        array(
                                            ['type'=>'GROUP BY','value'=>$groupby])
                                        );
        }
        return $productModel->getAll(Config::$config['table_names']['products'],
                                        array(['table'=>'images','on'=>'images.image_id = products.featured_image_id'],
                                        ['table'=>'sub_categories','on'=>'sub_categories.sub_cat_id=products.sub_cat_id'],
                                        ['table'=>'categories','on'=>'categories.cat_id=sub_categories.cat_id']),
                                        array(['field'=>$field,'operator'=>$operator,'value'=>$value]),
                                        array(['type'=>'GROUP BY','value'=>$groupby],
                                        ['type'=>'LIMIT','value'=>$limit]));

    }
    //get product images
    public static function getProductImages($id){
        $productModel = new ProductModel();
        $result = $productModel->getAll(Config::$config['table_names']['product_images'],
                                        array(['table'=>'images','on'=>'images.image_id = product_images.image_id']),
                                        array(['field'=>'product_images.pid','operator'=>'=','value'=>$id])
                                        );
        return $result;
    }
    //get options in product
    public static function getOptionsInProduct($id){
        $productModel = new ProductModel();
        $result = $productModel->getAll(Config::$config['table_names']['product_options'],
                                        array(['table'=>'options','on'=>'options.opt_id=product_options.option_id'],
                                        ['table'=>'option_groups','on'=>'option_groups.opt_group_id=option_group_id']
                                        ),
                                        array(['field'=>'product_options.product_id','operator'=>'=','value'=>$id])
                                        );
        return $result;
    }
    //get option groups in product
    public static function getOptionGroupsInProduct($id){
        $productModel = new ProductModel();
        $result = $productModel->getAll(Config::$config['table_names']['product_options'],
                                        array(['table'=>'option_groups','on'=>'option_groups.opt_group_id=product_options.option_group_id']),
                                        array(['field'=>'product_options.product_id','operator'=>'=','value'=>$id]),
                                        array(['type'=>'GROUP BY','value'=>'opt_group_id'])
                                        );
                                        // die;
        return $result;
    }
    
    //get options by product id and opiton group id
    public static function getOptionsByProductIdAndOptionGroupId($product_id,$option_group_id){
        $productModel = new ProductModel();
        $result = $productModel->getAll(Config::$config['table_names']['product_options'],
                                        array(['table'=>'options','on'=>'options.opt_id=product_options.option_id']),
                                        array(['field'=>'product_options.product_id','operator'=>'=','value'=>$product_id],
                                            ['field'=>'AND product_options.option_group_id','operator'=>'=','value'=>$option_group_id])
                                        );
        return $result;
    }
    //get products by subcategory id
    public static function getProductsBySubCategoryId($id){
        $productModel = new ProductModel();
        $result = $productModel->getAll(Config::$config['table_names']['products'],
                                        array(['table'=>'images','on'=>'images.image_id = products.featured_image_id'],
                                        ['table'=>'sub_categories','on'=>'sub_categories.sub_cat_id=products.sub_cat_id'],
                                        ['table'=>'categories','on'=>'categories.cat_id=sub_categories.cat_id']
                                        ),
                                        array(['field'=>'products.sub_cat_id','operator'=>'=','value'=>$id])
                                        );
        return $result;
    }
    //get products by category id
    public static function getProductsByCategoryId($id){
        $productModel = new ProductModel();
        $result = $productModel->getAll(Config::$config['table_names']['products'],
                                        array(['table'=>'images','on'=>'images.image_id = products.featured_image_id'],
                                        ['table'=>'sub_categories','on'=>'sub_categories.sub_cat_id=products.sub_cat_id'],
                                        ['table'=>'categories','on'=>'categories.cat_id=sub_categories.cat_id']
                                        ),
                                        array(['field'=>'categories.cat_id','operator'=>'=','value'=>$id])
                                        );
        return $result;
    }

    //insert product to cart
    public static function insertProductsToCart($data){
        $productModel = new ProductModel();
        $result = $productModel->insert(Config::$config['table_names']['cart'],
                                        array('pid'=>$data['pid'],
                                            'quantity'=>$data['quantity'],
                                            'uid'=>$_SESSION['uid'],
                                            'price'=>$data['price'],
                                            'description'=>json_encode($data)
                                        )
                                        );
        return $result;
    }
    //get cart products
    public static function getCartProducts(){
        $productModel = new ProductModel();
        $result = $productModel->getAll(Config::$config['table_names']['cart'],
                                        array(['table'=>'products','on'=>'products.pid=cart.pid'],
                                        ['table'=>'images','on'=>'images.image_id = products.featured_image_id']
                                        ),
                                        array(['field'=>'cart.uid','operator'=>'=','value'=>$_SESSION['uid']])
                                        );
        return $result;
    }
    //update cart
    public static function updateCart($data,$id){
        $productModel = new ProductModel();
        // print_r($data);
        // die;
        $result = $productModel->update(Config::$config['table_names']['cart'],
                                        $data,
                                        array(['field'=>'cid','operator'=>'=','value'=>$id])
                                        );
        return $result;
    }
    //delete cart product
    public static function removeProductFromCart($id){
        $productModel = new ProductModel();
        $result = $productModel->delete(Config::$config['table_names']['cart'],
                                        array(['field'=>'cid','operator'=>'=','value'=>$id])
                                        );
        return $result;
    }
    //get count of cart products by user id 
    public static function getCountOfCartProductsByUserId(){
        $productModel = new ProductModel();
        $result = $productModel->getAll(Config::$config['table_names']['cart'],[],
                                        array(['field'=>'uid','operator'=>'=','value'=>$_SESSION['uid']])
                                        );
        return count($result);
    }

    //checkout products
    public static function checkout($data){
        $productModel = new ProductModel();
        if(AuthController::isUserLoggedIn()){
            $cart=$productModel->getAll(Config::$config['table_names']['cart'],
                                        array(['table'=>'products','on'=>'products.pid=cart.pid']),
                                        array(['field'=>'cart.uid','operator'=>'=','value'=>$_SESSION['uid']])
                                        );
            $oid=$productModel->insert(Config::$config['table_names']['orders'],
                                        array("uid"=>$_SESSION['uid'],
                                        "order_amount"=>$data['amount'],
                                        "order_address"=>$_POST['delivery_address'],
                                        "order_phone"=>$_POST['phone']));
            foreach($cart as $c){
                $productModel->insert(Config::$config['table_names']['order_details'],
                                        array("oid"=>$oid,"pid"=>$c['pid'],
                                        "detailName"=>$c['product_name']."X".$c['quantity'],
                                        "detailPrice"=>$c['price'],"detailQuantity"=>$c['quantity'],
                                        "detailDescription"=>$c['description']));
            }
            $productModel->delete(Config::$config['table_names']['cart'],
                                        array(['field'=>'cart.uid','operator'=>'=','value'=>$_SESSION['uid']])
                                        );
    }
}
    


}