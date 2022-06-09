<?php
require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/ProductsDB.php';
require_once __DIR__ . '/../classes/Template.php';


$products_db = new ProductsDB();

$id = (int) isset($_GET["id"]) ? $_GET["id"] : null;
$product = $products_db->get_one_product($id);

Template::header('Products');


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


    <nav>
        <a href="/webshop/index.php">Home</a> <br>
    </nav>


    <div class="img">
        <img src="<?= $product->img_url ?>" width="50" height="50" alt="Product image">
        </div>

    <p>
        <b>Id:</b>
        <?= $product->id ?>
    </p>


    <b>Name:</b>
    <?= $product->name ?>
    </p>

    <b>Description:</b>
    <?= $product->description ?>
    </p>

    <b>Price:</b>
    <?= $product->price ?> kr
    </p>




<hr>
<h3>Om inloggad som admin ska nedan synas</h3>    
<form action="/webshop/scripts/product_update.php" method="post">
        <input type="text" name="name" placeholder="Product name" value="<?= $product->name ?>" required>
        <input type="text" name="description" placeholder="Description" value="<?= $product->description ?>">
        <input type="number" name="price" placeholder="Price" value="<?= $product->price ?>" required>
        <!-- <input type="file" name="picture" value="<?= $product->imgURL ?>"> -->
        <input type="hidden" name="id" value="<?= $product->id ?>">
        <input type="submit" value="Save" class="btn btn-create">
    </form>

<?php
  Template::footer();
?>
</body>

</html>

