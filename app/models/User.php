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





       public function updatePassword($email, $hashedPassword)
    {
        $stmt = mysqli_prepare(
            $this->conn,
            "UPDATE users SET password = ? WHERE email = ?"
        );
        mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $email);

        return mysqli_stmt_execute($stmt);
    }







public function updatePasswordById($userId, $hashedPassword)
{
    $stmt = mysqli_prepare(
        $this->conn,
        "UPDATE users SET password = ? WHERE id = ?"
    );
    mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $userId);

    return mysqli_stmt_execute($stmt);
}




public function getById($id)
{
    $stmt = mysqli_prepare($this->conn, "SELECT * FROM users WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($res);
}

public function updateProfile($id, $name, $phone)
{
    $stmt = mysqli_prepare($this->conn, "UPDATE users SET name=?, phone=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssi", $name, $phone, $id);
    return mysqli_stmt_execute($stmt);
}





}
