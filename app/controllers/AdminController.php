<?php
require_once __DIR__ . '/../models/AdminAttendance.php';
require_once __DIR__ . '/../models/AdminLeave.php';
class AdminController
{
    public function dashboard()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: /hrm_project/public/index.php?url=login");
            exit;
        }

        $user_id = $_SESSION['user_id'];


        $stmt = mysqli_prepare($GLOBALS['conn'], "SELECT name, email FROM users WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result); 
        require __DIR__ . '/../views/admin/dashboard.php';
    }

    public function attendance()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: /hrm_project/public/index.php?url=login");
            exit;
        }

        $attendanceModel = new AdminAttendance($GLOBALS['conn']);

       
        if (isset($_GET['mark']) && isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $status = $_GET['mark'];
            $attendanceModel->updateStatus($id, $status);
            header("Location: /hrm_project/public/index.php?url=admin-attendance");
            exit;
        }

        $records = $attendanceModel->getAllAttendance();

        require __DIR__ . '/../views/admin/attendance.php';
    }



    public function leaveRequests()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: /hrm_project/public/index.php?url=login");
            exit;
        }

        $leaveModel = new AdminLeave($GLOBALS['conn']);


        if (isset($_GET['approve']) && isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $leaveModel->updateStatus($id, 'Approved');
            header("Location: /hrm_project/public/index.php?url=admin-leaves");
            exit;
        }

        if (isset($_GET['reject']) && isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $leaveModel->updateStatus($id, 'Rejected');
            header("Location: /hrm_project/public/index.php?url=admin-leaves");
            exit;
        }

        $leaves = $leaveModel->getAllLeaves();

        require __DIR__ . '/../views/admin/leaves.php';
    }

public function viewEmployee()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: /hrm_project/public/index.php?url=login");
        exit;
    }

    $id = $_GET['id'] ?? 0;

    require_once __DIR__ . '/../models/User.php';
    $userModel = new User($GLOBALS['conn']);
    $employee = $userModel->getById($id);

    if (!$employee) {
        die("Employee not found.");
    }

    require __DIR__ . '/../views/admin/view_employee.php';
}

public function employees()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: /hrm_project/public/index.php?url=login");
        exit;
    }

    require_once __DIR__ . '/../models/User.php';
    $userModel = new User($GLOBALS['conn']);
    $employees = $userModel->getAllEmployees();

    require __DIR__ . '/../views/admin/employees.php';
}





}
