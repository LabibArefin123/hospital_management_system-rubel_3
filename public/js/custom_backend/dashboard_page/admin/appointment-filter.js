export function initAppointmentFilter() {
    const searchInput = document.getElementById("dashboardSearch");

    const patientInput = document.getElementById("searchPatient");

    const statusFilter = document.getElementById("appointmentStatusFilter");

    const typeFilter = document.getElementById("appointmentTypeFilter");

    const dateFilter = document.getElementById("appointmentDateFilter");

    const appointmentCards = document.querySelectorAll(".appointment-card");

    const appointmentRows = document.querySelectorAll(".appointment-row");

    const doctorCountElement = document.getElementById(
        "doctorAppointmentCount",
    );

    const serviceCountElement = document.getElementById(
        "serviceAppointmentCount",
    );

    function filterAppointments() {
        const search = searchInput?.value.toLowerCase().trim() || "";

        const patient = patientInput?.value.toLowerCase().trim() || "";

        const status = statusFilter?.value.toLowerCase() || "";

        const type = typeFilter?.value.toLowerCase() || "";

        const date = dateFilter?.value || "";

        let visibleDoctorCount = 0;

        let visibleServiceCount = 0;

        /*
        |--------------------------------------------------------------------------
        | FILTER CARDS
        |--------------------------------------------------------------------------
        */

        appointmentCards.forEach(function (card) {
            const cardSearch = (card.dataset.search || "").toLowerCase();

            const cardPatient = (card.dataset.patient || "").toLowerCase();

            const cardType = (card.dataset.type || "").toLowerCase();

            const cardStatus = (card.dataset.status || "").toLowerCase();

            const cardDate = card.dataset.date || "";

            const matchSearch = cardSearch.includes(search);

            const matchPatient = cardPatient.includes(patient);

            const matchStatus = status === "" || cardStatus === status;

            const matchType = type === "" || cardType === type;

            const matchDate = date === "" || cardDate === date;

            if (
                matchSearch &&
                matchPatient &&
                matchStatus &&
                matchType &&
                matchDate
            ) {
                card.style.display = "block";

                if (cardType === "doctor") {
                    visibleDoctorCount++;
                }

                if (cardType === "service") {
                    visibleServiceCount++;
                }
            } else {
                card.style.display = "none";
            }
        });

        /*
        |--------------------------------------------------------------------------
        | FILTER TABLE ROWS
        |--------------------------------------------------------------------------
        */

        appointmentRows.forEach(function (row) {
            const patientName = (row.dataset.patient || "").toLowerCase();

            const rowStatus = (row.dataset.status || "").toLowerCase();

            const rowType = (row.dataset.type || "").toLowerCase();

            const rowDate = row.dataset.date || "";

            const rowText = row.innerText.toLowerCase();

            const matchSearch = rowText.includes(search);

            const matchPatient = patientName.includes(patient);

            const matchStatus = status === "" || rowStatus === status;

            const matchType = type === "" || rowType === type;

            const matchDate = date === "" || rowDate === date;

            if (
                matchSearch &&
                matchPatient &&
                matchStatus &&
                matchType &&
                matchDate
            ) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });

        /*
        |--------------------------------------------------------------------------
        | UPDATE COUNTS
        |--------------------------------------------------------------------------
        */

        if (doctorCountElement) {
            doctorCountElement.innerText = `${visibleDoctorCount} Appointments`;
        }

        if (serviceCountElement) {
            serviceCountElement.innerText = `${visibleServiceCount} Bookings`;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | EVENTS
    |--------------------------------------------------------------------------
    */

    searchInput?.addEventListener("keyup", filterAppointments);

    patientInput?.addEventListener("keyup", filterAppointments);

    statusFilter?.addEventListener("change", filterAppointments);

    typeFilter?.addEventListener("change", filterAppointments);

    dateFilter?.addEventListener("change", filterAppointments);

    /*
    |--------------------------------------------------------------------------
    | RETURN FILTER FUNCTION
    |--------------------------------------------------------------------------
    */

    return filterAppointments;
}
