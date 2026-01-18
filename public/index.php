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

    default:
        echo "404 Page Not Found";
}

