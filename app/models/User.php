<?php

class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // LOGIN
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

    // REGISTER / FORGOT
    public function emailExists($email)
    {
        $stmt = mysqli_prepare(
            $this->conn,
            "SELECT id FROM users WHERE email = ?"
        );
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        return mysqli_stmt_num_rows($stmt) > 0;
    }

    // REGISTER
    public function register($data)
    {
        $stmt = mysqli_prepare(
            $this->conn,
            "INSERT INTO users 
            (name, email, phone, address, gender, dob, role, password)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssssssss",
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['address'],
            $data['gender'],
            $data['dob'],
            $data['role'],
            $data['password']
        );

        return mysqli_stmt_execute($stmt);
    }

    // FORGOT PASSWORD
    public function updatePassword($email, $hashedPassword)
    {
        $stmt = mysqli_prepare(
            $this->conn,
            "UPDATE users SET password = ? WHERE email = ?"
        );
        mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $email);

        return mysqli_stmt_execute($stmt);
    }






public function getPasswordById($userId)
{
    $stmt = mysqli_prepare(
        $this->conn,
        "SELECT password FROM users WHERE id = ?"
    );
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
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

    public function getAllEmployees()
    {
        $stmt = mysqli_prepare($this->conn, "SELECT * FROM users WHERE role='employee' ORDER BY name ASC");
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $employees = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $employees[] = $row;
        }

        return $employees;
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
