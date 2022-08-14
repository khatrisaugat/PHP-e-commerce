<?php

use Ecommerce\Config\Config;
use Ecommerce\Controller\ProductController;
$products = ProductController::getAllProducts();
if(isset($_GET['indexing']) && $_GET['indexing']==1){
    Config::Indexing();
}
?>

<div class="container">
    <div class="col-sm-12">
    <h3>View Products</h3>
    <a class="btn btn-danger" href="display_products?indexing=1">Index products</a>
        <table class="table table-bordered table-responsive table-striped ">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Product Title</th>
                    <th>Brand</th>
                    <th>Short Description</th>
                    <th>long Description</th>
                    <th>price</th>
                    <th>Featured Image</th>
                    <th>Sub-Category</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) { ?>
                <tr>
                    <td><?= $product['pid']; ?></td>
                    <td><?= $product['product_name']; ?></td>
                    <td><?= $product['product_brand']; ?></td>
                    <td><?= $product['product_short_desc']; ?></td>
                    <td><?= $product['product_desc']; ?></td>
                    <td><?= $product['product_price']; ?></td>
                    <td><img src="<?=$baseUrl. '/assets/images/'.$product['image_src']; ?>" alt="<?= $product['image_alt']; ?>" width="100"></td>
                    <td><?= $product['sub_cat_title']; ?></td>
                    <td><?= $product['cat_title']; ?></td>
                    <td>
                        <a class="btn btn-primary" href="edit_products.php?id=<?= $product['pid']; ?>">Edit</a>
                        <a class="btn btn-danger" href="<?=$baseUrl?>/routes/deleteProduct?did=<?=$product['pid']?>&action=d">Delete</a>
                        <a class="btn btn-warning" href="add_options_to_products?id=<?=$product['pid'];?>">Add Options</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>