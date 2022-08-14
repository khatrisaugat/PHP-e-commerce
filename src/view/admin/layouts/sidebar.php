<!--sidebar start-->
<aside>
  <div id="sidebar" class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
      <p class="centered"><a href="index.php"><img src="img/apple-touch-icon.png" class="img-circle" width="80"></a></p>
      <h5 class="centered">Admin Panel</h5>
      <li class="mt">
        <a class="active" href="<?=$baseUrl ?>">
          <i class="fa fa-dashboard"></i>
          <span>Home</span>
        </a>
      </li>

      <li class="sub-menu">
        <a href="javascript:;">
          <i class="fa fa-th"></i>
          <span>Category Section</span>
        </a>
        <ul class="sub">
          <li><a href="<?= $pathUptoPages.'add_categories'; ?>">Categories</a></li>
          <li><a href="<?= $pathUptoPages.'add_sub_categories'; ?>">Sub-Categories</a></li>
        </ul>
      </li>

      <li class="sub-menu">
        <a href="javascript:;">
          <i class="fa fa-product-hunt"></i>
          <span>Product Section</span>
        </a>
        <ul class="sub">
        <li><a href="<?= $pathUptoPages.'add_products'; ?>">Products</a></li>
          <li><a href="<?= $pathUptoPages.'display_products'; ?>">Display Products</a></li>
        </ul>
      </li>
      <li class="sub-menu">
        <a href="javascript:;">
          <i class="fa fa-cogs"></i>
          <span>Options Section</span>
        </a>
        <ul class="sub">
          <li><a href="<?= $pathUptoPages.'add_option'; ?>">Options</a></li>
          <li><a href="<?= $pathUptoPages.'add_option_groups'; ?>">Option Groups</a></li>
        </ul>
      </li>
      <li class="sub-menu">
        <a href="javascript:;">
          <i class="fa fa-cart-plus"></i>
          <span>Orders Section</span>
        </a>
        <ul class="sub">
        <li><a href="<?= $pathUptoPages.'orders_manage'; ?>">Manage Orders</a></li>
        </ul>
      </li>

      <?php
      if (isset($_SESSION['adminlogin']) && $_SESSION['adminlogin'] == "yes") {

      ?>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-user"></i>


            <span>Add/Edit Backend User</span>
          </a>
          <ul class="sub">
            <li><a href="add_user.php">Add User</a></li>
            <li><a href="display_users.php">Edit User</a></li>
            <br><br><br><br><br><br>
          </ul>
        </li>

      <?php
      }
      ?>
    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="container" style="margin-top:30px;">