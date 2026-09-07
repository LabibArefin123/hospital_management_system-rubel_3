/* =========================================================
   DOCTOR DASHBOARD FILTER - APPOINTMENTS
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    function filterDoctorAppointments(filters) {
        const doctorAppointments = DoctorFilter.doctorAppointments;
        let visibleCount = 0;

        doctorAppointments.forEach(function (card) {
            const visible = DoctorFilter.matches(card, filters);
            card.style.display = visible ? "" : "none";

            if (visible) {
                visibleCount++;
            }
        });

        updateDoctorAppointmentCount(visibleCount);
    }

    function filterLatestAppointments(filters) {
        const latestAppointments = DoctorFilter.latestAppointments;
        latestAppointments.forEach(function (row) {
            const visible = DoctorFilter.matches(row, filters);
            row.style.display = visible ? "" : "none";
        });

        document.dispatchEvent(new CustomEvent("latestAppointmentsFiltered"));
    }

    function updateDoctorAppointmentCount(count) {
        const countElement = DoctorFilter.countElement;
        if (!countElement) {
            return;
        }

        if (!DoctorFilter.isActive()) {
            count = DoctorFilter.serverTotal;
        }

        countElement.innerHTML = `
            <i class="fas fa-calendar-check"></i>
            <span>
                ${count}
                ${count === 1 ? "Appointment" : "Appointments"}
            </span>
        `;
    }

    /* LISTEN FOR FILTER CHANGES */
    document.addEventListener("doctorFilterChanged", function (event) {
        const filters = event.detail;
        filterDoctorAppointments(filters);
        filterLatestAppointments(filters);
    });
});
