<?php
session_start();
include("../config/db.php");


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $old_pass = $_POST['old_password'] ?? '';
    $new_pass = $_POST['new_password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    if (!$old_pass || !$new_pass || !$confirm) {
        $error = "All fields are required";
    } elseif ($new_pass !== $confirm) {
        $error = "New passwords do not match";
    } else {

        
        $stmt = mysqli_prepare(
            $conn,
            "SELECT password FROM users WHERE id = ?"
        );
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if (!password_verify($old_pass, $row['password'])) {
                $error = "Old password is incorrect";
            } else {

                $hashed = password_hash($new_pass, PASSWORD_DEFAULT);

                $update = mysqli_prepare(
                    $conn,
                    "UPDATE users SET password = ? WHERE id = ?"
                );
                mysqli_stmt_bind_param($update, "si", $hashed, $user_id);

                if (mysqli_stmt_execute($update)) {
                    $success = "Password changed successfully";
                } else {
                    $error = "Password update failed";
                }
            }

        } else {
            $error = "User not found";
        }
    }
}
?>
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
