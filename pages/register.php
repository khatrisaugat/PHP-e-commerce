<?php
if(isset($_POST['submit'])){
    unset($_POST['submit']);
    $_POST['ut_id']=2;
    $_POST['password']=md5($_POST['password']);
    if($obj->Insert("users",$_POST)>0){
        $_SESSION['message']="Registered successfully!!";
    }else{
        $_SESSION['message']="There was some unexpected error!!";
    }
}

?>

<div class="container ">
    <div class="col-sm-12 d-flex justify-content-center min-vh-100 align-content-center ">
        <div class="col-sm-6">
            <h3 class="display-3 text-center">Register</h3>
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
            <div class="">
                <form action="" method="post">
                    <div class="row d-flex justify-content-center form-group ">
                        <label for="username">Username</label>
                        <input type="text" name="username" placeholder="Enter your Username" class="form-control">
                    </div>
                    <div class="row d-flex justify-content-center form-group ">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Enter your email" class="form-control">
                    </div>
                    <div class="row d-flex justify-content-center">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Enter your Password" class="form-control">
                    </div>
                    <div class="row d-flex justify-content-center form-group ">
                        <label for="city">city</label>
                        <input type="text" name="city" placeholder="Enter your city" class="form-control">
                    </div>
                    <div class="row d-flex justify-content-center form-group ">
                        <label for="phone">phone</label>
                        <input type="number" name="phone" placeholder="Enter your phone number" class="form-control">
                    </div>
                    <div class="row d-flex justify-content-center form-group ">
                        <label for="address">Delivery address</label>
                        <input type="text" name="address" placeholder="Enter your delivery address" class="form-control">
                    </div>
                    <div class="row d-flex justify-content-center">
                    Already have an account &nbsp; <a href="register" class="text"> Login now</a>?
                    </div>
                    <div class="row d-flex justify-content-center">
                        <button type="submit" name="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>