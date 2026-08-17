export function initFilterReset(filterAppointments) {
    const resetButton = document.getElementById("resetDashboardFilter");

    const searchInput = document.getElementById("dashboardSearch");

    const patientInput = document.getElementById("searchPatient");

    const statusFilter = document.getElementById("appointmentStatusFilter");

    const typeFilter = document.getElementById("appointmentTypeFilter");

    const dateFilter = document.getElementById("appointmentDateFilter");

    if (resetButton) {
        resetButton.addEventListener("click", function () {
            if (searchInput) {
                searchInput.value = "";
            }

            if (patientInput) {
                patientInput.value = "";
            }

            if (statusFilter) {
                statusFilter.value = "";
            }

            if (typeFilter) {
                typeFilter.value = "";
            }

            if (dateFilter) {
                dateFilter.value = "";
            }

            filterAppointments();
        });
    }
}
