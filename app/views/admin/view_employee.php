<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Employee | Admin</title>
    <link rel="stylesheet" href="/hrm_project/assets/css/admin_view_employee.css">
</head>
<body>

<header class="dashboard-header">
    <div class="logo">ABC Solutions Limited</div>
</header>

<main class="dashboard-container">
    <h2>Employee Profile</h2>

    <div class="profile-card">
        <p><strong>Name:</strong> <?= htmlspecialchars($employee['name'] ?? '-') ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($employee['email'] ?? '-') ?></p>
        <p><strong>Role:</strong> <?= htmlspecialchars($employee['role'] ?? '-') ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($employee['phone'] ?? '-') ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($employee['address'] ?? '-') ?></p>
        <p><strong>Date of Birth:</strong> <?= htmlspecialchars($employee['dob'] ?? '-') ?></p>
        <p><strong>Gender:</strong> <?= htmlspecialchars($employee['gender'] ?? '-') ?></p>
    </div>

    <a href="/hrm_project/public/index.php?url=admin-employees">⬅ Back to Employee List</a>
</main>

</body>
</html>
