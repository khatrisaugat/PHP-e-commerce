<?php
namespace Ecommerce\Controller\ProductController;

use Ecommerce\Controller\ProductController;

$option_groups=ProductController::getOptionGroups();
$updatePage=false;
if(isset($_GET['id'])){
    if(isset($_GET['action']) && $_GET['action']=='e'){
        $updatePage=true;
        $option_group=ProductController::getOptionGroups($_GET['id']);
    }
}

?>

<!-- <div class="col-sm-6">
    <h3><?=$updatePage?"Update":"Add";?> Option Groups</h3>
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
    <form action="<?=$baseUrl?>/routes/<?=$updatePage?'updateOptionGroups?id='.$_GET['id']:'insertOptionGroups'?>" method="post">
        <div class="row">
            <label for="opt_group_name">Option Group Name</label>
            <input type="text" name="opt_group_name" class="form-control" <?php echo $updatePage?'value="'.$option_group[0]['opt_group_name'].'"':"";?>>
        </div>
        <br>
        <br>
        <div class="row">
            <button type="submit" class="btn btn-facebook" name="<?php echo $updatePage?'update':'submit';?>"><?php echo $updatePage?'update':'submit';?></button>
        </div>

    </form>

    <div class="col-sm-6">
    <h3>Option Groups</h3>
        <div class="table table-striped">
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Option Group Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($option_groups as $option_group) { ?>
                        <tr>
                            <td><?= $option_group['opt_group_id'] ?></td>
                            <td><?= $option_group['opt_group_name'] ?></td>
                            <td><a href="add_option_groups?id=<?= $option_group['opt_group_id'] ?>&action=e">Edit</a></td>
                            <!-- <td><a href="add_option_groups.php?id=<?= $option_group['opt_group_id'] ?>&action=d">Delete</a></td> -->
                            <td><a href="<?=$baseUrl?>/routes/deleteOptionGroups?did=<?=$option_group['opt_group_id']?>&action=d">Delete</a></td>

                        </tr>
                    <?php } ?>
        </div>
    </div>
</div>