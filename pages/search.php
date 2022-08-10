<?php
if(!isset($_GET['search'])){
    echo "<script>window.location.href='home.php'</script>";
}
$limit=8;
$searchQuery=explode(" ",$_GET['search']);
$searchString="";
foreach ($searchQuery as $query) {
    $searchString.=metaphone($query)." ";
}
// $searchResultsCount=$obj->Query("SELECT products.pid FROM `products` JOIN images ON images.image_id=products.featured_image_id JOIN `sub_categories` ON sub_categories.sub_cat_id=products.sub_cat_id WHERE product_name LIKE '%{$_GET['search']}%' OR  `sub_cat_title` LIKE '%{$_GET['search']}%' OR `sub_cat_desc` LIKE '%{$_GET['search']}%' GROUP BY products.pid");
$searchResultsCount=$obj->Query("SELECT products.pid FROM `products` JOIN images ON images.image_id=products.featured_image_id WHERE indexing LIKE '%{$searchString}%' GROUP BY products.pid");

$totalResults=count($searchResultsCount);
$total_pages = ceil ($totalResults / $limit);  
if (!isset ($_GET['page']) ) {  

    $page_number = 1;  

} else {  

    $page_number = $_GET['page'];  

}    
$initial_page = ($page_number-1) * $limit;   

// $searchResults=$obj->Query("SELECT * FROM `products` WHERE `product_name` LIKE '%{$_POST['search']}%'");
// $searchResults=$obj->Query("SELECT * FROM `products` JOIN images ON images.image_id=products.featured_image_id JOIN `sub_categories` ON sub_categories.sub_cat_id=products.sub_cat_id WHERE product_name LIKE '%{$_GET['search']}%' OR  `sub_cat_title` LIKE '%{$_GET['search']}%' OR `sub_cat_desc` LIKE '%{$_GET['search']}%'  GROUP BY products.pid LIMIT " . $initial_page . ',' . $limit);
$searchResults=$obj->Query("SELECT * FROM `products` JOIN images ON images.image_id=products.featured_image_id WHERE indexing LIKE '%{$searchString}%' GROUP BY products.pid LIMIT " . $initial_page . ',' . $limit);

$searchResultsCount=count($searchResults);
echo "<center><h1>Searching for '{$_GET['search']}'</h1> <br><h2> Total Results: {$totalResults}</h2></center>";
// print_r($searchResults);
?>
 <!-- Shop Start -->
 <div class="container-fluid pt-5">
        


            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-12">
                <div class="row pb-3">

                    <?php foreach($searchResults as $product): ?>
                    <div class="col-lg-3 col-md-4 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4" style="height: 500px;">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="Admin/img/<?=$product->image_src?>" alt="" width="100%">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3"><?=$product->product_name;?></h6>
                                <div class="d-flex justify-content-center">
                                    <h6>NRs. <?=$product->product_price;?></h6><h6 class="text-muted ml-2"><del>NRs. <?=$product->product_price;?></del></h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="product?pid=<?=$product->pid;?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                <!-- <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a> -->
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-3">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <?php for($page_number = 1; $page_number<= $total_pages; $page_number++) {
                                if(isset($_GET['page']) && $page_number == $_GET['page']) {
                                    echo '<li class="page-item active"><a class="page-link" href="?page='.$page_number.'&search='.$_GET['search'].'">'.$page_number.'</a></li>';
                                } else if(!isset($_GET['page']) && $page_number == 1) {
                                    echo '<li class="page-item active"><a class="page-link" href="?page='.$page_number.'&search='.$_GET['search'].'">'.$page_number.'</a></li>';
                                }else{
                                    echo '<li class="page-item"><a class="page-link" href="?page='.$page_number.'&search='.$_GET['search'].'">'.$page_number.'</a></li>';
                                }
                            }
                            ?>
                            <!-- <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->