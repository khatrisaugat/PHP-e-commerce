<?php
namespace Ecommerce\Controller\ProductController;

use Ecommerce\Controller\ProductController;

$orders=ProductController::getOrderDetails();
?>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>SN</th>
            <th>UserName</th>
            <th>Products</th>
            <th>Order Amount</th>
            <th>Order Date</th>
            <th>Delivery Address</th>
            <th>Phone</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($orders as $key=>$order):
        ?>
        <tr>
            <td><?=++$key?></td>
            <td><?=$order['username']?></td>
            <td>
                <?=$order['detailName'];?>
                <?php
                ?>
                <?php //echo $order_product['detailName']?>
                <br>
                <?php
               // endforeach;
                ?>
            </td>
            <td><?=$order['order_amount']?></td>
            <td><?=$order['order_date']?></td>
            <td><?=$order['order_address']?></td>
            <td><?=$order['order_phone']?></td>
            <td>
                <form action="<?=$baseUrl?>/routes/updateOrder" method="POST">
                    <input type="hidden" name="oid" value="<?=$order['oid']?>">
                    <?php
                    if($order['order_verfied']==0){ ?>
                    <button type="submit" name="order_verfied" value="1" class="btn btn-danger"><i class="fa fa-times-circle"></i></button>
                    <?php  
                    }else if($order['order_verfied']==1){ ?>
                    <button type="submit" name="order_verfied" value="0" class="btn btn-success"><i class="fa fa-check-circle"></i></button>
                    <?php }
                    ?>
                </form>
            </td>

        </tr>

        <?php
        endforeach;
        ?>
    </tbody>
</table>