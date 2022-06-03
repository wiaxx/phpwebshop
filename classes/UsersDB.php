<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/User.php';

class UserDB extends Database
{
    // get one

    // get all

    // create
    public function create(User $user)
    {
        $query = "INSERT INTO users (username, passwordHash) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->conn, $query);

        $username = $user->username;
        $password_hash = $user->get_password_hash();

        $stmt->bind_param('ss', $username, $password_hash);
        $success = $stmt->execute();

        return $success;
    }

    // update

    // delete
}
