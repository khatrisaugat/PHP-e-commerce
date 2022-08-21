<?php
use Ecommerce\Controller\AuthController;
use Ecommerce\Controller\ProductController;
$orders=ProductController::getOrderDetails();
?>    
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">My Orders</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Orders</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
        <?php
                    if(isset($_SESSION['message'])){?>
                        <div class="alert alert-success error">
                    <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                        ?>
                        </div>
                        <?php
                    }
                ?>
            <div class="col-lg-8 table-responsive mb-5">
                <h1>Orders placed</h1>
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        if(AuthController::isUserLoggedIn()){
                            if(count($orders)>0){
                                foreach($orders as $c){
                                    if($c['uid']==$_SESSION['uid']){
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="media align-items-center">
                                                <!-- <img src="<?=$baseUrl?>/assets/images/<?=$c['image_src']?>" class="mr-3" alt="..." width="100"> -->
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-0"><?=$c['detailName']?></h5>
                                                    <p class="m-0"><?=$c['product_short_desc']?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?=$c['product_price']?></td>
                                        <td>
                                            <?=$c['detailQuantity']?>
                                        </td>
                                        <td><?=$c['order_amount']?></td>
                                    </tr>
                                    <?php
                                }
                        }

                        }else{
                            ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <h5 class="text-center">No orders placed</h5>
                                </td>
                            </tr>
                            <?php
                        }
                    }else{
                        ?>
                        <tr>
                        <td colspan="5" class="text-center">
                            <h5 class="text-center">Please Login to View orders</h5>
                        </td>
                    </tr>
                    <?php
                    }
                        ?>
                    </tbody>
                </table>
            </div>
