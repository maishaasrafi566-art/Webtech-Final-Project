<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password | HRM System</title>
    <link rel="stylesheet" href="/WebTech Final Project/assets/css/forgot.css">
</head>
<body>

<div class="forgot-wrapper">
    <div class="forgot-box">

        <h2 class="forgot-title">Forgot Password</h2>
        <p class="forgot-subtitle">Reset your account password</p>

        <?php if (!empty($error)): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="success-msg">
                <?php echo $success; ?><br>
                <a href="/WebTech Final Project/public/index.php?url=login">Go to Login</a>
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
            <a href="/WebTech Final Project//public/index.php?url=login">Back to Login</a>
        </div>

    </div>
</div>

</body>
</html>
