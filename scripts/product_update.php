<?php
require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/ProductsDB.php';

$success = false;

if (isset($_POST["name"]) 
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
