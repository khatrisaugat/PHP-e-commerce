<?php
//set featured image
if(isset($_POST['featured'])){
    unset($_POST['featured']);
    $obj->Update("products",array("featured_image_id"=>$_POST['featured_image_id']),"pid",array($_GET['id']));
}
$sub_categories=$obj->select("sub_categories");
$product=$obj->select("products","*","pid",array($_GET['id']));
$images=$obj->select("product_images JOIN images ON images.image_id=product_images.image_id","*","pid",array($_GET['id']));
//insert data
if (isset($_POST['update'])) {
    unset($_POST['update']);
    $obj->Update("products", $_POST, "pid", array($_GET['id']));
    $_SESSION['message'] = "Product Successfully updated";
    echo "<script>window.location.href='display_products.php'</script>";
}

//delete image
if (isset($_GET['iid']) && isset($_GET['action']) && $_GET['action']=='d') {
    $id = $_GET['iid'];
    if($id==$product[0]['featured_image_id']){
        $_SESSION['error'] = "Featured image cannot be deleted";
    }
    $obj->delete('product_images',"image_id",array($id));
    $image=$obj->select("images","*","image_id",array($id));
    unlink("img/".$image[0]['image_src']);
    $obj->delete('images',"image_id",array($id));
    $_SESSION['message'] = "Image Successfully deleted";
    echo "<script>window.location.href='edit_products.php?id=".$_GET['id']."'</script>";
}

//add Image
if(isset($_POST['addImage'])){
    unset($_POST['addImage']);
    // print_r($_FILES['product_images']);
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
            // echo $_SESSION['error'];
            // die();
            header("Location: display_products.php");
            exit;
        }else{
            $newName = uniqid().$file_name;
            if(move_uploaded_file($file_tmp,"img/".$newName)){
                $insert_id=$obj->Insert("images",array("image_alt"=>$file_name,"image_src"=>$newName));
                $obj->Insert("product_images",array("pid"=>$_GET['id'],"image_id"=>$insert_id));

            }
            echo "<script>window.location.href='edit_products.php?id=".$_GET['id']."'</script>";
            
        }
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
            <input type="text" name="product_name" class="form-control" value="<?=$product[0]['product_name'];?>">
        </div>
        <div class="row">
            <label for="product_brand">Brand Name</label>
            <input type="text" name="product_brand" class="form-control" value="<?=$product[0]['product_brand'];?>">
        </div>
        <div class="row">
            <label for="product_price">Product Price</label>
            <input type="text" name="product_price" class="form-control" value="<?=$product[0]['product_price'];?>">
        </div>
        <div class="row">
            <label for="product_short_desc">Product Description-Short</label>
            <input type="text" name="product_short_desc" class="form-control" value="<?=$product[0]['product_short_desc'];?>">
        </div>
       
        <div class="row">
            <label for="product_desc">Product Description-Long</label>
            <textarea name="product_desc" class="form-control">
                <?=$product[0]['product_desc'];?>
            </textarea>
        </div>
        <div class="row">
            <label for="sub_cat_id">Sub Category</label>
            <select name="sub_cat_id" class="form-control">
                <?php foreach ($sub_categories as $sub_category) { ?>
                    <option value="<?= $sub_category['sub_cat_id'] ?>"
                    <?=$product[0]['sub_cat_id']==$sub_category['sub_cat_id']?"selected":"";?>
                    ><?= $sub_category['sub_cat_title'] ?></option>
                <?php } ?>
            </select>
        </div>    
        <!-- <div class="row">
            <label for="product_images[]">Product Image</label>
        </div>
        <div class="row">
            <input type="file" name="product_images[]"  multiple>
        </div> -->
        <br>
        <div class="row">
            <button type="submit" class="btn btn-facebook" name="update">Update</button>
        </div>
    </form>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <label for="product_images[]">Product Image</label>
            <input type="file" name="product_images[]" class="form-control" multiple>
            <input type="submit" name="addImage" value="Add Image">
        </div>
    </form>
    <table class="table table-responsive table-striped">
        <tr>
            <th>Image</th>
            <th>Action</th>
            <th>Status</th>
        </tr>
        <?php foreach ($images as $image) { ?>
            <tr>
                <td><img src="img/<?= $image['image_src']; ?>" alt="<?=$image['image_alt'];?>" width="100"></td>
                <td>
                    <?php
                    if($product[0]['featured_image_id']==$image['image_id']){
                        echo "N/A";
                    }else{?>
                    <a href="edit_products.php?iid=<?= $image['image_id'] ?>&action=d&id=<?=$_GET['id']?>">Delete</a>
                    <?php } ?>
                </td>
                <form action="" method="POST">
                <td>
                    <?php
                    if($product[0]['featured_image_id']==$image['image_id']){
                        echo "Featured Image";
                    }else{
                        ?>
                        <input type="hidden" name="featured_image_id" value="<?=$image['image_id'];?>">
                        <input type="submit" name="featured"  value="Set as Featured" class="btn btn-danger">
                        
                        <?php
                    }
                    ?>
                </td>
                </form>
            </tr>
        <?php } ?>
    </table>
</div>