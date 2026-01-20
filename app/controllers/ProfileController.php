<?php
require_once __DIR__ . '/../models/User.php';

class ProfileController
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: /hrm_project/public/index.php?url=login");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $userModel = new User($GLOBALS['conn']);
        $user = $userModel->getById($user_id); 

        $success_msg = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name  = $_POST['name'] ?? '';
            $phone = $_POST['phone'] ?? '';

            if ($name || $phone) {
                $userModel->updateProfile($user_id, $name, $phone);
                $user = $userModel->getById($user_id); 
                $success_msg = "Profile updated successfully!";
            }
        }

        require __DIR__ . '/../views/profile/profile.php';
    }
}
