<?php 
include("config/db.php");

/* LOGIN CHECK */
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$success_msg = "";

/* Handle profile update */
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    
    mysqli_query($conn,"UPDATE users SET name='$name', phone='$phone' WHERE id='$user_id'");
    $success_msg = "Profile updated successfully!";
}

/* Fetch user data */
$res = mysqli_query($conn,"SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile | HRM</title>
    <link rel="stylesheet" href="assets/css/profile.css">
</head>
<body>

<header class="dashboard-header">
    <div class="logo">ABC Solutions Limited</div>
    <div class="profile-menu">
        <span class="user-name"><?= htmlspecialchars($user['NAME'] ?? $user['name']) ?></span>
        <div class="dropdown">
            <a href="profile.php">Profile</a>
            <a href="auth/change_password.php">Change Password</a>
            <a href="auth/logout.php" class="logout">Logout</a>
        </div>
    </div>
</header>

<main class="dashboard-container">
    <div class="profile-card">
        <h2>My Profile</h2>

        <?php if($success_msg): ?>
            <p class="success-msg"><?= $success_msg ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['NAME'] ?? $user['name']) ?>" required>

            <label for="email">Email</label>
            <input type="email" value="<?= htmlspecialchars($user['EMAIL'] ?? $user['email']) ?>" readonly>

            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($user['PHONE'] ?? $user['phone']) ?>">

            <button type="submit" name="update">Update Profile</button>
        </form>
    </div>
</main>

</body>
</html>
