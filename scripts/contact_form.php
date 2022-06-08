<?php
require_once __DIR__ . '/../classes/User.php';
require_once __DIR__ . '/../classes/Message.php';
require_once __DIR__ . '/../classes/MessagesDB.php';
session_start();

$success = false;

if (
    isset($_POST['option']) &&
    isset($_POST['title']) &&
    isset($_POST['message']) &&
    isset($_SESSION['user'])
) {

    $user_id = $_SESSION['user']->id;

    $contact_option = $_POST['option'];
    $title = $_POST['title'];
    $message = $_POST['message'];

    $db = new MessagesDB();

    $message = new Message($user_id, $contact_option, $title, $message);
    $success = $db->create($message);
} else {
    header('Location: /webshop/pages/user/profile.php?message=fail');
}

if ($success) {
    header('Location: /webshop/pages/user/profile.php');
} else {
    header('Location: /webshop/pages/user/profile.php?message=fail');
    die();
}
