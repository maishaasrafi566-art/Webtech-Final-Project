<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employee') {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$message = "";

if (isset($_POST['punch_in'])) {
    $work_type = $_POST['work_type'];

    $check = mysqli_query($conn, "
        SELECT id FROM attendance 
        WHERE user_id='$user_id' 
        AND DATE(punch_in)=CURDATE()
    ");

    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "
            INSERT INTO attendance (user_id, punch_in, work_type, status)
            VALUES ('$user_id', NOW(), '$work_type', 'Pending')
        ");
        $message = "✅ Punch In successful (Pending)";
    } else {
        $message = "⚠️ Already punched in today";
    }
}

if (isset($_POST['punch_out'])) {
    mysqli_query($conn, "
        UPDATE attendance 
        SET punch_out=NOW()
        WHERE user_id='$user_id'
        AND DATE(punch_in)=CURDATE()
        ORDER BY id DESC LIMIT 1
    ");
    $message = "✅ Punch Out successful";
}

$today = mysqli_query($conn, "
    SELECT * FROM attendance 
    WHERE user_id='$user_id' 
    AND DATE(punch_in)=CURDATE()
    ORDER BY id DESC LIMIT 1
");
$att = mysqli_fetch_assoc($today);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Attendance</title>
<link rel="stylesheet" href="../assets/css/attendance.css">
</head>
<body>

<div class="attendance-card">
    <h2>Daily Attendance</h2>

    <?php if ($message): ?>
        <div class="msg-box"><?= $message ?></div>
    <?php endif; ?>

    <p><strong>Date:</strong> <?= date("Y-m-d") ?></p>

    <p><strong>Current Time:</strong> <span id="clock"></span></p>

    <form method="POST">
        <label>Work Place</label>
        <select name="work_type" required>
            <option value="">Select Work Place</option>
            <option value="Head Office">Head Office</option>
            <option value="Client Visit">Client Visit</option>
            <option value="Work From Home">Work From Home</option>
            <option value="Branch Office">Branch Office</option>
        </select>

        <div class="button-group">
            <button type="submit" name="punch_in" class="btn punch-in">Punch In</button>
            <button type="submit" name="punch_out" class="btn punch-out">Punch Out</button>
        </div>
    </form>
</div>
