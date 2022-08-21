<?php
use Ecommerce\Controller\AuthController;
use Ecommerce\Controller\ProductController;
$cart=ProductController::getCartProducts();
$subTotal=0;
?> 
 <!-- Page Header Start -->
 <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
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
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        if(AuthController::isUserLoggedIn()){
                            if(count($cart)>0){
                                foreach($cart as $c){
                                    $subTotal+=$c['price']*$c['quantity'];
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="media align-items-center">
                                                <img src="<?=$baseUrl?>/assets/images/<?=$c['image_src']?>" class="mr-3" alt="..." width="100">
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-0"><?=$c['product_name']?></h5>
                                                    <p class="m-0"><?=$c['product_short_desc']?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?=$c['product_price']?></td>
                                        <td>
                                            <form action="<?=$baseUrl?>/routes/updateCart?cid=<?=$c['cid']?>" method="post">
                                                <input type="hidden" name="price" value="<?=$c['product_price'];?>">
                                                <!-- <input type="number" name="quantity" value="<?=$c['quantity']?>" class="form-control" min="1">
                                        -->
                                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-sm btn-primary btn-minus" type="button" >
                                                        <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="quantity" class="form-control form-control-sm bg-secondary text-center" value="<?=$c['quantity']?>" min="1">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-sm btn-primary btn-plus" type="button">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <br>
                                                <button type="submit" name="update" class="btn btn-primary btn-sm">Update</button>
                                            </form>
                                        </td>
                                        <td><?=$c['product_price']*$c['quantity']?></td>
                                       
                                            <form action="<?=$baseUrl?>/routes/removeProductFromCart" method="post">
                                                <input type="hidden" name="removeVal" value="<?=$c['cid']?>">
                                                <td class="align-middle"><button class="btn btn-sm btn-danger" type="submit" name="remove"><i class="fa fa-times"></i></button></td>
                                            </form>
                                        
                                    </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <h5 class="text-center">No Products in Cart</h5>
                                    </td>
                                </tr>
                                <?php
                            }
                        }else{
                            ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <h5 class="text-center">Please Login to View Cart</h5>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">NRs. <?=$subTotal?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">Free</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">NRs. <?=$subTotal?></h5>
                        </div>
                        <a href="checkout" class="btn btn-block btn-primary my-3 py-3" >Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->