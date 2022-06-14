<?php
require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/ProductsDB.php';
// require_once __DIR__ . '/../classes/Cart.php';

session_start();

if (isset($_POST['id'])) {

    isset($_SESSION['cart']) && !empty($_SESSION['cart']) ? $_SESSION['cart'] : $_SESSION['cart'] = array();

    $db = new ProductsDB();
    $product_id = $_POST['id'];
    $db_product = $db->get_one_product($product_id);

    array_push($_SESSION['cart'], $db_product);

    header('Location: /webshop/pages/products.php');
} else {
    header('Location: /webshop/pages/products.php?add-to-cart=fail');
}
