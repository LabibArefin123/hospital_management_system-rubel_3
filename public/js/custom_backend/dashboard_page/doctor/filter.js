document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("toggleFilterBtn");
    const filterSection = document.getElementById("filterSection");
    const filterArrow = document.getElementById("filterArrow");

    const patientInput = document.getElementById("searchPatient");
    const dateInput = document.getElementById("searchDate");
    const resetBtn = document.getElementById("resetFilter");
    const rows = document.querySelectorAll(
        ".appointment-row, .appointment-card",
    );

    /*
    |--------------------------------------------------------------------------
    | TOGGLE FILTER SECTION
    |--------------------------------------------------------------------------
    */

    toggleBtn.addEventListener("click", function () {
        filterSection.classList.toggle("d-none");

        /*
        |--------------------------------------------------------------------------
        | ARROW CHANGE
        |--------------------------------------------------------------------------
        */

        if (filterSection.classList.contains("d-none")) {
            filterArrow.classList.remove("fa-chevron-up");
            filterArrow.classList.add("fa-chevron-down");
        } else {
            filterArrow.classList.remove("fa-chevron-down");
            filterArrow.classList.add("fa-chevron-up");
        }
    });

    /*
    |--------------------------------------------------------------------------
    | LIVE FILTER FUNCTION
    |--------------------------------------------------------------------------
    */

    function filterAppointments() {
        const patientValue = patientInput.value.toLowerCase();
        const dateValue = dateInput.value;

        rows.forEach(function (row) {
            /*
        |--------------------------------------------------------------------------
        | TABLE ROW FILTER
        |--------------------------------------------------------------------------
        */

            if (row.classList.contains("appointment-row")) {
                const patient = row.getAttribute("data-patient");
                const date = row.getAttribute("data-date");

                const matchPatient = patient.includes(patientValue);
                const matchDate = dateValue === "" || date === dateValue;

                if (matchPatient && matchDate) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }

            /*
        |--------------------------------------------------------------------------
        | CARD FILTER
        |--------------------------------------------------------------------------
        */

            if (row.classList.contains("appointment-card")) {
                const searchData = row.getAttribute("data-search");
                const dateData = row.getAttribute("data-date");

                const matchPatient = searchData.includes(patientValue);
                const matchDate = !dateValue || dateData === dateValue;

                if (matchPatient && matchDate) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | LIVE SEARCH EVENTS
    |--------------------------------------------------------------------------
    */

    patientInput.addEventListener("keyup", filterAppointments);

    dateInput.addEventListener("change", filterAppointments);

    /*
    |--------------------------------------------------------------------------
    | RESET FILTER
    |--------------------------------------------------------------------------
    */

    resetBtn.addEventListener("click", function () {
        patientInput.value = "";
        dateInput.value = "";

        filterAppointments();
    });
});
