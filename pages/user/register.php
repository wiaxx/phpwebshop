<?php
require_once __DIR__ . '/../../classes/Template.php';

Template::header('Register');

?>

<div class="user-div">

    <form action="/webshop/scripts/user_create.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirm_password" placeholder="Password">
        <input type="submit" value="Register">
    </form>

</div>

<?php

Template::footer();