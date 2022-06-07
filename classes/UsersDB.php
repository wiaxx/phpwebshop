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
    public function get_all()
    {
        $query = "SELECT * FROM users";
        $result = mysqli_query($this->conn, $query);
        $db_users = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $users = [];

        foreach ($db_users as $db_user) {

            $db_id = $db_user["id"];
            $db_admin = $db_user["isAdmin"];
            $db_username = $db_user["username"];

            $users[] = new User($db_username, $db_admin, $db_id);
        }

        return $users;
    }

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
    public function update(User $user) {
        $query = "UPDATE users SET isAdmin = ? WHERE id = ?";

        $is_admin = $user->is_admin;
        $user_id = $user->id;

        $stmt = mysqli_prepare($this->conn,$query);
        $stmt->bind_param('ii', $is_admin, $user_id);

        $success = $stmt->execute();

        return $success;
    }

    // delete
    public function delete($user_id)
    {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param('i', $user_id);

        $success = $stmt->execute();

        return $success;
    }
}
