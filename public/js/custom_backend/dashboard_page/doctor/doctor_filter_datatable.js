/* =========================================================
   DOCTOR DASHBOARD FILTER - DATATABLE INFO
========================================================= */
document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    function updateDataTableInfo() {
        const dataTable = DoctorFilter.dataTable;

        if (!dataTable) {
            return;
        }

        const rows = dataTable.querySelectorAll("tbody tr.appointment-row");
        const visibleRows = Array.from(rows).filter(function (row) {
            return row.style.display !== "none";
        });

        const infoElement = dataTable
            .closest(".dataTables_wrapper")
            ?.querySelector(".dataTables_info");

        if (!infoElement) {
            return;
        }

        const total = visibleRows.length;

        if (total === 0) {
            infoElement.textContent = "Showing 0 to 0 of 0 entries";
        } else {
            infoElement.textContent = `Showing 1 to ${total} of ${total} entries`;
        }
    }

    /* AFTER FILTER */
    document.addEventListener("latestAppointmentsFiltered", function () {
        updateDataTableInfo();
    });

    /* INITIAL */
    updateDataTableInfo();
    /* EXPOSE FOR RESET */
    DoctorFilter.updateDataTableInfo = updateDataTableInfo;
});
