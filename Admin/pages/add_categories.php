<?php
$updatePage=false;
if(isset($_GET['id'])){
    if(isset($_GET['action']) && $_GET['action']=='d'){
        $id = $_GET['id'];
        $obj->delete('categories',"cat_id",array($id));
        echo "<script>window.location.href='add_categories.php'</script>";
    }
}
if (isset($_POST['submit'])) {
    unset($_POST['submit']);
    $id = $obj->Insert("categories", $_POST);
    if ($id) {
        $_SESSION['message'] = "Category Successfully added";
    } else {
        $_SESSION['error'] = "Failed to add category";
    }
}else if(isset($_POST['update'])){
    unset($_POST['update']);
    $id = $obj->Update("categories", $_POST, "cat_id", array($_GET['id']));
    if ($id) {
        $_SESSION['message'] = "Category Successfully updated";
    } else {
        $_SESSION['error'] = "Failed to update category";
    }
    echo "<script>window.location.href='add_categories.php'</script>";
}

$categories=$obj->select("categories");

if(isset($_GET['id'])){
    if(isset($_GET['action']) && $_GET['action']=='e'){
        $id = $_GET['id'];
        $category = $obj->select("categories","*","cat_id",array($id));
        // $category = $obj->select("categories","cat_id",array($id));
        // $category = $category[0];
        $updatePage=true;
    }
}

?>

<div class="col-sm-6">
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
    <?php } ?>
    <form action="" method="post">
        <div class="row">
            <label for="cat_title">category</label>
            <input type="text" name="cat_title" class="form-control" <?=$updatePage?'value="'.$category[0]['cat_title'].'"':"";?>>
        </div>
        <div class="row">
            <label for="cat_details">Category details</label>
            <input type="text" name="cat_details" class="form-control" <?=$updatePage?'value="'.$category[0]['cat_details'].'"':"";?>>
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
                        <th>Category</th>
                        <th>Category Details</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) { ?>
                        <tr>
                            <td><?= $category['cat_id'] ?></td>
                            <td><?= $category['cat_title'] ?></td>
                            <td><?= $category['cat_details'] ?></td>
                            <td><a href="add_categories.php?id=<?= $category['cat_id'] ?>&action=e">Edit</a></td>
                            <td><a href="add_categories.php?id=<?= $category['cat_id'] ?>&action=d">Delete</a></td>
                        </tr>
                    <?php } ?>
        </div>
    </div>
</div>