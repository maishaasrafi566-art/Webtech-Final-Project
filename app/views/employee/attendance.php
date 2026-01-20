<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Daily Attendance | HRM</title>
<link rel="stylesheet" href="/WebTech Final Project/assets/css/attendence.css">
<script src="/WebTech Final Project/assets/js/script.js"></script>
</head>
<body>

<div class="attendance-card">
    <h2>Daily Attendance</h2>

    <p><strong>Date:</strong> <span id="today-date"></span></p>
    <p><strong>Current Time:</strong> <span id="current-time"></span></p>

    <form id="attendanceForm">
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

    <div id="attendance-msg" class="msg-box" style="display:none;"></div>
</div>

</body>
</html>
