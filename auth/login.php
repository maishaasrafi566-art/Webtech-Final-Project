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
</head>
<body>

    <h2>HRM Login</h2>
    <p>Please login to continue</p>

    <form method="POST">
        <p>
            <input type="email" name="email" placeholder="Email address" required>
        </p>

        <p>
            <input type="password" name="password" placeholder="Password" required>
        </p>

        <p>
            <button type="submit">Login</button>
        </p>
    </form>

    <p>
        <a href="forgot_password.php">Forgot Password?</a>
    </p>

    <p>
        <a href="register.php">Create New Account</a>
    </p>

</body>
</html>
