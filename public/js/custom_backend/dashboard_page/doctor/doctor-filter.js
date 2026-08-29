/**  DOCTOR APPOINTMENT FILTER */
document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    const toggleBtn = document.getElementById("toggleFilterBtn");
    const filterSection = document.getElementById("filterSection");
    const filterArrow = document.getElementById("filterArrow");

    const patientInput = document.getElementById("searchPatient");
    const dateInput = document.getElementById("searchDate");
    const resetBtn = document.getElementById("resetFilter");

    const countElement = document.getElementById("doctorAppointmentCount");

    const rows = document.querySelectorAll(
        ".appointment-row, .appointment-card",
    );

    /*
    |--------------------------------------------------------------------------
    | TOGGLE FILTER SECTION
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | UPDATE APPOINTMENT COUNT
    |--------------------------------------------------------------------------
    */

    function updateAppointmentCount(count) {
        if (!countElement) {
            return;
        }

        countElement.textContent =
            count + (count === 1 ? " Appointment" : " Appointments");
    }

    /*
    |--------------------------------------------------------------------------
    | FILTER APPOINTMENTS
    |--------------------------------------------------------------------------
    */

    function filterAppointments() {
        const patientValue = patientInput
            ? patientInput.value.toLowerCase().trim()
            : "";

        const dateValue = dateInput ? dateInput.value : "";

        let visibleCount = 0;

        rows.forEach(function (row) {
            /*
            |--------------------------------------------------------------------------
            | TABLE ROW
            |--------------------------------------------------------------------------
            */

            if (row.classList.contains("appointment-row")) {
                const patient = (
                    row.getAttribute("data-patient") || ""
                ).toLowerCase();

                const date = row.getAttribute("data-date") || "";

                const matchPatient = patient.includes(patientValue);

                const matchDate = dateValue === "" || date === dateValue;

                if (matchPatient && matchDate) {
                    row.style.display = "";
                    visibleCount++;
                } else {
                    row.style.display = "none";
                }

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | APPOINTMENT CARD
            |--------------------------------------------------------------------------
            */

            if (row.classList.contains("appointment-card")) {
                const searchData = (
                    row.getAttribute("data-search") || ""
                ).toLowerCase();

                const dateData = row.getAttribute("data-date") || "";

                const matchPatient = searchData.includes(patientValue);

                const matchDate = dateValue === "" || dateData === dateValue;

                if (matchPatient && matchDate) {
                    row.style.display = "";
                    visibleCount++;
                } else {
                    row.style.display = "none";
                }
            }
        });

        /*
        |--------------------------------------------------------------------------
        | UPDATE COUNT
        |--------------------------------------------------------------------------
        */

        updateAppointmentCount(visibleCount);
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH EVENTS
    |--------------------------------------------------------------------------
    */

    if (patientInput) {
        patientInput.addEventListener("input", filterAppointments);
    }

    if (dateInput) {
        dateInput.addEventListener("change", filterAppointments);
    }

    /*
    |--------------------------------------------------------------------------
    | RESET FILTER
    |--------------------------------------------------------------------------
    */

    if (resetBtn) {
        resetBtn.addEventListener("click", function () {
            if (patientInput) {
                patientInput.value = "";
            }

            if (dateInput) {
                dateInput.value = "";
            }

            filterAppointments();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | INITIAL LOAD
    |--------------------------------------------------------------------------
    */

    filterAppointments();
});
