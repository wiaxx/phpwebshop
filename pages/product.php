<?php
require_once "./classes/Database.php";
require_once "./classes/Product.php";


$db = new Database();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single product</title>
</head>
<body>

<h1>Single product</h1>
    
  
<p>

     <?= $product -> img ?>
     </p>
    
     <b>Id:</b>
     <?= $product -> id ?>
     </p>
    
    
     <b>Name:</b>
     <?= $product -> name ?>
     </p>
    
     <b>Description:</b>
     <?= $product -> description ?>
     </p>

     <b>Price:</b>
     <?= $product -> price ?>
</p>

</body>
</html>