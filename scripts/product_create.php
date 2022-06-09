<?php

require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/ProductsDB.php';
require_once __DIR__ . '/../classes/User.php';

session_start();

$success = false;

if (
    isset($_POST['name']) &&
    isset($_POST['description']) &&
    isset($_POST['price']) &&
    // isset($_POST['image']) &&
    isset($_SESSION['user']) &&
    $_SESSION['user']->is_admin
) {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $img_url = $_POST['picture'];

    // if (empty(trim($title))) {
    //     header('Location: /todo/index.php?task=empty');
    //     die();
    // }

    $product = new Product($name, $description, $price);

    $db = new ProductsDB();
    $success = $db->create_product($product);
} else {
    header('Location: /webshop/pages/user/profile.php?create=fail');
    die();
}

if ($success) {
    header('Location: /webshop/pages/user/profile.php');
} else {
    header('Location: /webshop/pages/user/profile.php?create=fail');
    die();
}
