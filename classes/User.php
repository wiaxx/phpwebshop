<?php

class User
{
    public $id;
    public $username;
    private $password_hash;
    public $is_admin;

    public function __construct($username, $is_admin = false, $id = 0)
    {
        if ($is_admin != false) {
            $this->is_admin = $is_admin;
        }

        if ($id > 0) {
            $this->id = $id;
        }

        $this->username = $username;
    }

    public function hash_password($password)
    {
        $this->password_hash = password_hash($password, null);
    }

    public function get_password_hash()
    {
        return $this->password_hash;
    }

    public function set_password_hash($password_hash)
    {
        $this->password_hash = $password_hash;
    }

    public function test_password($password)
    {
        $correct = password_verify($password, $this->password_hash);
        return $correct;
    }
}
