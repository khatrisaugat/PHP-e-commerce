<div class="container ">
    <div class="col-sm-12 d-flex justify-content-center min-vh-100 align-content-center ">
        <div class="col-sm-6">
            <h3 class="display-3 text-center">Login</h3>
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
                <form action="<?=$baseUrl?>/routes/loginUser" method="post">
                    <div class="row d-flex justify-content-center form-group ">
                        <label for="username">Username</label>
                        <input type="text" name="username" placeholder="Enter your Username" class="form-control">
                    </div>
                    <div class="row d-flex justify-content-center">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Enter your Password" class="form-control">
                    </div>
                    <div class="row d-flex justify-content-center">
                        Don't have an account &nbsp; <a href="register" class="text"> register now</a>?
                    </div>
                    <div class="row d-flex justify-content-center">
                        <button type="submit" name="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>