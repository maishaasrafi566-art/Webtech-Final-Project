
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | HRM</title>
    <link rel="stylesheet" href="../assets/css/admin_dashboard.css">
</head>
<body>

<header class="dashboard-header">
    <div class="logo">ABC Solutions Limited</div>

   </header>
<main class="dashboard-container">
    <h2>Welcome, <?= htmlspecialchars($user['name']) ?> 👋</h2>
    <p class="subtitle">Admin Dashboard</p>

    <div class="card-grid">

        <a href="employees.php" class="card">
            <h3>Employees</h3>
            <p>Manage all employees</p>
        </a>

        <a href="attendance.php" class="card">
            <h3>Attendance</h3>
            <p>Employee attendance records</p>
        </a>

        <a href="leaves.php" class="card">
            <h3>Leave Requests</h3>
            <p>Approve or reject leaves</p>
        </a>

        <a href="../profile.php" class="card">
            <h3>Profile</h3>
            <p>View & update profile</p>
        </a>

        <a href="../auth/change_password.php" class="card">
            <h3>Change Password</h3>
            <p>Update your password</p>
        </a>

        <a href="../auth/logout.php" class="card">
            <h3>Logout</h3>
            <p>Exit system</p>
        </a>

    </div>
</main>

</body>
</html>
