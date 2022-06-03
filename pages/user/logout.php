<?php
session_start();

$_SESSION['logged_in'] = false;
unset($_SESSION['user']);

// session_destroy();

header('Location: /webshop/index.php');