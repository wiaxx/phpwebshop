<?php
require_once __DIR__ . '/../classes/UsersDB.php';

$success = false;

if (isset($_POST['id'])) {

    $db = new UserDB();

    $user_id = $_POST['id'];
    $success = $db->delete($user_id);
} else {
    echo 'Invalid input';
}

if ($success) {
    header('Location: /webshop/pages/user/profile.php');
} else {
    echo 'Something went wrong';
}
