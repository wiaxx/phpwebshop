<?php

if (
    isset($_POST['username'])
    && isset($_POST['password'])
    && isset($_POST['confirm_password'])
    && strlen($_POST['username']) > 0
    && strlen($_POST['password']) > 0
    && $_POST['password'] == $_POST['confirm_password']
) {
    echo 'Valid input';
} else {
    echo 'Invalid input';
}
