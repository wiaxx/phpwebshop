<?php
require_once __DIR__ . '/../classes/Product.php';
require_once __DIR__ . '/../classes/Template.php';

$is_logged_in = isset($_SESSION['logged_in']) && isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

$products = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

Template::header('Cart');

if (empty($products)) { ?>

    <div class="cart">
        <p>Your shopping cart is empty..</p>
    </div>

    <?php } else {

    foreach ($products as $product) : ?>

        <div class="product-container">
            <a href="/webshop/pages/product.php?id=<?= $product->id ?>">
                <img src="<?= $product->img_url ?>" width="150" height="300" alt="Product image">
            </a>
            <b><?= $product->name ?></b>
            <i><?= $product->price ?> kr</i> <br>
        </div>

    <?php
    endforeach;

    if ($is_logged_in) { ?>

        <div class="cart">
            <form action="/webshop/scripts/order_create.php" method="post">
                <input type="hidden" name="customerID" value="<?= $logged_in_user->id ?>">
                <input type="submit" value="Place order">
            </form>
        </div>

    <?php } else { ?>

        <div class="cart">
            <p>Please register or login to place order</p>
        </div>

<?php }
}


Template::footer();
