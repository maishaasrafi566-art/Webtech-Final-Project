<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leave History | HRM</title>
    <link rel="stylesheet" href="/WebTech Final Project/assets/css/leave.css">
</head>
<body>

<div class="leave-page">
    <div class="leave-history-card">
        <h2>Leave History</h2>

        <table class="history-table">
            <thead>
                <tr>
                    <th>Leave Type</th>
                    <th>Day Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Reason</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($history as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['leave_type']) ?></td>
                    <td><?= htmlspecialchars($row['day_type']) ?></td>
                    <td><?= $row['from_date'] ?></td>
                    <td><?= $row['to_date'] ?></td>
                    <td><?= htmlspecialchars($row['reason']) ?></td>
                    <td class="status-<?= strtolower($row['status']) ?>">
                        <?= $row['status'] ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="/WebTech Final Project/public/index.php?url=employee-dashboard">⬅ Back to Dashboard</a>
    </div>
</div>

</body>
</html>
