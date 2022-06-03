<?php
require_once __DIR__ . '/../../classes/Template.php';

Template::header('Login');

?>

<div class="user-div">
    <form action="/webshop/scripts/user_login.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Login">
    </form>
</div>

<?php
Template::footer();