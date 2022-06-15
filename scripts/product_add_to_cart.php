<?php
require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/ProductsDB.php';
// require_once __DIR__ . '/../classes/Cart.php';

session_start();

if (isset($_POST['id'])) {

    $product_id = $_POST['id'];
    $db = new ProductsDB();
    $db_product = $db->get_one_product($product_id);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if ($db_product) {
        $_SESSION['cart'][] = $db_product;
        header('Location: /webshop/pages/products.php');
        die();
    } else {
        header('Location: /webshop/pages/products.php');
        die('Error adding product to cart');
    }
} else {
    header('Location: /webshop/pages/products.php?add-to-cart=fail');
}
