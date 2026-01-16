<?php
session_start();
include("../config/db.php");


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];


$stmt = mysqli_prepare($conn, "SELECT name, email FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Dashboard | HRM</title>
    <link rel="stylesheet" href="../assets/css/employee_dashboard.css">
</head>
<body>


<header class="dashboard-header">
    <div class="logo">ABC Solutions Limited</div>
    </div>
</header>


<main class="dashboard-container">
    <h2>Welcome, <?= htmlspecialchars($user['name']) ?> 👋</h2>
    <p class="subtitle">Employee Dashboard</p>

    <div class="card-grid">

        <a href="attendance.php" class="card">
            <h3>Attendance</h3>
            <p>Punch in & out</p>
        </a>

        <a href="attendance_history.php" class="card">
            <h3>Attendance History</h3>
            <p>View attendance</p>
        </a>

        <a href="leave_apply.php" class="card">
            <h3>Apply Leave</h3>
            <p>Request leave</p>
        </a>

        <a href="leave_history.php" class="card">
            <h3>Leave History</h3>
            <p>Track leave</p>
        </a>

        <a href="../profile.php" class="card">
            <h3>Profile</h3>
            <p>View & update profile</p>
        </a>

        <a href="../auth/change_password.php" class="card">
            <h3>Change Password</h3>
            <p>Update password</p>
        </a>

        <a href="../auth/logout.php" class="card">
            <h3>Logout</h3>
            <p>Exit system</p>
        </a>

    </div>
</main>

</body>
</html>
