document.addEventListener("DOMContentLoaded", function () {
    "use strict";
    const searchFilter = document.getElementById("searchFilter");
    const departmentFilter = document.getElementById("departmentFilter");
    const serviceFilter = document.getElementById("serviceFilter");
    const dateFilter = document.getElementById("dateFilter");
    const rows = document.querySelectorAll(".contact-row");
    const totalCount = document.getElementById("totalMessageCount");

    /* FILTER CONTACTS   */
    window.ContactFilter = window.ContactFilter || {};

    window.ContactFilter.filterContacts = function () {
        const search = searchFilter
            ? searchFilter.value.toLowerCase().trim()
            : "";

        const department = departmentFilter
            ? departmentFilter.value.toLowerCase().trim()
            : "";

        const service = serviceFilter
            ? serviceFilter.value.toLowerCase().trim()
            : "";

        const date = dateFilter ? dateFilter.value : "";

        let visibleCount = 0;

        rows.forEach(function (row) {
            const rowSearch = (row.dataset.search || "").toLowerCase();
            const rowDepartment = (row.dataset.department || "").toLowerCase();
            const rowService = (row.dataset.service || "").toLowerCase();
            const rowDate = row.dataset.date || "";
            const matchSearch = rowSearch.includes(search);
            const matchDepartment =
                department === "" || rowDepartment.includes(department);
            const matchService = service === "" || rowService.includes(service);
            const matchDate = date === "" || rowDate === date;
            const isMatch =matchSearch && matchDepartment && matchService && matchDate;

            if (isMatch) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }
        });

        if (totalCount) {
            totalCount.innerText = visibleCount;
        }
    };
});
