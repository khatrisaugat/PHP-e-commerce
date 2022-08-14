<?php
use Ecommerce\Controller\ProductController;
$sub_categories = ProductController::getSubCategories();
$categories = ProductController::getCategories();
$updatePage=false;
if(isset($_GET['id'])){
    if(isset($_GET['action']) && $_GET['action']=='e'){
        $updatePage=true;
        $subCategory=ProductController::getSubCategories($_GET['id']);
        

    }
}
?>

<!-- <div class="col-sm-6">
    <h3><?=$updatePage?"Update":"Add";?> Sub-Category</h3>
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
    <form action="<?=$baseUrl?>/routes/<?=$updatePage?'updateSubCategories?id='.$_GET['id']:'insertSubCategories'?>" method="post">
        <div class="row">
            <label for="sub_cat_title">Sub-category title</label>
            <input type="text" name="sub_cat_title" class="form-control" <?php echo $updatePage?'value="'.$subCategory[0]['sub_cat_title'].'"':"";?>>
        </div>
        <div class="row">
            <label for="sub_cat_desc">Sub-category details</label>
            <input type="text" name="sub_cat_desc" class="form-control" <?php echo $updatePage?'value="'.$subCategory[0]['sub_cat_desc'].'"':"";?>>
        </div>
        <div class="row">
        <label for="cat_id">Category</label>
            <select name="cat_id" class="form-control">
                <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo  $category['cat_id'] ?>" <?php if($updatePage){
                        echo $subCategory[0]['cat_id']==$category['cat_id']? "selected":"";
                    }?>><?php echo  $category['cat_title'] ?></option>
                    <?php } ?>
            </select>
        </div>
        <br>
        <br>
        <div class="row">
            <button type="submit" class="btn btn-facebook" name="<?php echo $updatePage?'update':'submit';?>"><?php echo $updatePage?'update':'submit';?></button>
        </div>

    </form>

    <div class="col-sm-6">
    <h3>Categories</h3>
        <div class="table table-striped">
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sub-Category</th>
                        <th>Sub-Category Details</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sub_categories as $sub_category) { ?>
                        <tr>
                            <td><?php echo  $sub_category['sub_cat_id'] ?></td>
                            <td><?php echo  $sub_category['sub_cat_title'] ?></td>
                            <td><?php echo  $sub_category['sub_cat_desc'] ?></td>
                            <td><?php echo  $sub_category['cat_title'] ?></td>
                            <td><a href="add_sub_categories?id=<?php echo  $sub_category['sub_cat_id'] ?>&action=e">Edit</a></td>
                            <td><a href="<?=$baseUrl?>/routes/deleteSubCategories?did=<?=$sub_category['sub_cat_id']?>&action=d">Delete</a></td>
                        </tr>
                    <?php } ?>
        </div>
    </div>
</div>