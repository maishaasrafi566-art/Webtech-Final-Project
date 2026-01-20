<?php
require_once __DIR__ . '/../models/Leave.php';

class LeaveController
{
    public function apply()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            header("Location: /hrm_project/public/index.php?url=login");
            exit;
        }

        $user_id = $_SESSION['user_id'];

       
        if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

            $response = ['success' => false, 'error' => ''];

            $data = [
                'leave_type'      => $_POST['type'] ?? '',
                'day_type'        => $_POST['day'] ?? '',
                'from_date'       => $_POST['from'] ?? '',
                'to_date'         => $_POST['to'] ?? '',
                'reason'          => $_POST['reason'] ?? '',
                'emergency_name'  => $_POST['ename'] ?? '',
                'emergency_phone' => $_POST['ephone'] ?? ''
            ];

            if ($data['from_date'] > $data['to_date']) {
                $response['error'] = "From date cannot be greater than To date";
            } else {
                $leaveModel = new Leave($GLOBALS['conn']);
                if ($leaveModel->apply($user_id, $data)) {
                    $response['success'] = true;
                } else {
                    $response['error'] = "Failed to apply leave. Try again.";
                }
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        
        $success_msg = "";
        require __DIR__ . '/../views/employee/leave_apply.php';
    }

    public function history()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            header("Location: /hrm_project/public/index.php?url=login");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $leaveModel = new Leave($GLOBALS['conn']);
        $history = $leaveModel->getHistory($user_id);

        require __DIR__ . '/../views/employee/leave_history.php';
    }
}
