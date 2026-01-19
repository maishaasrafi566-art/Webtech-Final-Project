<!DOCTYPE html>
<html>
<head>
    <title>Admin Attendance</title>
    <link rel="stylesheet" href="/hrm_project/assets/css/admin_attendance.css">
</head>
<body>

<div class="dashboard-container">
    <h2>Employee Attendance</h2>

    <table>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>In</th>
            <th>Out</th>
            <th>Work</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php foreach ($records as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['employee_name']) ?></td>
            <td><?= date("Y-m-d", strtotime($row['punch_in'])) ?></td>
            <td><?= date("H:i:s", strtotime($row['punch_in'])) ?></td>
            <td><?= $row['punch_out'] ? date("H:i:s", strtotime($row['punch_out'])) : '-' ?></td>
            <td><?= htmlspecialchars($row['work_type']) ?></td>
            <td class="<?= strtolower($row['status']) ?>"><?= $row['status'] ?></td>
            <td>
                <?php if ($row['status'] === 'Pending'): ?>
                    <a href="/hrm_project/public/index.php?url=admin-attendance&mark=On-Time&id=<?= $row['id'] ?>" class="btn-approve">On-Time</a>
                    <a href="/hrm_project/public/index.php?url=admin-attendance&mark=Late&id=<?= $row['id'] ?>" class="btn-reject">Late</a>
                <?php else: ?>
                    Reviewed
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
</div>

</body>
</html>
