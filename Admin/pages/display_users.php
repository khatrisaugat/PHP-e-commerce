<?php
if (isset($_POST['update'])) {
    unset($_POST['update']);
    if (empty($_POST['password'])) {
        unset($_POST['password']);
    } else {
        $pass = $_POST['password'];
        $_POST['password'] = md5($pass);
    }
    $obj->Update("users", $_POST, "uid", array($_GET['id']));
    echo "<script>window.location.href='display_users.php'</script>";
}
if (isset($_GET['id']) && $_GET['op'] == 'd') {
    $obj->Delete("users", "uid", array($_GET['id']));
} elseif (isset($_GET['id']) && $_GET['op'] == 'e') {
    $edit_user = $obj->Select("users", "*", "uid", array($_GET['id']));

?>
    <div class="col-md-6">
        <h3>Edit User</h3>
        <form action="" method="post">
            <div class="row">
                <label for="Username">Username</label>
                <input type="text" name="username" class="form-control" value="<?= $edit_user[0]['username']; ?>">
            </div>
            <div class="row">
                <label for="Email">Email</label>
                <input type="text" name="email" class="form-control" value="<?= $edit_user[0]['email']; ?>">
            </div>
            <div class="row">
                <label for="City">City</label>
                <input type="text" name="city" class="form-control" value="<?= $edit_user[0]['city']; ?>">
            </div>
            <div class="row">
                <label for="Phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?= $edit_user[0]['phone']; ?>">
            </div>

            <div class="row">
                <label for="Password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Leave blank for no change">
            </div>
            <div class="row">
                <button type="submit" class="btn btn-facebook" name="update">Update</button>
            </div>
        </form>
    </div>
<?php
}
$users = $obj->Select("users");
?>
<div class="col-sm-10">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $key => $user) : ?>
                <tr>
                    <td><?= ++$key; ?></td>
                    <td><?= $user['username']; ?></td>
                    <td>
                        <a href="<?= base_url() . 'display_users.php?op=d&id=' . $user['uid']; ?>" onclick="return confirm('Are you Sure?');"><i class="fa fa-trash-o" style="color: red;font-size:20px;"></i></a>
                        <a href="<?= base_url() . 'display_users.php?op=e&id=' . $user['uid']; ?>" onclick="return confirm('Are you Sure?');"><i class="fa fa-pencil-square-o" style="color: blue;font-size:20px;margin-left:5rem;"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>