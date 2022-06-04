<?php
require_once __DIR__ . '/../../classes/User.php';
require_once __DIR__ . '/../../classes/Template.php';
require_once __DIR__ . '/../../classes/Product.php';
require_once __DIR__ . '/../../classes/ProductsDB.php';

$products_db = new ProductsDB();
$products = $products_db->get_all_products();

Template::header('Profile page');

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {

    $is_admin = $_SESSION['user']->is_admin;

    if ($is_admin) { ?>

        <div class="admin-create-div">

            <div>
                <h2>Create product</h2>
                <form action="/webshop/scripts/product_create.php" method="post">
                    <input type="text" name="name" placeholder="Product name">
                    <input type="text" name="description" placeholder="Description">
                    <input type="text" name="price" placeholder="Price">
                    <input type="file" name="picture">
                    <input type="submit" value="Create">
                </form>
            </div>

            <div>
                <h2>Create user</h2>
                <form action="/webshop/scripts/user_create.php" method="post">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirm_password" placeholder="Password" required>
                    <input type="submit" value="Register">
                </form>
            </div>

        </div>

        <div>
            <?php foreach ($products as $product) : ?>
                <p>
                    <a href="/webshop/pages/product.php?id=<?= $product->id ?>">
                        <?php echo $product ?>
                    </a>
                </p>
            <?php endforeach; ?>
        </div>

<?php }
} else {
    header('Location: /webshop/index.php');
}

Template::footer();
