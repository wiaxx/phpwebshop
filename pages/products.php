<?php
require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/ProductsDB.php';
require_once __DIR__ . '/../classes/Template.php';

$products_db = new ProductsDB();
$products = $products_db->get_all_products();

Template::header('Products');

Template::footer();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All products</title>
</head>
<body>

<h2>Product Page</h2>

  <?php foreach ($products as $product) : ?>
    <p>
    <a href="/webshop/pages/product.php?id=<?= $product -> id ?>">
   <?php echo $product ?>
    </a>
    </p>
   <?php endforeach; ?>
    
</body>
</html>