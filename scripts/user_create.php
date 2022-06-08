<?php
require_once __DIR__ . '/../classes/User.php';
require_once __DIR__ . '/../classes/UsersDB.php';

$success = false;

if (
    isset($_POST['username'])
    && isset($_POST['password'])
    && isset($_POST['confirm_password'])
    && strlen($_POST['username']) > 0
    && strlen($_POST['password']) > 0
    && $_POST['password'] == $_POST['confirm_password']
) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($username);
    $user->hash_password($password);

    $db = new UserDB;
    $success = $db->create($user);
} else {
    header('Location: /webshop/pages/user/register.php?register=fail');
    die();
}

if ($success) {
    header('Location: /webshop/pages/user/login.php?register=success');
} else {
    header('Location: /webshop/pages/user/register_user.php?register=fail');
    die();
}

/*
    if (empty(trim($username)) || empty(trim($password))) {
        header('Location: /todo/pages/register_user.php?signup=empty');
        die();
    }
*/