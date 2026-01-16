<?php
include("../config/db.php");

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email    = trim($_POST['email'] ?? '');
    $pass     = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    if (!$email || !$pass || !$confirm) {
        $error = "All fields are required";
    } elseif ($pass !== $confirm) {
        $error = "Passwords do not match";
    } else {

        // Check email exists
        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) === 1) {

            $hashed = password_hash($pass, PASSWORD_DEFAULT);

            $update = mysqli_prepare(
                $conn,
                "UPDATE users SET password = ? WHERE email = ?"
            );
            mysqli_stmt_bind_param($update, "ss", $hashed, $email);

            if (mysqli_stmt_execute($update)) {
                $success = "Password reset successful. You can login now.";
            } else {
                $error = "Something went wrong. Try again.";
            }

        } else {
            $error = "Email not found";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password | HRM System</title>
    <link rel="stylesheet" href="../assets/css/forgot.css">
</head>
<body>

<div class="forgot-wrapper">
    <div class="forgot-box">

        <h2 class="forgot-title">Forgot Password</h2>
        <p class="forgot-subtitle">Reset your account password</p>

        <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-msg">
                <?php echo $success; ?><br>
                <a href="login.php">Go to Login</a>
            </div>
        <?php endif; ?>

        <form method="POST" class="forgot-form">

            <input class="form-input" type="email" name="email"
                   placeholder="Registered Email" required>

            <input class="form-input" type="password" name="password"
                   placeholder="New Password" required>

            <input class="form-input" type="password" name="confirm_password"
                   placeholder="Confirm New Password" required>

            <button class="forgot-btn" type="submit">Reset Password</button>
        </form>

        <div class="forgot-links">
            <a href="login.php">Back to Login</a>
        </div>

    </div>
</div>

</body>
</html>
