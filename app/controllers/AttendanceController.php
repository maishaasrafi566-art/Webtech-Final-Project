<?php
require_once __DIR__ . '/../models/Attendance.php';

class AttendanceController
{
    public function punch()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Unauthorized']);
                exit;
            }
            header("Location: /WebTech Final Project/public/index.php?url=login");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $attendanceModel = new Attendance($GLOBALS['conn']);

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

            $response = ['success' => false, 'message' => ''];
            
            $action = $_POST['action'] ?? '';
            $work_type = $_POST['work_type'] ?? '';

            if ($action === 'punch_in') {
                if (empty($work_type)) {
                    $response['message'] = "Select work type";
                } else {
                    $response['message'] = $attendanceModel->punchIn($user_id, $work_type);
                    $response['success'] = (strpos($response['message'], 'successful') !== false || 
                                           strpos($response['message'], 'Already') !== false);
                }
            } 
            elseif ($action === 'punch_out') {
                $response['message'] = $attendanceModel->punchOut($user_id);
                $response['success'] = (strpos($response['message'], 'successful') !== false);
            }
            else {
                $response['message'] = "Invalid action";
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        
        $today = $attendanceModel->getTodayAttendance($user_id);
        require __DIR__ . '/../views/employee/attendance.php';
    }

    public function history()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
            header("Location: /WebTech Final Project/public/index.php?url=login");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $attendanceModel = new Attendance($GLOBALS['conn']);
        $history = $attendanceModel->getAttendanceHistory($user_id);

        require __DIR__ . '/../views/employee/attendance_history.php';
    }
}