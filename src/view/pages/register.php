<div class="container ">
    <div class="col-sm-12 d-flex justify-content-center min-vh-100 align-content-center ">
        <div class="col-sm-6">
            <h3 class="display-3 text-center">Register</h3>
            <?php
                    if(isset($_SESSION['error'])){?>
                        <div class="alert alert-danger error">
                    <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                        </div>
                        <?php
                    }
                ?>
            <div class="">
                <div class="error"></div>
                <form action="<?=$baseUrl?>/routes/registerUser" method="post" onsubmit="return validate()">
                    <div class="row d-flex justify-content-center form-group ">
                        <label for="username">Username</label>
                        <input type="text" name="username" placeholder="Enter your Username" class="form-control username_val">
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