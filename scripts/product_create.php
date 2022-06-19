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
    isset($_SESSION['user']) &&
    $_SESSION['user']->is_admin
) {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $img_url = $_POST['picture'];

    $upload_dir = __DIR__ . '/../assets/uploads/';
    $upload_name = basename($_FILES["image"]["name"]);
    $name_parts = explode(".", $upload_name);
    $file_extension = end($name_parts);
    $timestamp = time();

    $file_name = "{$timestamp}.{$file_extension}";
    $full_upload_path = $upload_dir . $file_name;
    $full_relative_url = "/webshop/assets/uploads/{$file_name}";
    $success = move_uploaded_file($_FILES["image"]["tmp_name"], $full_upload_path);

    if ($success) {
        $product = new Product($name, $description, $price, $full_relative_url);
        $db = new ProductsDB();
        $success = $db->create_product($product);
    }
} else {
    header('Location: /webshop/pages/user/profile.php?create=fail');
    die('Invalid input');
}

if ($success) {
    header('Location: /webshop/pages/user/profile.php');
} else {
    header('Location: /webshop/pages/user/profile.php?create=fail');
    die('Error saving product');
}
