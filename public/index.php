<?php
session_start();

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/models/User.php';


$url = $_GET['url'] ?? 'login';

switch ($url) {

    case 'login':
        (new AuthController())->login();
        break;


    case 'forgot':
        (new AuthController())->forgot();
        break;


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



    default:
        echo "404 Page Not Found";
}

