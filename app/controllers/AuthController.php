<?php

require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../models/User.php";

class AuthController
{


    public function register()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $error = "";
        $success = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                'name'     => trim($_POST['name'] ?? ''),
                'email'    => trim($_POST['email'] ?? ''),
                'phone'    => trim($_POST['phone'] ?? ''),
                'address'  => trim($_POST['address'] ?? ''),
                'gender'   => $_POST['gender'] ?? '',
                'dob'      => $_POST['dob'] ?? '',
                'role'     => $_POST['role'] ?? 'employee',
                'password' => $_POST['password'] ?? '',
                'confirm'  => $_POST['confirm_password'] ?? ''
            ];

            if (!$data['name'] || !$data['email'] || !$data['password'] || !$data['confirm']) {
                $error = "All required fields must be filled";

            } elseif ($data['password'] !== $data['confirm']) {
                $error = "Passwords do not match";

            }}}

 





}
