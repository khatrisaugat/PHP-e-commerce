<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Login">
  <meta name="keyword" content="Login, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Login</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="<?=$baseUrl; ?>/assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="<?=$baseUrl; ?>/assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?=$baseUrl; ?>/assets/css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="<?=$baseUrl; ?>/assets/lib/gritter/css/jquery.gritter.css" />
  <!-- Custom styles for this template -->
  <link href="<?=$baseUrl; ?>/assets/css/style.css" rel="stylesheet">
  <link href="<?=$baseUrl; ?>/assets/css/style-responsive.css" rel="stylesheet">
  <script src="<?=$baseUrl; ?>/assets/lib/chart-master/Chart.js"></script>
</head>
 <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
    <h1 class="text-center">Login to View Dashboard</h1>
      <form class="form-login" action="<?=$baseUrl?>/routes/AdminLogin" method="post">
        <h2 class="form-login-heading">sign in now</h2>
        <div class="login-wrap">
          <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
          <br>
          <input type="password" name="password" class="form-control" placeholder="Password">
          <br>
          <button class="btn btn-theme btn-block" name="submit" type="submit" value="submit"><i class="fa fa-lock"></i> SIGN IN</button>
          <hr>

        </div>
        <!-- Modal -->
        <!-- modal -->
      </form>
    </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?=$baseUrl;?>/assets/lib/jquery/jquery.min.js"></script>
  <script src="<?=$baseUrl;?>/assets/lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="<?=$baseUrl;?>/assets/lib/jquery.backstretch.min.js"></script>
  
</body>

</html>
