<?php
function Indexing($obj){
    $joinQuery="  JOIN sub_categories ON sub_categories.sub_cat_id=products.sub_cat_id JOIN categories ON categories.cat_id=sub_categories.cat_id";
    $products=$obj->Select("products".$joinQuery,"*");
    // print_r($products);
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
        $obj->Update("products",$updateVal,"pid",array($product['pid']));
        // echo $sound;
    //   echo $product['product_name'];
    }
}

