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

            <!-- form for create product and list all products below -->
            <div class="admin-div">

                <h2>Create product</h2>
                <form action="/webshop/scripts/product_create.php" method="post">
                    <input type="text" name="name" placeholder="Product name" required>
                    <input type="text" name="description" placeholder="Description">
                    <input type="number" name="price" placeholder="Price" required>
                    <input type="file" name="picture">
                    <input type="submit" value="Create" class="btn btn-create">
                </form>

                <div>
                    <?php foreach ($products as $product) : ?>
                        <div class="profile-show-all">
                            <a href="/webshop/pages/product.php?id=<?= $product->id ?>" class="link">
                                <?php echo $product ?>
                            </a>

                            <form action="/webshop/scripts/product_update.php" method="post">
                                <input type="hidden" name="id" value="<?= $product->id ?>">
                                <input type="submit" value="Edit" class="btn">
                            </form>

                            <form action="/webshop/scripts/product_delete.php" method="post">
                                <input type="hidden" name="id" value="<?= $product->id ?>">
                                <input type="submit" value="Delete" class="btn btn-delete">
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- form for create user and list all users below -->
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



<?php } else {
        echo 'Show customers order';
    }
} else {
    header('Location: /webshop/index.php');
}

Template::footer();
