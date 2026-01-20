<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leave Requests | Admin</title>
    <link rel="stylesheet" href="/WebTech Final Project/assets/css/admin_leave.css">
</head>
<body>

<header class="dashboard-header">
    <div class="logo">ABC Solutions Limited</div>
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
                <?php foreach($leaves as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['employee_name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['leave_type']) ?></td>
                    <td><?= htmlspecialchars($row['day_type']) ?></td>
                    <td><?= $row['from_date'] ?></td>
                    <td><?= $row['to_date'] ?></td>
                    <td><?= htmlspecialchars($row['reason']) ?></td>
                    <td><?= htmlspecialchars($row['emergency_name']) ?> / <?= htmlspecialchars($row['emergency_phone']) ?></td>
                    <td class="<?= strtolower($row['status'] ?? 'pending') ?>">
                        <?= $row['status'] ?? 'Pending' ?>
                    </td>
                    <td>
                        <?php if(($row['status'] ?? 'Pending') === 'Pending'): ?>
                            <div class="action-buttons">
                                <a href="/WebTech Final Project/public/index.php?url=admin-leaves&approve=1&id=<?= $row['id'] ?>" class="approve-btn">Approve</a>
                                <a href="/WebTech Final Project/public/index.php?url=admin-leaves&reject=1&id=<?= $row['id'] ?>" class="reject-btn">Reject</a>
                            </div>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</main>

</body>
</html>
