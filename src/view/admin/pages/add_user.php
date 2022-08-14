<?php
if (isset($_POST['submit'])) {
    unset($_POST['submit']);
    $id = $obj->Insert("users", $_POST);
    if ($id) {
        $_SESSION['message'] = "User Successfully added";
    } else {
        $_SESSION['error'] = "Failed to add user";
    }
}

$user_type=$obj->select("user_type");
?>

<div class="col-sm-6">
    <h3>Add Users</h3>
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
            <label for="Name">Username</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="row">
            <label for="Email">Email</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="row">
            <label for="Password">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="row">
            <label for="Phone">Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="row">
            <label for="City">City</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="row">
            <label for="User_type">User Type</label>
            <Select name="ut_id" class="form-control">
                <?php foreach ($user_type as $user_type) { ?>
                    <option value="<?= $user_type['ut_id'] ?>"><?= $user_type['user_type'] ?></option>
                    <?php } ?>
            </Select>
        </div>
        <br>
        <br>
        <div class="row">
            <button type="submit" class="btn btn-facebook" name="submit">Submit</button>
        </div>

    </form>
</div>