<?php
require_once __DIR__ . '/../classes/User.php';
require_once __DIR__ . '/../classes/UsersDB.php';

$success = false;

if (isset($_POST['role']) && isset($_POST['id']) && isset($_POST['username'])) {

    $username = $_POST['username'];
    $is_admin = $_POST['role'];
    $user_id = $_POST['id'];

    $db = new UserDB();

    $user = new User($username, $is_admin, $user_id);

    $success = $db->update($user);
} else {
    header("Location: /webshop/pages/user/profile.php?update=fail");
}

if ($success) {
    header("Location: /webshop/pages/user/profile.php");
} else {
    header("Location: /webshop/pages/user/profile.php?update=fail");
}
