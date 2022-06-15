<?php
require_once __DIR__ . '/../classes/User.php';
require_once __DIR__ . '/../classes/UsersDB.php';
session_start();

$is_logged_in = isset($_SESSION['logged_in']) && isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;
$is_admin = $is_logged_in && ($logged_in_user->is_admin);

if (!$is_admin) {
    http_response_code(401);
    die();
}

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
