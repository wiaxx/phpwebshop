<?php
require_once __DIR__ . '/../classes/MessagesDB.php';
require_once __DIR__ . '/../classes/User.php';

session_start();

$is_logged_in = isset($_SESSION['logged_in']) && isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;
$is_admin = $is_logged_in && ($logged_in_user->is_admin);

if (!$is_admin) {
    http_response_code(401);
    die();
}

$success = false;

if (
    isset($_POST["response"])
    && isset($_POST["id"])
) {
    $message_db = new MessagesDB();

    $answer = $_POST['response'];
    $id = $_POST['id'];

    $success = $message_db->update($answer, $id);
} else {
    header("Location: /webshop/pages/user/profile.php?answer=fail");
}

if ($success) {
    header("Location: /webshop/pages/user/profile.php");
} else {
    header("Location: /webshop/pages/user/profile.php?answer=fail");
}
