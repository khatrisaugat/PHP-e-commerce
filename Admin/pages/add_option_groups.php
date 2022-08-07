<?php
$updatePage=false;
if(isset($_GET['id'])){
    if(isset($_GET['action']) && $_GET['action']=='d'){
        $id = $_GET['id'];
        $obj->delete('option_groups',"opt_group_id",array($id));
        echo "<script>window.location.href='add_option_groups.php'</script>";
    }
}
if (isset($_POST['submit'])) {
    unset($_POST['submit']);
    $id = $obj->Insert("option_groups", $_POST);
    if ($id) {
        $_SESSION['message'] = "Option Successfully added";
    } else {
        $_SESSION['error'] = "Failed to add option";
    }
}else if(isset($_POST['update'])){
    unset($_POST['update']);
    $id = $obj->Update("option_groups", $_POST, "opt_group_id", array($_GET['id']));
    if ($id) {
        $_SESSION['message'] = "Option Group Successfully updated";
    } else {
        $_SESSION['error'] = "Failed to update Option Group";
    }
    echo "<script>window.location.href='add_option_groups.php'</script>";
}

$option_groups=$obj->select("option_groups");

if(isset($_GET['id'])){
    if(isset($_GET['action']) && $_GET['action']=='e'){
        $id = $_GET['id'];
        $option_group = $obj->select("option_groups","*","opt_group_id",array($id));
        // $category = $obj->select("categories","cat_id",array($id));
        // $category = $category[0];
        $updatePage=true;
    }
}

?>

<div class="col-sm-6">
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
    <?php } ?>
    <form action="" method="post">
        <div class="row">
            <label for="opt_group_name">Option Group Name</label>
            <input type="text" name="opt_group_name" class="form-control" <?=$updatePage?'value="'.$option_group[0]['opt_group_name'].'"':"";?>>
        </div>
        <br>
        <br>
        <div class="row">
            <button type="submit" class="btn btn-facebook" name="<?=$updatePage?'update':'submit';?>"><?=$updatePage?'update':'submit';?></button>
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
                            <td><a href="add_option_groups.php?id=<?= $option_group['opt_group_id'] ?>&action=e">Edit</a></td>
                            <td><a href="add_option_groups.php?id=<?= $option_group['opt_group_id'] ?>&action=d">Delete</a></td>
                        </tr>
                    <?php } ?>
        </div>
    </div>
</div>