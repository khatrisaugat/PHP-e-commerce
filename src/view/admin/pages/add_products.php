<?php

use Ecommerce\Config\Config;
use Ecommerce\Controller\ProductController;
$sub_categories = ProductController::getSubCategories();

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
    <form action="<?=$baseUrl?>/routes/insertProduct" method="post" enctype="multipart/form-data">
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
                <option value="" selected disabled>Select Sub Category</option>
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