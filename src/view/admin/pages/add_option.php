<?php
namespace Ecommerce\Controller\ProductController;

use Ecommerce\Controller\ProductController;

$options=ProductController::getOptions();
$updatePage=false;
if(isset($_GET['id'])){
    if(isset($_GET['action']) && $_GET['action']=='e'){
        $updatePage=true;
        $option=ProductController::getOptions($_GET['id']);
        

    }
}

?>

<!-- <div class="col-sm-6">
    <h3><?=$updatePage?"Update":"Add";?> Options</h3>
    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-success">
            <?= $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger">
            <?= $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php } ?> -->
    <form action="<?=$baseUrl?>/routes/<?=$updatePage?'updateOptions?id='.$_GET['id']:'insertOptions'?>" method="post">
        <div class="row">
            <label for="option_name">Options</label>
            <input type="text" name="option_name" class="form-control" <?php echo $updatePage?'value="'.$option[0]['option_name'].'"':"";?>>
        </div>
        <br>
        <br>
        <div class="row">
            <button type="submit" class="btn btn-facebook" name="<?php echo $updatePage?'update':'submit';?>"><?php echo $updatePage?'update':'submit';?></button>
        </div>

    </form>

    <div class="col-sm-6">
    <h3>Options</h3>
        <div class="table table-striped">
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Options</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($options as $option) { ?>
                        <tr>
                            <td><?php echo $option['opt_id'] ?></td>
                            <td><?php echo $option['option_name'] ?></td>
                            <td><a href="add_option?id=<?php echo $option['opt_id'] ?>&action=e">Edit</a></td>
                            <td><a href="<?=$baseUrl?>/routes/deleteOptions?did=<?=$option['opt_id']?>&action=d">Delete</a></td>
                        </tr>
                    <?php } ?>
        </div>
    </div>
</div>