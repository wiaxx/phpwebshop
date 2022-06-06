<?php
require_once __DIR__ . '/../../classes/User.php';
require_once __DIR__ . '/../../classes/UsersDB.php';
require_once __DIR__ . '/../../classes/Template.php';
require_once __DIR__ . '/../../classes/Product.php';
require_once __DIR__ . '/../../classes/ProductsDB.php';

$products_db = new ProductsDB();
$products = $products_db->get_all_products();

$users_db = new UserDB();
$users = $users_db->get_all();

Template::header('Profile page');

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {

    $is_admin = $_SESSION['user']->is_admin;

    if ($is_admin) { ?>

        <div class="admin-create-div">

            <div class="admin-div">
                <h2>Create product</h2>
                <form action="/webshop/scripts/product_create.php" method="post">
                    <input type="text" name="name" placeholder="Product name" required>
                    <input type="text" name="description" placeholder="Description">
                    <input type="text" name="price" placeholder="Price" required>
                    <input type="file" name="picture">
                    <input type="submit" value="Create" class="btn btn-create">
                </form>

                <div>
                    <?php foreach ($products as $product) : ?>
                        <p>
                            <a href="/webshop/pages/product.php?id=<?= $product->id ?>">
                                <?php echo $product ?>
                            </a>
                        </p>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="admin-div">
                <h2>Create user</h2>
                <form action="/webshop/scripts/user_create.php" method="post">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirm_password" placeholder="Password" required>
                    <input type="submit" value="Register" class="btn btn-create">
                </form>

                <?php foreach ($users as $user) : ?>
                    <p>
                        <?php echo $user->username . ' : ' . ($user->is_admin ? 'admin' : 'customer') ?>
                        </a>
                    </p>

                    <form action="/webshop/scripts/user_update.php" method="post">
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                        <input type="submit" value="Make admin" class="btn">
                    </form>

                    <form action="/webshop/scripts/user_delete.php" method="post">
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                        <input type="submit" value="Delete" class="btn btn-delete">
                    </form>
                <?php endforeach; ?>
            </div>
        </div>

        </div>



<?php }
} else {
    header('Location: /webshop/index.php');
}

Template::footer();
