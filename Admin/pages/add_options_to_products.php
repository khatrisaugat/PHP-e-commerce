<?php
//delete option from products
if (isset($_GET['did'])) {
    if (isset($_GET['action']) && $_GET['action'] == 'd') {
        $id = $_GET['did'];
        $obj->Delete('product_options', "pro_opt_id", array($id));
        echo "<script>window.location.href='add_options_to_products.php?id=".$_GET['id']."'</script>";

    }
}
$option_groups=$obj->select("option_groups");
$options=$obj->select("options");
$options_in_product=$obj->select("product_options JOIN options ON options.opt_id=product_options.option_id JOIN option_groups ON option_groups.opt_group_id=option_group_id","*","product_id",array($_GET['id']));
$product=$obj->select("products JOIN images On products.featured_image_id=images.image_id","*","pid",array($_GET['id']));
// print_r($product);
if(isset($_POST['submit'])){
    unset($_POST['submit']);
    print_r($_POST);
    foreach($_POST['opt_id'] as $opt_id){
        $obj->Insert("product_options",array("product_id"=>$_GET['id'],"option_id"=>$opt_id,"option_group_id"=>$_POST['option_group_id']));
        $_SESSION['message']="Inserted Successfully"; 
    }
    echo "<script>window.location.href='add_options_to_products.php?id=".$_GET['id']."'</script>";
    
}

?>

<div class="col-sm-6">
    <h3>Add Options to <?=$product[0]['product_name'];?></h3>
    <img src="img/<?=$product[0]['image_src'];?>" alt="<?=$product['image_alt']?>" width="100">
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
    <form action="" method="post" enctype="multipart/form-data">
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
                    <td><a href="add_options_to_products.php?did=<?=$option_in_product['pro_opt_id']?>&action=d&id=<?=$_GET['id']?>">Delete</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>