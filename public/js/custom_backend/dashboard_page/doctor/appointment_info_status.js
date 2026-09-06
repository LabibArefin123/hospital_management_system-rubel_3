document.addEventListener("DOMContentLoaded", function () {
    const patientName = document.getElementById("statusPatientName");
    const patientAge = document.getElementById("statusPatientAge");
    const patientGender = document.getElementById("statusPatientGender");
    const currentStatusBadge = document.getElementById("currentStatusBadge");
    const newStatusBadge = document.getElementById("newStatusBadge");
    const statusChangeText = document.getElementById("statusChangeText");

    document.querySelectorAll(".appointment-status").forEach(function (select) {
        select.addEventListener("change", function () {
            const patient = this.dataset.patient || "this patient";
            const age = this.dataset.age || "N/A";
            const gender = this.dataset.gender || "N/A";
            const currentStatus = this.dataset.current || "pending";
            const newStatus = this.value;

            patientName.textContent = patient;
            patientAge.textContent = age;
            patientGender.textContent = gender;

            currentStatusBadge.textContent = formatStatus(currentStatus);
            newStatusBadge.textContent = formatStatus(newStatus);

            statusChangeText.textContent = `Do you want to set the status to "${formatStatus(newStatus)}" for ${patient}?`;

            updateStatusBadge(currentStatusBadge, currentStatus);
            updateStatusBadge(newStatusBadge, newStatus);
        });
    });

    function formatStatus(status) {
        return status.charAt(0).toUpperCase() + status.slice(1);
    }

    function updateStatusBadge(element, status) {
        element.classList.remove(
            "status-pending",
            "status-confirmed",
            "status-cancelled",
        );

        element.classList.add(`status-${status}`);
    }
});
