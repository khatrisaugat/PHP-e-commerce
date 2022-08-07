<?php
 if(isset($_POST['submit'])){
    $user_select=$obj->select("users","*","ut_id",array(2));
    // print_r($user_select);
    foreach($user_select as $user){
        // print_r($user);
      if($user['username']==$_POST['username'] && $user['password']==md5($_POST['password'])){
        $_SESSION['status']="Success";
        $_SESSION['user']=array("uid"=>$user['uid'],"username"=>$user['username'],"address"=>$user['address'],"ut_id"=>$user['ut_id'],"email"=>$user['email'],"phone"=>$user['phone'],"city"=>$user['city']);
        echo "<script>window.location.href='".base_url()."'</script>";
      }
    }
  }
?>

<div class="container ">
    <div class="col-sm-12 d-flex justify-content-center min-vh-100 align-content-center ">
        <div class="col-sm-6">
            <h3 class="display-3 text-center">Login</h3>
            <div class="">
                <form action="" method="post">
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