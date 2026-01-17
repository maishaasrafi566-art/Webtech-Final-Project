
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employees | Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin_employees.css">
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
    <h2>Employee List</h2>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($res)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['NAME'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['email'] ?? '-') ?></td>
                        <td><a href="view_employee.php?id=<?= $row['id'] ?>" class="view-btn">View</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
