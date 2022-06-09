<?php

require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/ProductsDB.php';
require_once __DIR__ . '/../classes/Template.php';

$products_db = new ProductsDB();
$products = $products_db->get_all_products();

Template::header('Products');


foreach ($products as $product) : ?>


  <div>
  <a href="/webshop/pages/product.php?id=<?= $product -> id ?>">

      <b><?= $product->name ?></b>
      <i><?= $product->price ?> kr</i> <br>
      <img src="<?= $product->img_url ?>" width="100" height="100" alt="Product image">
      
  </div>
  
  <?php
  endforeach;

  Template::footer();