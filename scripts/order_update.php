<?php
require_once __DIR__ . '/../classes/OrdersDB.php';
require_once __DIR__ . '/../classes/Order.php';

$success = false;

if (isset($_POST['id'])) {

    $db = new OrdersDB();
    $order_id = $_POST['id'];

    $success = $db->update($order_id);

    if ($success) {
        echo "success";
    } else {
        echo "fail";
    }
} else {
    header('Location: /webshop/pages/user/profile.php?update=fail');
}

if ($success) {
    header('Location: /webshop/pages/user/profile.php');
} else {
    header('Location: /webshop/pages/user/profile.php?update=fail');
}
