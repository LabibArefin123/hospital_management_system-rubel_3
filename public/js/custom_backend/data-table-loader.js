$(document).ready(function () {
    "use strict";

    const table = $("#dataTables");

    if (!table.length) {
        return;
    }

    if ($.fn.DataTable.isDataTable("#dataTables")) {
        return;
    }

    table.DataTable({
        responsive: true,

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],

        language: {
            lengthMenu: "Show _MENU_ entries",
            search: "Search:",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "Showing 0 to 0 of 0 entries",
            emptyTable: "No data available",
        },
    });
});
