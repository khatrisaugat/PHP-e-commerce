<?php
$updatePage=false;
if(isset($_GET['id'])){
    if(isset($_GET['action']) && $_GET['action']=='d'){
        $id = $_GET['id'];
        $obj->delete('sub_categories',"sub_cat_id",array($id));
        echo "<script>window.location.href='add_sub_categories.php'</script>";
    }
}
if (isset($_POST['submit'])) {
    unset($_POST['submit']);
    $id = $obj->Insert("sub_categories", $_POST);
    if ($id) {
        $_SESSION['message'] = "Category Successfully added";
    } else {
        $_SESSION['error'] = "Failed to add category";
    }
}else if(isset($_POST['update'])){
    unset($_POST['update']);
    $id = $obj->Update("sub_categories", $_POST, "sub_cat_id", array($_GET['id']));
    if ($id) {
        $_SESSION['message'] = "Category Successfully updated";
    } else {
        $_SESSION['error'] = "Failed to update category";
    }
    echo "<script>window.location.href='add_sub_categories.php'</script>";
}
$categories=$obj->select("categories");
$sub_categories=$obj->select("sub_categories JOIN categories ON sub_categories.cat_id=categories.cat_id");

if(isset($_GET['id'])){
    if(isset($_GET['action']) && $_GET['action']=='e'){
        $id = $_GET['id'];
        $sub_category=$obj->select("sub_categories","*","sub_cat_id",array($id));
        // $category = $obj->select("categories","cat_id",array($id));
        // $category = $category[0];
        $updatePage=true;
    }
}

?>

<div class="col-sm-6">
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
    <?php } ?>
    <form action="" method="post">
        <div class="row">
            <label for="sub_cat_title">Sub-category title</label>
            <input type="text" name="sub_cat_title" class="form-control" <?=$updatePage?'value="'.$sub_category[0]['sub_cat_title'].'"':"";?>>
        </div>
        <div class="row">
            <label for="sub_cat_desc">Sub-category details</label>
            <input type="text" name="sub_cat_desc" class="form-control" <?=$updatePage?'value="'.$sub_category[0]['sub_cat_desc'].'"':"";?>>
        </div>
        <div class="row">
        <label for="cat_id">Category</label>
            <select name="cat_id" class="form-control">
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category['cat_id'] ?>" <?php if($updatePage){
                        echo $sub_category[0]['cat_id']==$category['cat_id']? "selected":"";
                    }?>><?= $category['cat_title'] ?></option>
                    <?php } ?>
            </select>
        </div>
        <br>
        <br>
        <div class="row">
            <button type="submit" class="btn btn-facebook" name="<?=$updatePage?'update':'submit';?>"><?=$updatePage?'update':'submit';?></button>
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
                            <td><?= $sub_category['sub_cat_id'] ?></td>
                            <td><?= $sub_category['sub_cat_title'] ?></td>
                            <td><?= $sub_category['sub_cat_desc'] ?></td>
                            <td><?= $sub_category['cat_title'] ?></td>
                            <td><a href="add_sub_categories.php?id=<?= $sub_category['sub_cat_id'] ?>&action=e">Edit</a></td>
                            <td><a href="add_sub_categories.php?id=<?= $sub_category['sub_cat_id'] ?>&action=d">Delete</a></td>
                        </tr>
                    <?php } ?>
        </div>
    </div>
</div>