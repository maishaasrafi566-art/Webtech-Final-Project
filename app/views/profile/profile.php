<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile | HRM</title>
    <link rel="stylesheet" href="/WebTech Final Project/assets/css/profile.css">
</head>
<body>
<header class="dashboard-header">
    <div class="logo">ABC Solutions Limited</div>
</header>

<main class="dashboard-container">
    <div class="profile-card">
        <h2>My Profile</h2>

        <?php if($success_msg): ?>
            <p class="success-msg"><?= $success_msg ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['NAME']) ?>" required>

            <label for="email">Email</label>
            <input type="email" value="<?= htmlspecialchars($user['email']) ?>" readonly>

            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($user['phone']) ?>">

            <button type="submit">Update Profile</button>
        </form>
    </div>
</main>
</body>
</html>
