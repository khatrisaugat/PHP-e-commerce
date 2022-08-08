<?php
include("indexing.php");
if(isset($_GET['indexing']) && $_GET['indexing']==1){
    Indexing($obj);
}
$joinStatement=" JOIN sub_categories ON products.sub_cat_id=sub_categories.sub_cat_id";
$joinStatement.=" JOIN categories ON sub_categories.cat_id=categories.cat_id";
$joinStatement.=" JOIN images ON products.featured_image_id=images.image_id";
$products=$obj->Select("products".$joinStatement);
if(isset($_GET['id']) && isset($_GET['action']) && $_GET['action']=='d'){
    $id=$_GET['id'];
    $product_images=$obj->Select("product_images JOIN images ON images.image_id=product_images.image_id","*","pid",array($id));

    foreach($product_images as $image){
        $obj->Delete('product_images',"pi_id",array($image['pi_id']));
        $obj->Delete("images","image_id",array($image['image_id']));
        unlink("img/".$image['image_src']);
    }
    $obj->Delete("products","pid",array($id));
    echo "<script>window.location.href='display_products.php'</script>";
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
                    <td><img src="<?= "img/".$product['image_src']; ?>" alt="<?= $product['image_alt']; ?>" width="100"></td>
                    <td><?= $product['sub_cat_title']; ?></td>
                    <td><?= $product['cat_title']; ?></td>
                    <td>
                        <a class="btn btn-primary" href="edit_products.php?id=<?= $product['pid']; ?>">Edit</a>
                        <a class="btn btn-danger" href="display_products.php?id=<?= $product['pid']; ?>&action=d">Delete</a>
                        <a class="btn btn-warning" href="add_options_to_products?id=<?=$product['pid'];?>">Add Options</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>