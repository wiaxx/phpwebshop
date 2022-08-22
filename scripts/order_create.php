<?php

require_once __DIR__ . "/../classes/OrdersDB.php";
require_once __DIR__ . "/../classes/Order.php";
require_once __DIR__ . "/../classes/User.php";


session_start();

$success = false;

if (
    isset($_SESSION["user"]) &&
    isset($_SESSION["logged_in"]) &&
    isset($_SESSION["cart"])
) {

    $customer = $_SESSION["user"]->id;

    $date = date("Y-m-d");
    $status = "ongoing";

    $order = new Order($customer, $status, $date);
    $db = new OrdersDB;


    var_dump($order);
    $success = $db->createOrder($order);
} else {
    echo "Error, not saved to Database";
}

if ($success) {
    $_SESSION["cart"] = [];

    header("Location: /webshop");
} else {
    echo "It did not work";
}
