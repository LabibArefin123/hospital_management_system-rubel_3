/* =========================================================
   DOCTOR DASHBOARD FILTER - RESET
========================================================= */
document.addEventListener("DOMContentLoaded", function () {
    "use strict";
    const resetBtn = DoctorFilter.resetBtn;

    if (!resetBtn) {
        return;
    }

    resetBtn.addEventListener("click", function () {
        /* RESET INPUTS */
        if (DoctorFilter.patientInput) {
            DoctorFilter.patientInput.value = "";
        }

        if (DoctorFilter.dateInput) {
            DoctorFilter.dateInput.value = "";
        }

        if (DoctorFilter.statusInput) {
            DoctorFilter.statusInput.value = "";
        }

        /* RESTORE DOCTOR APPOINTMENTS */
        DoctorFilter.doctorAppointments.forEach(function (card) {
            card.style.display = "";
        });

        /* RESTORE LATEST APPOINTMENTS */
        DoctorFilter.latestAppointments.forEach(function (row) {
            row.style.display = "";
        });

        /* RESTORE COUNT */
        if (DoctorFilter.countElement) {
            DoctorFilter.countElement.innerHTML = `
                <i class="fas fa-calendar-check"></i>
                <span>
                    ${DoctorFilter.serverTotal}
                    ${
                        DoctorFilter.serverTotal === 1
                            ? "Appointment"
                            : "Appointments"
                    }
                </span>
            `;
        }

        /* RESTORE DATATABLE INFO */
        if (DoctorFilter.updateDataTableInfo) {
            DoctorFilter.updateDataTableInfo();
        }
    });
});
