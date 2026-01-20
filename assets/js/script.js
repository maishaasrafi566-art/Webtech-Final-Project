document.querySelectorAll(".btn-approve, .btn-reject").forEach(btn => {
    btn.addEventListener("click", e => {
        e.preventDefault();
        const url = btn.href;

        fetch(url, { headers: {'X-Requested-With':'XMLHttpRequest'} })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                btn.closest("td").innerText = "Reviewed";
            } else alert("Error updating status");
        });
    });
});





function showMessage(msg, color="green", targetId=null) {
    const msgBox = targetId ? document.getElementById(targetId) : document.createElement('div');
    if(!targetId){
        msgBox.classList.add('msg-box');
        document.body.prepend(msgBox);
    }
    msgBox.innerText = msg;
    msgBox.style.color = color;
    msgBox.style.display = "block";

    setTimeout(() => {
        msgBox.style.opacity = 0;
        setTimeout(() => { msgBox.style.display="none"; msgBox.style.opacity=1; }, 500);
    }, 3000);
}


function validateLeaveForm() {
    let from = document.querySelector("input[name='from']").value;
    let to = document.querySelector("input[name='to']").value;

    if(from > to){
        alert("From date cannot be greater than To date");
        return false;
    }
    return true;
}


document.addEventListener("DOMContentLoaded", () => {
  
    const leaveForm = document.getElementById("leaveForm");
    if(leaveForm){
        leaveForm.addEventListener("submit", function(e){
            e.preventDefault();
            if(!validateLeaveForm()) return;

            const formData = new FormData(this);
            fetch("/hrm_project/public/index.php?url=leave-apply", {
                method: "POST",
                body: formData,
                headers: {'X-Requested-With':'XMLHttpRequest'}
            })
            .then(res=>res.json())
            .then(data=>{
                if(data.success){
                    showMessage("Leave Applied Successfully!", "green", "leave-msg");
                    leaveForm.reset();
                } else {
                    showMessage(data.error || "Error!", "red", "leave-msg");
                }
            }).catch(err=>console.error(err));
        });
    }


    const attendanceForm = document.getElementById("attendanceForm");
    if(attendanceForm){
        attendanceForm.addEventListener("submit", function(e){
            e.preventDefault();
            const formData = new FormData(this);
            fetch("/hrm_project/public/index.php?url=attendance", {
                method: "POST",
                body: formData,
                headers: {'X-Requested-With':'XMLHttpRequest'}
            })
            .then(res=>res.json())
            .then(data=>{
                showMessage(data.message || "Done", data.success ? "green" : "red", "attendance-msg");
            }).catch(err=>console.error(err));
        });
    }

    function updateDateTime(){
        const today = new Date();
        const dateEl = document.getElementById('today-date');
        const timeEl = document.getElementById('current-time');
        if(dateEl) dateEl.innerText = today.toLocaleDateString();
        if(timeEl) timeEl.innerText = today.toLocaleTimeString();
    }
    setInterval(updateDateTime, 1000);
    updateDateTime();
});
