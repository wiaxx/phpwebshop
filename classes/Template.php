<?php
require_once __DIR__ . '/User.php';
session_start();

class Template
{
    public static function header($title)
    {
        $is_logged_in = isset($_SESSION['logged_in']) && isset($_SESSION['user']);
        $logged_in_user = $is_logged_in ? $_SESSION['user'] : null;
        $is_admin = $is_logged_in && ($logged_in_user->is_admin);
        $totalt_cart_items = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="/webshop/assets/index.js" defer></script>
            <link rel="stylesheet" href="/webshop/assets/style.css">

            <title><?= $title ?> - Shop</title>
        </head>

        <body>
            <header>
                <h1 class="title"><?= $title ?></h1>
            </header>
            <nav>
                <a href="/webshop">Home</a> |
                <a href="/webshop/pages/products.php">Products</a> |
                <a href="/webshop/pages/shopcart.php">Cart (<?= $totalt_cart_items ?>)</a> |

                <?php if ($is_logged_in) : ?>
                    <a href="/webshop/pages/user/profile.php"> <?= $is_admin ? 'Admin' : 'Profile' ?></a> |
                    <a href="/webshop/pages/user/logout.php">Log out</a>
                <?php else : ?>
                    <a href="/webshop/pages/user/login.php">Login</a> |
                    <a href="/webshop/pages/user/register.php">Register</a> |
                <?php endif; ?>
            </nav>


            <main>

            <?php }

        public static function footer()
        { ?>
            </main>
            <footer>
                Copyright 2022
            </footer>

        </body>

        </html>
<?php }
    }
