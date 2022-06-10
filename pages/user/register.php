<?php
require_once __DIR__ . '/../../classes/Template.php';

Template::header('Register');

?>

<div class="user-div">

    <form action="/webshop/scripts/user_create.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <input type="submit" value="Register" class="btn btn-create">
    </form>

</div>

<?php

Template::footer();
