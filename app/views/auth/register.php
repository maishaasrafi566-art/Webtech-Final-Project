<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | HRM System</title>
    <link rel="stylesheet" href="/hrm_project/assets/css/register.css">
</head>
<body>

<div class="register-wrapper">
    <div class="register-box">

        <h2 class="register-title">Employee Registration</h2>
        <p class="register-subtitle">Create a new HRM account</p>

        <?php if (!empty($error)): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="success-msg">
                <?php echo $success; ?><br>
                <a href="/hrm_project/public/index.php?url=login">Login Now</a>
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
            <a href="/hrm_project/public/index.php?url=login">
                Already have an account? Login
            </a>
        </div>

    </div>
</div>

</body>
</html>
