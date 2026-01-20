<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Apply Leave | HRM</title>
<link rel="stylesheet" href="/hrm_project/assets/css/leave.css">
<script src="/hrm_project/assets/js/script.js"></script>
</head>
<body>

<div class="leave-page">
    <div class="leave-card">
        <h2>Apply Leave</h2>

        <form id="leaveForm">
            <label>Leave Type</label>
            <select name="type" required>
                <option>Casual</option>
                <option>Sick</option>
            </select>

            <label>Day Type</label>
            <select name="day" required>
                <option>Full Day</option>
                <option>Half Day</option>
            </select>

            <label>From Date</label>
            <input type="date" name="from" required>

            <label>To Date</label>
            <input type="date" name="to" required>

            <label>Reason</label>
            <textarea name="reason" required></textarea>

            <label>Emergency Name</label>
            <input type="text" name="ename" required>

            <label>Emergency Phone</label>
            <input type="text" name="ephone" required>

            <button type="submit">Apply Leave</button>
        </form>

        <div id="leave-msg" class="success-msg" style="display:none;"></div>
    </div>
</div>

</body>
</html>
