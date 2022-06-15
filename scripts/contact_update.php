<?php
require_once __DIR__ . '/../classes/MessagesDB.php';

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
