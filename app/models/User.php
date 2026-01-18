<?php

class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

        public function getUserByEmail($email)
    {
        $stmt = mysqli_prepare(
            $this->conn,
            "SELECT id, role, password FROM users WHERE email = ?"
        );
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        return mysqli_stmt_get_result($stmt);
    }











}
