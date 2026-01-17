<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Employee | Admin</title>
    <link rel="stylesheet" href="../assets/css/admin_view_employee.css">
</head>
<body>

<header class="dashboard-header">
    <div class="logo">ABC Solutions Limited</div>
    <div class="profile-menu">
        <span class="user-name">Admin</span>
        <div class="dropdown">
            <a href="profile.php">Profile</a>
            <a href="../auth/change_password.php">Change Password</a>
            <a href="../auth/logout.php" class="logout">Logout</a>
        </div>
    </div>
</header>

<main class="dashboard-container">
    <h2>Employee Profile</h2>

    <div class="profile-card">
        <p><strong>Name:</strong> <?= htmlspecialchars($user['NAME'] ?? '-') ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email'] ?? '-') ?></p>
        <p><strong>Role:</strong> <?= htmlspecialchars($user['role'] ?? '-') ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone'] ?? '-') ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($user['address'] ?? '-') ?></p>
        <p><strong>Date of Birth:</strong> <?= htmlspecialchars($user['dob'] ?? '-') ?></p>
        <p><strong>Gender:</strong> <?= htmlspecialchars($user['gender'] ?? '-') ?></p>
    </div>
</main>

</body>
</html>
