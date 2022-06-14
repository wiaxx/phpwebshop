<?php
require_once __DIR__ . '/../classes/Template.php';
require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/ProductsDB.php';
require_once __DIR__ . '/../classes/Template.php';


$products_db = new ProductsDB();
$id = (int) isset($_GET["id"]) ? $_GET["id"] : null;
$product = $products_db->get_one_product($id);
Template::header('Single product');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product page</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>



    <div class="productinfo">
    <img src="<?= $product->img_url ?>" width="150" height="300" alt="Product image">

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
<?= $product->price ?>
</p>

</div>

<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {

    $is_admin = (bool) $_SESSION['user']->is_admin;

    if ($is_admin) { ?>
        <div class="update-product-div">
            <form action="/webshop/scripts/product_update.php" method="post" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="New name" value="<?= $product->name ?>" required>
                <textarea name="description" cols="30" rows="5" placeholder="New description" class="text-input"><?= $product->description ?></textarea>
                <input type="number" name="price" placeholder="New price" value="<?= $product->price ?>" required>
                <input type="file" name="image" accept="image/*">
                <input type="hidden" name="id" value="<?= $product->id ?>">
                <input type="submit" value="Save" class="btn btn-create">
            </form>
        </div>
<?php }
} ?>


<?php
  Template::footer();
?>

</body>
</html>
