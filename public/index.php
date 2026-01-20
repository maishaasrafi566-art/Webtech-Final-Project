<?php
session_start();

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/controllers/EmployeeController.php';
require_once __DIR__ . '/../app/controllers/AttendanceController.php';
require_once __DIR__ . '/../app/controllers/LeaveController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/ProfileController.php';
$url = $_GET['url'] ?? 'login';

switch ($url) {

    case 'login':
        (new AuthController())->login();
        break;

    case 'register':
        (new AuthController())->register();
        break;

    case 'forgot':
        (new AuthController())->forgot();
        break;

    case 'change-password':
        (new AuthController())->changePassword();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;

    case 'employee-dashboard':
        (new EmployeeController())->dashboard();
        break;

case 'attendance':
    (new AttendanceController())->punch();
    break;
case 'attendance-history':
    (new AttendanceController())->history();
    break;

case 'leave-apply':
    (new LeaveController())->apply();
    break;

case 'leave-history':
    (new LeaveController())->history();
    break;
case 'admin-dashboard':
    (new AdminController())->dashboard();
    break;

case 'admin-attendance':
    (new AdminController())->attendance();
    break;
case 'admin-leaves':
    (new AdminController())->leaveRequests();
    break;
case 'admin-view-employee':
    (new AdminController())->viewEmployee();
    break;
case 'admin-employees':
    (new AdminController())->employees();
    break;
case 'profile':
    (new ProfileController())->index();
    break;

    default:
        echo "404 Page Not Found";
}

