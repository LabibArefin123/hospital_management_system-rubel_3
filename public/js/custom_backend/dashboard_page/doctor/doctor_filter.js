/*  DOCTOR APPOINTMENT FILTER  */

document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    const toggleBtn = document.getElementById("toggleFilterBtn");
    const filterSection = document.getElementById("filterSection");
    const filterArrow = document.getElementById("filterArrow");
    const patientInput = document.getElementById("searchPatient");
    const dateInput = document.getElementById("searchDate");
    const resetBtn = document.getElementById("resetFilter");
    const countElement = document.getElementById("doctorAppointmentCount");

    /*  GET ONLY DOCTOR APPOINTMENT CARDS  */
    const rows = document.querySelectorAll(
        ".appointment-card[data-type='doctor']",
    );

    /*  STORE SERVER TOTAL  */
    let serverTotal = 0;

    if (countElement) {
        const text = countElement.textContent.trim();
        const match = text.match(/\d+/);

        if (match) {
            serverTotal = parseInt(match[0], 10);
        }
    }

    /*  TOGGLE FILTER SECTION  */

    if (toggleBtn && filterSection) {
        toggleBtn.addEventListener("click", function () {
            filterSection.classList.toggle("d-none");

            if (filterArrow) {
                if (filterSection.classList.contains("d-none")) {
                    filterArrow.classList.remove("fa-chevron-up");
                    filterArrow.classList.add("fa-chevron-down");
                } else {
                    filterArrow.classList.remove("fa-chevron-down");
                    filterArrow.classList.add("fa-chevron-up");
                }
            }
        });
    }

    /*  UPDATE APPOINTMENT COUNT  */

    function updateAppointmentCount(count) {
        if (!countElement) {
            return;
        }

        countElement.textContent =
            count + (count === 1 ? " Appointment" : " Appointments");
    }

    /*  CHECK WHETHER FILTER IS ACTIVE  */

    function isFilterActive() {
        const patientValue = patientInput?.value.trim() || "";
        const dateValue = dateInput?.value || "";

        return patientValue !== "" || dateValue !== "";
    }

    /*  FILTER APPOINTMENTS  */

    function filterAppointments() {
        const patientValue = patientInput?.value.toLowerCase().trim() || "";
        const dateValue = dateInput?.value || "";

        let visibleCount = 0;

        rows.forEach(function (row) {
            const patient = (row.dataset.patient || "").toLowerCase();
            const date = row.dataset.date || "";

            const matchPatient = patient.includes(patientValue);
            const matchDate = dateValue === "" || date === dateValue;

            const visible = matchPatient && matchDate;

            if (visible) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }
        });

        /*  ONLY CHANGE COUNT WHEN FILTER IS ACTIVE  */

        if (isFilterActive()) {
            updateAppointmentCount(visibleCount);
        } else {
            updateAppointmentCount(serverTotal);
        }
    }

    /*  PATIENT SEARCH  */

    if (patientInput) {
        patientInput.addEventListener("input", function () {
            filterAppointments();
        });
    }

    /*  DATE SEARCH  */

    if (dateInput) {
        dateInput.addEventListener("change", function () {
            filterAppointments();
        });
    }

    /*  RESET FILTER  */

    if (resetBtn) {
        resetBtn.addEventListener("click", function () {
            if (patientInput) {
                patientInput.value = "";
            }

            if (dateInput) {
                dateInput.value = "";
            }

            /*  RESTORE ALL CURRENT PAGE APPOINTMENTS  */

            rows.forEach(function (row) {
                row.style.display = "";
            });

            /*  RESTORE SERVER TOTAL  */

            updateAppointmentCount(serverTotal);
        });
    }

    /*  INITIAL LOAD - DO NOT RECALCULATE SERVER TOTAL  */

    rows.forEach(function (row) {
        row.style.display = "";
    });

    updateAppointmentCount(serverTotal);
});
