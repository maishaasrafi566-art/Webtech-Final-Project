<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Registration</title>
</head>
<body>

    <h2>Employee Registration</h2>
    <p>Create a new HRM account</p>

    <form method="post" action="">

        <label>Full Name</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email Address</label><br>
        <input type="email" name="email" required><br><br>

        <label>Phone Number</label><br>
        <input type="text" name="phone"><br><br>

        <label>Address</label><br>
        <textarea name="address"></textarea><br><br>

        <label>Gender</label><br>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br><br>

        <label>Date of Birth</label><br>
        <input type="date" name="dob" required><br><br>

        <label>Role</label><br>
        <select name="role" required>
            <option value="employee">Employee</option>
            <option value="admin">Admin</option>
        </select><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>

        <label>Confirm Password</label><br>
        <input type="password" name="confirm_password" required><br><br>

        <button type="submit">Register</button>

    </form>

    <br>
    <a href="login.php">Already have an account? Login</a>

</body>
</html>
