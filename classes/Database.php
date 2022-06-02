<?php

require __DIR__ . '/../db_credentials.php';

class Database
{
    private $host = DB_SERVER;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db = DB_NAME;

    protected $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);

        if (!$this->conn) {
            die('Error connection to db..');
        }
    }
}
