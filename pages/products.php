<?php

require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/ProductsDB.php';
require_once __DIR__ . '/../classes/Template.php';

$products_db = new ProductsDB();
$products = $products_db->get_all_products();

Template::header('Products');

foreach ($products as $product) : ?>


  <head>
    <link rel="stylesheet" href="/assets/style.css">
  </head>

  <a href="/webshop/pages/product.php?id=<?= $product->id ?>">

    <div class="product-container">
      <img src="<?= $product->img_url ?>" width="150" height="300" alt="Product image">
      <b><?= $product->name ?></b>
      <i><?= $product->price ?> kr</i> <br>

      <form action="/webshop/scripts/product_add_to_cart.php" method="post">
        <input type="hidden" name="id" value="<?= $product->id ?>">
        <input type="submit" value="BUY" class="btn">
      </form>
    </div>

  <?php
endforeach;

Template::footer();
