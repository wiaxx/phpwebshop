<?php
require_once __DIR__ . '/../classes/Template.php';
require_once __DIR__ . '/../classes/Product.php';
// require_once __DIR__ . '/../classes/Cart.php';

$is_logged_in = isset($_SESSION['logged_in']) && isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

Template::header('Cart');

// $shopcart = new Cart();

// echo '<pre>';
// print_r($shopcart->cart());
// echo '</pre>';

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

    echo '<pre>';
    print_r($_SESSION['cart']);
    echo '</pre>';

    if ($is_logged_in) { ?>
        <div class="cart">

            <form action="/webshop/scripts/order_create.php" method="post">
                <input type="hidden" name="customerID" value="<?= $logged_in_user->id ?>">
                <input type="submit" value="Place order">
            </form>
        </div>
    <?php    } else { ?>
        <div class="cart">
            <p>
                Please register or login to place order
            </p>
        </div>
    <?php }
} else { ?>
    <div class="cart">
        <p>
            Your shopping cart is empty..
        </p>
    </div>
<?php }

Template::footer();
