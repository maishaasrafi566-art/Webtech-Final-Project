<?php

require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../models/User.php";

class AuthController
{
     public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $error = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email !== "" && $password !== "") {

                $userModel = new User($GLOBALS['conn']);
                $result = $userModel->getUserByEmail($email);

                if ($result && mysqli_num_rows($result) === 1) {
                    $user = mysqli_fetch_assoc($result);

                    if (password_verify($password, $user['password'])) {

                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['role']    = $user['role'];


                        if ($user['role'] === 'admin') {
                            header("Location: /hrm_project/public/index.php?url=admin-dashboard");
                        } else {
                            header("Location: /hrm_project/public/index.php?url=employee-dashboard");
                        }
                        exit;

                    } else {
                        $error = "Incorrect password";
                    }

                } else {
                    $error = "Email not found";
                }

            } else {
                $error = "All fields are required";
            }
        }

        require __DIR__ . "/../views/auth/login.php";
    }







public function logout()
{
   
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    session_unset();
    session_destroy();

    header("Location: /hrm_project/public/index.php?url=login");
    exit;
}


}
