<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/User.php';

class UserDB extends Database
{
    // get one
    public function get_user_by_username($username)
    {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param('s', $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $db_user = mysqli_fetch_assoc($result);

        $user = null;
        if ($db_user) {
            $user = new User($username, $db_user['id']);
            $user->set_password_hash($db_user['passwordHash']);
        }

        return $user;
    }

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
