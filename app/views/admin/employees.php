<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employees | Admin Dashboard</title>
    <link rel="stylesheet" href="/hrm_project/assets/css/admin_employees.css">
</head>
<body>

<header class="dashboard-header">
    <div class="logo">ABC Solutions Limited</div>
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
                <?php foreach($employees as $emp): ?>
                    <tr>
                        <td><?= htmlspecialchars($emp['NAME'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($emp['email'] ?? '-') ?></td>
                        <td>
                            <a href="/WebTech Final Project/public/index.php?url=admin-view-employee&id=<?= $emp['id'] ?>" class="view-btn">
                                View
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a href="/WebTech Final Project/public/index.php?url=admin-dashboard">⬅ Back to Dashboard</a>
</main>

</body>
</html>
