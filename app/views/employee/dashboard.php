<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Dashboard | HRM</title>
    <link rel="stylesheet" href="/WebTech Final Project/assets/css/employee_dashboard.css">
</head>
<body>

<header class="dashboard-header">
    <div class="logo">ABC Solutions Limited</div>
</header>

<main class="dashboard-container">
    <h2>Welcome, <?= htmlspecialchars($user['name']) ?> 👋</h2>
    <p class="subtitle">Employee Dashboard</p>

    <div class="card-grid">

        <a href="/WebTech Final Project/public/index.php?url=attendance" class="card">
            <h3>Attendance</h3>
            <p>Punch in & out</p>
        </a>

        <a href="/WebTech Final Project/public/index.php?url=attendance-history" class="card">
            <h3>Attendance History</h3>
            <p>View attendance</p>
        </a>

        <a href="/WebTech Final Project/public/index.php?url=leave-apply" class="card">
            <h3>Apply Leave</h3>
            <p>Request leave</p>
        </a>

        <a href="/WebTech Final Project/public/index.php?url=leave-history" class="card">
            <h3>Leave History</h3>
            <p>Track leave</p>
        </a>

        <a href="/WebTech Final Project/public/index.php?url=profile" class="card">
            <h3>Profile</h3>
            <p>View & update profile</p>
        </a>

        <a href="/WebTech Final Project/public/index.php?url=change-password" class="card">
            <h3>Change Password</h3>
            <p>Update password</p>
        </a>

        <a href="/WebTech Final Project/public/index.php?url=logout" class="card">
            <h3>Logout</h3>
            <p>Exit system</p>
        </a>

    </div>
</main>

</body>
</html>
