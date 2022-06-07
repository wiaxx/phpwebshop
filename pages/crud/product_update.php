<?php 
require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/ProductsDB.php';
require_once __DIR__ . '/../classes/Template.php';

session_start();

$user_id = (int) $_SESSION["user"]->id;
$products_db = new ProductsDB();

$id = (int) isset($_GET["id"]) ? $_GET["id"] : null;
$product = $db -> get_one_product($user_id, $id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit product</title>
</head>
<body>

    <h1>Update product</h1>

    <form action="/phpwebshop-main/scripts/product_edit.php" method="post">
        <input type="text" name="title" placeholder="New name" value="<?= $product -> name ?>"><br>
        <input type="text" name="descripton" placeholder="New Description" value="<?= $product -> description ?>"><br>
        <input type="text" name="price" placeholder="New Price" value="<?= $product -> price ?>"><br>
        <input type="hidden" name="id" value="<?= $product -> id ?>">
         <input class="save" type="submit" value="Save">
    </form>

    
</body>
</html>