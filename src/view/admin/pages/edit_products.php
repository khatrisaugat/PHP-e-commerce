<?php
use Ecommerce\Controller\ProductController;
$product=ProductController::getProductById($_GET['id']);
$images=ProductController::getProductImages($_GET['id']);
$sub_categories=ProductController::getSubCategories();


?>
<div class="col-sm-6">
    <h3>Add Products</h3>
        <!-- <?php if (isset($_SESSION['message'])) { ?>
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
            <?php } ?> -->
    <form action="<?=$baseUrl?>/routes/updateProduct?id=<?=$_GET['id'];?>" method="post" enctype="multipart/form-data">
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
        <br>
        <div class="row">
            <button type="submit" class="btn btn-facebook" name="update">Update</button>
        </div>
    </form>
    <form action="<?=$baseUrl?>/routes/addImagesToProduct?id=<?=$_GET['id']?>" method="POST" enctype="multipart/form-data">
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
                <td><img src="<?=$baseUrl."/assets/images/". $image['image_src']; ?>" alt="<?=$image['image_alt'];?>" width="100"></td>
                <td>
                    <?php
                    if($product[0]['featured_image_id']==$image['image_id']){
                        echo "N/A";
                    }else{?>
                    <!-- <a href="edit_products.php?iid=<?= $image['image_id'] ?>&action=d&id=<?=$_GET['id']?>">Delete</a> -->
                    <a href="<?=$baseUrl?>/routes/deleteImage?did=<?=$image['image_id']?>&action=d&id=<?=$_GET['id']?>">Delete</a>
                    <?php } ?>
                </td>
                <form action="<?=$baseUrl?>/routes/setFeaturedImage?id=<?=$_GET['id']?>" method="POST">
                <td>
                    <?php
                    if($product[0]['featured_image_id']==$image['image_id']){
                        echo "Featured Image";
                    }else{
                        ?>
                        <input type="hidden" name="featured_image_id" value="<?=$image['image_id'];?>">
                        <input type="submit" name="submit"  value="Set as Featured" class="btn btn-danger">
                        
                        <?php
                    }
                    ?>
                </td>
                </form>
            </tr>
        <?php } ?>
    </table>
</div>