<?php
session_start();

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';

$url = $_GET['url'] ?? 'login';

switch ($url) {



    case 'register':
        (new AuthController())->register();
        break;



    case 'change-password':
        (new AuthController())->changePassword();
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


    default:
        echo "404 Page Not Found";
}

