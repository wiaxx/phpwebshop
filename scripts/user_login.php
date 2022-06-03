<?php
require_once __DIR__ . '/../classes/User.php';
require_once __DIR__ . '/../classes/UsersDB.php';

session_start();

$success = false;

if (
    isset($_POST['username'])
    && isset($_POST['password'])
    && strlen($_POST['username']) > 0
    && strlen($_POST['password']) > 0
) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new UserDB;
    $user = $db->get_user_by_username($username);

    if ($user) {
        $success = $user->test_password($password);

        if ($success) {
            $_SESSION["logged_in"] = true;
            $_SESSION["user"] = $user;
        }
    }
} else {
    header('Location: /webshop/pages/user/login.php?login=fail');
    die();
}

if ($success) {
    header('Location: /webshop/pages/user/profile.php');
} else {
    header('Location: /webshop/pages/user/login.php?login=fail');
    die();
}
