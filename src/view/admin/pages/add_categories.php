<?php
use Ecommerce\Controller\ProductController;
$categories=ProductController::getCategories();
$updatePage=false;
if(isset($_GET['id'])){
    if(isset($_GET['action']) && $_GET['action']=='e'){
        $updatePage=true;
        $category=ProductController::getCategories($_GET['id']);
        

    }
}
?>

<!-- <div class="col-sm-6">
    <h3><?=$updatePage?"Update":"Add";?> Users</h3>
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
    <form action="<?=$baseUrl?>/routes/<?=$updatePage?'updateCategories?id='.$_GET['id']:'insertCategories'?>" method="post">
        <div class="row">
            <label for="cat_title">category</label>
            <input type="text" name="cat_title" class="form-control" <?php  echo $updatePage?'value="'.$category[0]['cat_title'].'"':"";?>>
        </div>
        <div class="row">
            <label for="cat_details">Category details</label>
            <input type="text" name="cat_details" class="form-control" <?php  echo $updatePage?'value="'.$category[0]['cat_details'].'"':"";?>>
        </div>
        <br>
        <br>
        <div class="row">
            <button type="submit" class="btn btn-facebook" name="<?php  echo $updatePage?'update':'submit';?>"><?php  echo $updatePage?'update':'submit';?></button>
        </div>

    </form>
    <div class="col-sm-6">
    <h3>Categories</h3>
        <div class="table table-striped">
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Category Details</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) { ?>
                        <tr>
                            <td><?php echo $category['cat_id'] ?></td>
                            <td><?php echo $category['cat_title'] ?></td>
                            <td><?php echo $category['cat_details'] ?></td>
                            <td><a href="add_categories.php?id=<?php echo $category['cat_id'] ?>&action=e">Edit</a></td>
                            <td><a href="<?=$baseUrl?>/routes/deleteCategories?did=<?=$category['cat_id']?>&action=d">Delete</a></td>
                        </tr>
                    <?php } ?>
        </div>
    </div>
</div>