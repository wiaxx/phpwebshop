<?php
require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/ProductsDB.php';

session_start();

$is_logged_in = isset($_SESSION['logged_in']) && isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;
$is_admin = $is_logged_in && ($logged_in_user->is_admin);

if (!$is_admin) {
    http_response_code(401);
    die();
}

$success = false;

if (
    isset($_POST["name"])
    && isset($_POST["description"])
    && isset($_POST["price"])
    && isset($_POST["id"])
) {

    $products_db = new ProductsDB();

    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $id = $_POST["id"];


    $product = new Product($name, $description, $price, $id);

    $success = $products_db->update_product($product);
} else {
    header("Location: /webshop/pages/product_update.php?id=$id&product=empty");
}

if ($success) {
    header("Location: /webshop/pages/product.php?id=" . $_POST["id"]);
} else {
    echo "Error updating product";
}
