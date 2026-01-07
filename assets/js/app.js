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
