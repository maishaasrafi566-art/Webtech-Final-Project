<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Attendance History</title>
    <link rel="stylesheet" href="/hrm_project/assets/css/attendance_history.css">
</head>
<body>

<div class="container">
    <h2>Attendance History</h2>

    <table>
        <tr>
            <th>Date</th>
            <th>In</th>
            <th>Out</th>
            <th>Work Type</th>
            <th>Status</th>
        </tr>

        <?php foreach($history as $row): ?>
        <tr>
            <td><?= date("Y-m-d", strtotime($row['punch_in'])) ?></td>
            <td><?= date("H:i:s", strtotime($row['punch_in'])) ?></td>
            <td><?= $row['punch_out'] ? date("H:i:s", strtotime($row['punch_out'])) : '-' ?></td>
            <td><?= htmlspecialchars($row['work_type']) ?></td>
            <td class="<?= strtolower($row['status']) ?>">
                <?= $row['status'] ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="/WebTech Final Project/public/index.php?url=employee-dashboard">⬅ Back to Dashboard</a>
</div>

</body>
</html>
