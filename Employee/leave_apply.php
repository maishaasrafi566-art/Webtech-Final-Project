<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apply Leave | HRM</title>
</head>
<body>

<div class="leave-page">
    <div class="leave-card">
        <h2>Apply Leave</h2>


        <form method="POST">
            
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

            <label>Emergency Address</label>
            <input type="text" name="ename" required>

            <label>Emergency Phone</label>
            <input type="text" name="ephone" required>

            <button type="submit" name="apply">Apply Leave</button>
        </form>
    </div>
</div>

</body>
</html>
