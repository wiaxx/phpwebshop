<?php
require_once __DIR__ . '/../classes/OrderDB.php';

$success = false;

if (isset($_POST['id'])) {

    // $db = new OrdersDB();
    // $order_id = $_POST['id'];

    // $success = $db->update($order_id);
} else {
    header('Location: /webshop/pages/user/profile.php?update=fail');
}

if ($success) {
    header('Location: /webshop/pages/user/profile.php');
} else {
    header('Location: /webshop/pages/user/profile.php?update=fail');
}
