<?php
include("../config/db.php");

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $gender  = $_POST['gender'] ?? '';
    $dob     = $_POST['dob'] ?? '';
    $role    = $_POST['role'] ?? 'employee';
    $pass    = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (!$name || !$email || !$pass || !$confirm) {
        $error = "All required fields must be filled";
    } elseif ($pass !== $confirm) {
        $error = "Passwords do not match";
    } else {

        // Check if email exists
        $check = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($check, "s", $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {
            $error = "Email already registered";
        } else {

            $hashed = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO users 
                (name, email, phone, address, gender, dob, role, password)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
            );

            mysqli_stmt_bind_param(
                $stmt,
                "ssssssss",
                $name, $email, $phone, $address, $gender, $dob, $role, $hashed
            );

            if (mysqli_stmt_execute($stmt)) {
                $success = "Registration successful! You can login now.";
            } else {
                $error = "Registration failed. Try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | HRM System</title>
    <link rel="stylesheet" href="../assets/css/register.css">
</head>
<body>

<div class="register-wrapper">
    <div class="register-box">

        <h2 class="register-title">Employee Registration</h2>
        <p class="register-subtitle">Create a new HRM account</p>

        <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-msg">
                <?php echo $success; ?><br>
                <a href="login.php">Login Now</a>
            </div>
        <?php endif; ?>

        <form method="POST" class="register-form">

            <input class="form-input" type="text" name="name" placeholder="Full Name" required>

            <input class="form-input" type="email" name="email" placeholder="Email Address" required>

            <input class="form-input" type="text" name="phone" placeholder="Phone Number">

            <textarea class="form-textarea" name="address" placeholder="Address"></textarea>

            <select class="form-input" name="gender" required>
                <option value="">Select Gender</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>

            <input class="form-input" type="date" name="dob" required>

            <select class="form-input" name="role" required>
                <option value="employee">Employee</option>
                <option value="admin">Admin</option>
            </select>

            <input class="form-input" type="password" name="password" placeholder="Password" required>

            <input class="form-input" type="password" name="confirm_password" placeholder="Confirm Password" required>

            <button class="register-btn" type="submit">Register</button>
        </form>

        <div class="register-links">
            <a href="login.php">Already have an account? Login</a>
        </div>

    </div>
</div>

</body>
</html>

