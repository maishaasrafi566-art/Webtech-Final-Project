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

 



public function changePassword()
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: /hrm_project/public/index.php?url=login");
        exit;
    }

    $error = "";
    $success = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $old_pass = $_POST['old_password'] ?? '';
        $new_pass = $_POST['new_password'] ?? '';
        $confirm  = $_POST['confirm_password'] ?? '';

        if (!$old_pass || !$new_pass || !$confirm) {
            $error = "All fields are required";

        } elseif ($new_pass !== $confirm) {
            $error = "New passwords do not match";

        } else {

            $userModel = new User($GLOBALS['conn']);
            $result = $userModel->getPasswordById($_SESSION['user_id']);

            if ($result && mysqli_num_rows($result) === 1) {

                $row = mysqli_fetch_assoc($result);

                if (!password_verify($old_pass, $row['password'])) {
                    $error = "Old password is incorrect";

                } else {

                    $hashed = password_hash($new_pass, PASSWORD_DEFAULT);

                    if ($userModel->updatePasswordById($_SESSION['user_id'], $hashed)) {
                        $success = "Password changed successfully";
                    } else {
                        $error = "Password update failed";
                    }
                }

            } else {
                $error = "User not found";
            }
        }
    }

    require __DIR__ . "/../views/auth/change_password.php";
}




}
