<?php

class Template
{
    public static function header($title)
    { ?>
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
            <h1><?= $title ?></h1>
            <nav>
                <a href="/webshop">Home</a> |
                <a href="/webshop/pages/products.php">Products</a> |
                <a href="/webshop/pages/user/login.php">Login</a> |
                <a href="/webshop/pages/user/register.php">Register</a>
                <a href="/webshop/pages/shopcart.php">Cart</a>
            </nav>
            <main>

            <?php }

        public static function footer()
        { ?>
            </main>
            <footer>
                Copyright php 2022
            </footer>

        </body>

        </html>
<?php }
    }
