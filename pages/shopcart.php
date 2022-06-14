<?php
require_once __DIR__ . '/../classes/Template.php';
require_once __DIR__ . '/../classes/Product.php';
// require_once __DIR__ . '/../classes/Cart.php';

Template::header('Cart');

// $shopcart = new Cart();

// echo '<pre>';
// print_r($shopcart->cart());
// echo '</pre>';

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo '<pre>';
    print_r($_SESSION['cart']);
    echo '</pre>';
} else {
    echo 'Your shopping cart is empty..';
}

Template::footer();
