function validateLeaveForm() {
    let from = document.querySelector("input[name='from']").value;
    let to = document.querySelector("input[name='to']").value;

    if (from > to) {
        alert("From date cannot be greater than To date");
        return false;
    }
    return true;
}


function showAttendanceMessage(message) {
    const msgBox = document.createElement('div');
    msgBox.classList.add('msg-box');
    msgBox.innerText = message;
    document.body.prepend(msgBox);

    setTimeout(() => {
        msgBox.style.opacity = 0;
        setTimeout(() => msgBox.remove(), 500);
    }, 3000);
}


function updateDateTime() {
    const today = new Date();
    const dateEl = document.getElementById('today-date');
    const timeEl = document.getElementById('current-time');
    if(dateEl) dateEl.innerText = today.toLocaleDateString();
    if(timeEl) timeEl.innerText = today.toLocaleTimeString();
}
setInterval(updateDateTime, 1000);
updateDateTime();
