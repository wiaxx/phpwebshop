<?php
require_once __DIR__ . '/../../classes/User.php';
require_once __DIR__ . '/../../classes/UsersDB.php';
require_once __DIR__ . '/../../classes/Template.php';
require_once __DIR__ . '/../../classes/Product.php';
require_once __DIR__ . '/../../classes/ProductsDB.php';
require_once __DIR__ . '/../../classes/Order.php';
require_once __DIR__ . '/../../classes/OrdersDB.php';
require_once __DIR__ . '/../../classes/Message.php';
require_once __DIR__ . '/../../classes/MessagesDB.php';

$products_db = new ProductsDB();
$products = $products_db->get_all_products();

$users_db = new UserDB();
$users = $users_db->get_all();

$message_db = new MessagesDB();
$messages = $message_db->get_all();
$user_messages = $message_db->get_all_by_user($_SESSION['user']->id);

$orders_db = new OrdersDB();
$orders = $orders_db->get_all();

$customer_orders = $orders_db->get_all_by_user($_SESSION['user']->id);


Template::header('Profile page');

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {

    $is_admin = (bool) $_SESSION['user']->is_admin;

    if ($is_admin) { ?>

        <div class="admin-create-div">

            <!-- form for create product and list all products below -->
            <div class="admin-div">

                <h2>Create product</h2>
                <form action="/webshop/scripts/product_create.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="name" placeholder="Product name" required>
                    <textarea name="description" cols="30" rows="5" placeholder="Description" class="text-input"></textarea>
                    <input type="number" name="price" placeholder="Price" required>
                    <input type="file" name="image" accept="image/*">
                    <input type="submit" value="Create" class="btn btn-create">
                </form>

                <div>
                    <h3>All products</h3>
                    <?php foreach ($products as $product) : ?>
                        <div class="profile-show-all">
                            <a href="/webshop/pages/product.php?id=<?= $product->id ?>" class="link">
                                <?php echo $product->name ?>
                            </a>

                            <a href="/webshop/pages/product.php?id=<?= $product->id ?>" class="btn btn-edit">
                                <?php echo "Edit" ?>
                            </a>

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

                <h3>All users</h3>
                <?php foreach ($users as $user) : ?>
                    <div class="profile-show-all">

                        <p class="link">
                            <?php echo $user->id . ' : ' .  $user->username . ' : ' . ($user->is_admin ? 'admin' : 'customer') ?>
                        </p>

                        <form action="/webshop/scripts/user_update.php" method="post" class="change-roll">
                            <select name="role" class="btn">
                                <option value="0">Customer</option>
                                <option value="1">Admin</option>
                            </select>
                            <input type="hidden" name="username" value="<?= $user->username ?>">
                            <input type="hidden" name="id" value="<?= $user->id ?>">
                            <input type="submit" value="Change role" class="btn">
                        </form>

                        <form action="/webshop/scripts/user_delete.php" method="post">
                            <input type="hidden" name="id" value="<?= $user->id ?>">
                            <input type="submit" value="Delete" class="btn btn-delete">
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

        <div class="admin-create-div">
            <!-- list all orders -->
            <div class="admin-order-div">
                <h2>All orders</h2>

                <?php foreach ($orders as $order) :
                ?>
                    <div class="profile-show-all">

                        <p class="link">
                            <?php //echo  $order
                            ?>
                        </p>

                        <form action="/webshop/scripts/order_update.php" method="post">
                            <input type="hidden" name="id" value="<?= $order->id ?>">

                            <?php if ($order->status == 'ongoing') : ?>
                                <input type="submit" value="Update status to sent" class="btn">
                                <!-- change input value of button when order is sent -->
                            <?php elseif ($order->status == 'SENT') : ?>
                                <input type="submit" value="Order Sent" class="btn">
                            <?php endif; ?>
                        </form>
                    </div>
                <?php endforeach;
                ?>

            </div>

            <!-- list all messages from customers -->
            <div class="admin-message-div">
                <h2>Incoming messages</h2>

                <?php foreach ($messages as $message) : ?>
                    <div class="profile-all-mess">

                        <details>
                            <summary>
                                <b>Contact option: </b><?= $message->contact_option ?> |
                                <b>Title: </b><?= $message->title; ?>
                                <b>CustomerId: </b><?= $message->user_id; ?>
                                <b>Status: </b><?= $message->response_message ? 'Done' : '<p class="done">New</p>' ?>
                            </summary>
                            <p><b>Meddelange: </b><?= $message->message ?></p>
                            <p><b>Svar: </b><?= $message->response_message ?></p>
                        </details>

                        <form action="/webshop/scripts/contact_update.php" method="post">
                            <textarea name="response" id="" cols="30" rows="2" placeholder="Write answer here"></textarea>
                            <input type="hidden" name="id" value="<?= $message->id ?>">
                            <input type="submit" value="Answer" class="btn">
                        </form>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    <?php } else { ?>

        <div class="customer-div">

            <div class="customer-orders-div">

                <h2>My Orders</h2>
                <!-- if logged in show specific users orders -->

                <?php foreach ($orders as $order) : ?>
                    <div class="profile-show-all">
                        <p class="link">
                            <?php echo $order->id . ' : ' .  $order->status ?>
                        </p>
                    </div>
                <?php endforeach; ?>

                <?php foreach ($orders as $order) : ?>
                    <div class="profile-show-all">
                        <p> <?= $order->customerID  ?> </p>
                    </div>
                <?php endforeach; ?>



            </div>

            <!-- create and list users messages -->
            <div class="customer-contact-div">

                <h2>Contact form</h2>

                <form action="/webshop/scripts/contact_form.php" method="post">
                    <select name="option" class="change-roll">
                        <option value="order">Order</option>
                        <option value="question">Question</option>
                        <option value="other">Other</option>
                    </select>
                    <input type="text" name="title" placeholder="Title" required>
                    <input type="text" name="message" placeholder="Write message here..." required>
                    <input type="submit" value="Send">
                </form>

                <h2>My messages</h2>

                <?php foreach ($user_messages as $user_message) : ?>
                    <div class="profile-show-all">

                        <details>
                            <summary>
                                <b>Contact option: </b><?= $user_message->contact_option ?> |
                                <b>Title: </b><?= $user_message->title; ?>
                                <b>Status: </b><?= $user_message->response_message ? '<p class="done">Answered</p>' : 'Waiting' ?>

                            </summary>
                            <p><b>Meddelange: </b><?= $user_message->message ?></p>
                            <p><b>Svar: </b><?= $user_message->response_message ?></p>
                        </details>

                    </div>
                <?php endforeach; ?>
            </div>

        </div>

        </div>
<?php   }
} else {
    header('Location: /webshop/index.php');
}

Template::footer();
