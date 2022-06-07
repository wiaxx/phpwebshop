<?php
require_once __DIR__ . '/../classes/ProductsDB.php';

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
