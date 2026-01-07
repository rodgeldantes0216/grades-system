document.addEventListener("DOMContentLoaded", loadOfflineGrades);

const form = document.getElementById("gradeForm");

if (form) {
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const student = document.getElementById("student").value;
        const subject = document.getElementById("subject").value;
        const grade = document.getElementById("grade").value;

        let grades = JSON.parse(localStorage.getItem("offline_grades")) || [];

        grades.push({
            student: student,
            subject: subject,
            grade: grade,
            synced: false
        });

        localStorage.setItem("offline_grades", JSON.stringify(grades));

        form.reset();
        loadOfflineGrades();
    });
}

function loadOfflineGrades() {
    const tbody = document.getElementById("offlineGrades");
    if (!tbody) return;

    tbody.innerHTML = "";

    let grades = JSON.parse(localStorage.getItem("offline_grades")) || [];

    grades.forEach(g => {
        let row = `
            <tr>
                <td>${g.student}</td>
                <td>${g.subject}</td>
                <td>${g.grade}</td>
            </tr>
        `;
        tbody.innerHTML += row;
    });
}

const syncBtn = document.getElementById("syncBtn");
const statusText = document.getElementById("syncStatus");

if (syncBtn) {
    syncBtn.addEventListener("click", syncGrades);
}

window.addEventListener("online", () => {
    syncGrades();
});

function syncGrades() {
    let grades = JSON.parse(localStorage.getItem("offline_grades")) || [];

    if (grades.length === 0) {
        statusText.innerText = "No grades to submit.";
        return;
    }

    fetch("../api/grades.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(grades)
    })
    .then(res => res.json())
    .then(data => {
        localStorage.removeItem("offline_grades");
        loadOfflineGrades();
        statusText.innerText = "Grades successfully submitted!";
    })
    .catch(() => {
        statusText.innerText = "Offline. Will sync when online.";
    });
}
