<?php
require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/ProductsDB.php';
require_once __DIR__ . '/../classes/Template.php';

$products_db = new ProductsDB();
$products = $products_db->get_all();

Template::header('Products');

Template::footer();
