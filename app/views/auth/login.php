<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | HRM System</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/hrm_project/assets/css/login.css">
</head>
<body>

<div class="login-wrapper">
    <div class="login-box">

        <h2 class="login-title">HRM Login</h2>
        <p class="login-subtitle">Please login to continue</p>

        <?php if (!empty($error)): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" class="login-form">
            <input class="form-input" type="email" name="email" placeholder="Email address" required>
            <input class="form-input" type="password" name="password" placeholder="Password" required>

            <button class="login-btn" type="submit">Login</button>
        </form>

        <div class="login-links">
            <a href="/hrm_project/auth/forgot_password.php">Forgot Password?</a><br>
            <a href="/hrm_project/auth/register.php">Create New Account</a>
        </div>

    </div>
</div>

</body>
</html>
