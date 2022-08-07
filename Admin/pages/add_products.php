<?php
$sub_categories=$obj->select("sub_categories");
//insert data
if (isset($_POST['submit'])) {
    unset($_POST['submit']);
    $images=[];
    foreach($_FILES['product_images']['tmp_name'] as $key=>$tmp_name){
        $file_name = $_FILES['product_images']['name'][$key];
        $file_size = $_FILES['product_images']['size'][$key];
        $file_tmp = $_FILES['product_images']['tmp_name'][$key];
        $file_type = $_FILES['product_images']['type'][$key];
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
            if(move_uploaded_file($file_tmp,"img/".$newName)){
                $insert_id=$obj->Insert("images",array("image_alt"=>$file_name,"image_src"=>$newName));
                $images[]=$insert_id;
            }
            if($key==0){
                $_POST['featured_image_id']=$insert_id;
            }
        }
    }
    $id = $obj->Insert("products", $_POST);
    foreach($images as $image){
        $obj->Insert("product_images",array("pid"=>$id,"image_id"=>$image));
    }
    if ($id) {
        $_SESSION['message'] = "Product Successfully added";
    } else{
        $_SESSION['error'] = "Failed to add product";
    }
}

?>
<div class="col-sm-6">
    <h3>Add Products</h3>
        <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-success">
                    <?= $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" class="form-control">
        </div>
        <div class="row">
            <label for="product_brand">Brand Name</label>
            <input type="text" name="product_brand" class="form-control">
        </div>
        <div class="row">
            <label for="product_price">Product Price</label>
            <input type="text" name="product_price" class="form-control">
        </div>
        <div class="row">
            <label for="product_short_desc">Product Description-Short</label>
            <input type="text" name="product_short_desc" class="form-control">
        </div>
       
        <div class="row">
            <label for="product_desc">Product Description-Long</label>
            <textarea name="product_desc" class="form-control"></textarea>
        </div>
        <div class="row">
            <label for="sub_cat_id">Sub Category</label>
            <select name="sub_cat_id" class="form-control">
                <?php foreach ($sub_categories as $sub_category) { ?>
                    <option value="<?= $sub_category['sub_cat_id'] ?>"><?= $sub_category['sub_cat_title'] ?></option>
                <?php } ?>
            </select>
        </div>    
        <div class="row">
            <label for="product_images[]">Product Image</label>
        </div>
        <div class="row">
            <input type="file" name="product_images[]"  multiple>
        </div>
        <br>
        <div class="row">
            <button type="submit" class="btn btn-facebook" name="submit">Submit</button>
        </div>
    </form>
</div>