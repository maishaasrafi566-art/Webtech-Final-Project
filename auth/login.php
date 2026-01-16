<?php
include("../config/db.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email !== "" && $password !== "") {

        $stmt = mysqli_prepare($conn, "SELECT id, role, password FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) === 1) {

            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'admin') {
                    header("Location: ../admin/dashboard.php");
                } else {
                    header("Location: ../employee/dashboard.php");
                }
                exit;

            } else {
                $error = "Incorrect password";
            }
        } else {
            $error = "Email not found";
        }
    } else {
        $error = "All fields are required";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | HRM System</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>

<div class="login-wrapper">
    <div class="login-box">

        <h2 class="login-title">HRM Login</h2>
        <p class="login-subtitle">Please login to continue</p>

        <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" class="login-form">
            <input class="form-input" type="email" name="email" placeholder="Email address" required>
            <input class="form-input" type="password" name="password" placeholder="Password" required>

            <button class="login-btn" type="submit">Login</button>
        </form>

        <div class="login-links">
            <a href="forgot_password.php">Forgot Password?</a><br>
            <a href="register.php">Create New Account</a>
        </div>

    </div>
</div>

</body>
</html>
