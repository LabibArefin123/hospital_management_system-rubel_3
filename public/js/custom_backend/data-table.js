/* =========================================================
   DATATABLE
========================================================= */

$(document).ready(function () {
    if ($("#datatables").length) {
        $("#datatables").DataTable({
            responsive: true,
            autoWidth: false,
            ordering: true,
            searching: true,
            paging: true,
            info: true,
            lengthChange: true,
            pageLength: 10,
        });
    }
});
