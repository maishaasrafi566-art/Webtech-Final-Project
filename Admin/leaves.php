<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leave Requests | Admin</title>
    <link rel="stylesheet" href="../assets/css/admin_leave.css">
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
    <h2>Leave Requests</h2>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Leave Type</th>
                    <th>Day Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Reason</th>
                    <th>Emergency Contact</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['employee_name']) ?></td>
                    <td><?= htmlspecialchars($row['EMAIL']) ?></td>
                    <td><?= htmlspecialchars($row['PHONE']) ?></td>
                    <td><?= htmlspecialchars($row['leave_type']) ?></td>
                    <td><?= htmlspecialchars($row['day_type']) ?></td>
                    <td><?= $row['from_date'] ?></td>
                    <td><?= $row['to_date'] ?></td>
                    <td><?= htmlspecialchars($row['reason']) ?></td>
                    <td><?= htmlspecialchars($row['emergency_name'])." / ".$row['emergency_phone'] ?></td>
                    <td class="<?= strtolower($row['status']) ?>">
                        <?= $row['status'] ?? 'Pending' ?>
                    </td>
                    <td>
                        <?php if($row['status'] === 'Pending'): ?>
                        <div class="action-buttons">
                            <a href="?approve=<?= $row['id'] ?>" class="approve-btn">Approve</a>
                            <a href="?reject=<?= $row['id'] ?>" class="reject-btn">Reject</a>
                        </div>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
