
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password | HRM System</title>
    <link rel="stylesheet" href="../assets/css/change_password.css">
</head>
<body>

<div class="change-wrapper">
    <div class="change-box">

        <h2>Change Password</h2>

        <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-msg"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST">

            <input type="password" name="old_password"
                   placeholder="Current Password" required>

            <input type="password" name="new_password"
                   placeholder="New Password" required>

            <input type="password" name="confirm_password"
                   placeholder="Confirm New Password" required>

            <button type="submit">Update Password</button>
        </form>

        <a href="../employee/dashboard.php">⬅ Back to Dashboard</a>

    </div>
</div>

</body>
</html>
