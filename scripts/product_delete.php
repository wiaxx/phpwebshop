<?php
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

if (isset($_POST['id'])) {

    $db = new ProductsDB();
    $product_id = $_POST['id'];

    $success = $db->delete_product($product_id);
} else {
    header('Location: /webshop/pages/user/profile.php?delete=fail');
}

if ($success) {
    header('Location: /webshop/pages/user/profile.php');
} else {
    header('Location: /webshop/pages/user/profile.php?delete=fail');
}
