<?php
use Ecommerce\Controller\ProductController;
$product=ProductController::getProductById($_GET['id']);
// print_r($product);
$option_groups=ProductController::getOptionGroups();
$options=ProductController::getOptions();
$options_in_product=ProductController::getOptionsInProduct($_GET['id']);

?>

<div class="col-sm-6">
    <h3>Add Options to <?=$product[0]['product_name'];?></h3>
    <img src="<?=$baseUrl. '/assets/images/'.$product[0]['image_src'];?>" alt="<?=$product['image_alt']?>" width="100">
    <p><?=$product[0]['product_short_desc']?></p>
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
    <form action="<?=$baseUrl?>/routes/insertProductOptions?id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <label for="option_group_id">Option group</label>
        <Select name="option_group_id" class="form-control">
            <?php foreach ($option_groups as $option_group) { ?>
                <option value="<?= $option_group['opt_group_id'] ?>"><?= $option_group['opt_group_name'] ?></option>
                <?php } ?>
        </Select>
    </div>
    <div class="row">
        <label for="option_name">Select Options for product</label>
        <br>
            <?php foreach ($options as $option) { ?>
                <input type="checkbox" value="<?= $option['opt_id'] ?>" name="opt_id[]"><?= $option['option_name'] ?></input>
                <?php } ?>
    </div>
    <br>
    <div class="row">
        <button type="submit" class="btn btn-facebook" name="submit">Submit</button>
    </div>
    </form>


</div>
<div class="col-sm-6">
    <table class="table table-striped table-responsive table-bordered">
        <thead>
            <tr>
                <th>Option Group</th>
                <th>Option Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($options_in_product as $option_in_product) { ?>
                <tr>
                    <td><?= $option_in_product['opt_group_name'] ?></td>
                    <td><?= $option_in_product['option_name'] ?></td>
                    <td><a href="<?=$baseUrl?>/routes/deleteProductOptions?did=<?=$option_in_product['pro_opt_id']?>&action=d&id=<?=$_GET['id']?>">Delete</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>