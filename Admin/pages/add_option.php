<?php
$updatePage=false;
if(isset($_GET['id'])){
    if(isset($_GET['action']) && $_GET['action']=='d'){
        $id = $_GET['id'];
        $obj->delete('options',"opt_id",array($id));
        echo "<script>window.location.href='add_option.php'</script>";
    }
}
if (isset($_POST['submit'])) {
    unset($_POST['submit']);
    $id = $obj->Insert("options", $_POST);
    if ($id) {
        $_SESSION['message'] = "Option Successfully added";
    } else {
        $_SESSION['error'] = "Failed to add option";
    }
}else if(isset($_POST['update'])){
    unset($_POST['update']);
    $id = $obj->Update("options", $_POST, "opt_id", array($_GET['id']));
    if ($id) {
        $_SESSION['message'] = "Category Successfully updated";
    } else {
        $_SESSION['error'] = "Failed to update category";
    }
    echo "<script>window.location.href='add_option.php'</script>";
}

$options=$obj->select("options");

if(isset($_GET['id'])){
    if(isset($_GET['action']) && $_GET['action']=='e'){
        $id = $_GET['id'];
        $option = $obj->select("options","*","opt_id",array($id));
        // $category = $obj->select("categories","cat_id",array($id));
        // $category = $category[0];
        $updatePage=true;
    }
}

?>

<div class="col-sm-6">
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
    <?php } ?>
    <form action="" method="post">
        <div class="row">
            <label for="option_name">Options</label>
            <input type="text" name="option_name" class="form-control" <?=$updatePage?'value="'.$option[0]['option_name'].'"':"";?>>
        </div>
        <br>
        <br>
        <div class="row">
            <button type="submit" class="btn btn-facebook" name="<?=$updatePage?'update':'submit';?>"><?=$updatePage?'update':'submit';?></button>
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
                            <td><?= $option['opt_id'] ?></td>
                            <td><?= $option['option_name'] ?></td>
                            <td><a href="add_option.php?id=<?= $option['opt_id'] ?>&action=e">Edit</a></td>
                            <td><a href="add_option.php?id=<?= $option['opt_id'] ?>&action=d">Delete</a></td>
                        </tr>
                    <?php } ?>
        </div>
    </div>
</div>