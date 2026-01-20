<?php

require_once __DIR__ . "/../models/User.php";

class EmployeeController
{
    private $userModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            header("Location: /hrm_project/public/index.php?url=login");
            exit;
        }

        $this->userModel = new User($GLOBALS['conn']);
    }

    public function dashboard()
    {
        $user_id = $_SESSION['user_id'];

       
        $stmt = mysqli_prepare($GLOBALS['conn'], "SELECT name, email FROM users WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);


        require __DIR__ . "/../views/employee/dashboard.php";
    }
}
