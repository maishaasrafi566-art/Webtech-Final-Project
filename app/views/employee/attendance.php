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

    <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
        <div class="msg-box" style="display:block;"><?= $_SESSION['message'] ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <p><strong>Date:</strong> <span id="today-date"></span></p>
    <p><strong>Current Time:</strong> <span id="current-time"></span></p>

    <form id="attendanceForm" method="POST">
        <input type="hidden" name="action" id="action" value="">
        
        <label>Work Place</label>
        <select name="work_type" id="work_type" required>
            <option value="">Select Work Place</option>
            <option value="Head Office">Head Office</option>
            <option value="Client Visit">Client Visit</option>
            <option value="Work From Home">Work From Home</option>
            <option value="Branch Office">Branch Office</option>
        </select>

        <div class="button-group">
            <button type="button" onclick="submitAttendance('punch_in')" class="btn punch-in">Punch In</button>
            <button type="button" onclick="submitAttendance('punch_out')" class="btn punch-out">Punch Out</button>
        </div>
    </form>

    <div id="attendance-msg" class="msg-box" style="display:none;"></div>
</div>

<script>
function submitAttendance(action) {
    const workType = document.getElementById('work_type').value;
    
    if (action === 'punch_in' && !workType) {
        showMessage("Please select work type", "red", "attendance-msg");
        return;
    }
    
    const formData = new FormData();
    formData.append('action', action);
    if (workType) formData.append('work_type', workType);
    
    fetch("/WebTech Final Project/public/index.php?url=attendance", {
        method: "POST",
        body: formData,
        headers: {'X-Requested-With': 'XMLHttpRequest'}
    })
    .then(res => res.json())
    .then(data => {
        showMessage(data.message || "Done", data.success ? "green" : "red", "attendance-msg");
        
        
        if (action === 'punch_in' && data.success) {
            document.getElementById('work_type').value = '';
        }
    })
    .catch(err => {
        console.error(err);
        showMessage("Network error occurred", "red", "attendance-msg");
    });
}

function showMessage(msg, color, targetId) {
    const msgBox = document.getElementById(targetId);
    if(!msgBox) return;
    
    msgBox.innerText = msg;
    msgBox.style.color = color;
    msgBox.style.display = "block";

    setTimeout(() => {
        msgBox.style.opacity = 0;
        setTimeout(() => {
            msgBox.style.display = "none";
            msgBox.style.opacity = 1;
        }, 500);
    }, 3000);
}


function updateDateTime(){
    const today = new Date();
    const dateEl = document.getElementById('today-date');
    const timeEl = document.getElementById('current-time');
    if(dateEl) dateEl.innerText = today.toLocaleDateString();
    if(timeEl) timeEl.innerText = today.toLocaleTimeString();
}


document.addEventListener("DOMContentLoaded", () => {
    setInterval(updateDateTime, 1000);
    updateDateTime();
});
</script>

</body>
</html>