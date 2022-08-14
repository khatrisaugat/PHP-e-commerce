<?php 
use Ecommerce\Config\Config;
require_once Config::root('view\layouts\header.php');
require_once Config::root('view\layouts\sidebar.php');
if (file_exists($pagePath) && is_file($pagePath)) {
    require_once $pagePath;
} else {
    echo "<h1>Page not found 404</h1>";
}
require_once Config::root('view\layouts\footer.php');