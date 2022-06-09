<?php
require_once __DIR__ . '/../classes/Template.php';
require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/ProductsDB.php';
require_once __DIR__ . '/../classes/Template.php';


$products_db = new ProductsDB();

$id = (int) isset($_GET["id"]) ? $_GET["id"] : null;
$product = $products_db->get_one_product($id);

Template::header('Products');


?>

<?php Template::header('Single product'); ?>



    <nav>
        <a href="/webshop/index.php">Home</a> <br>
    </nav>

<p>


    <b>Id:</b>
    <?= $product->id ?>
</p>

    <div class="img">
        <img src="<?= $product->img_url ?>" width="50" height="50" alt="Product image">
        </div>

<b>Name:</b>
<?= $product->name ?>
</p>

<b>Description:</b>
<?= $product->description ?>
</p>

<b>Price:</b>
<?= $product->price ?>
</p>

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
