document.addEventListener("DOMContentLoaded", function () {
    "use strict";
    const ContactFilter = window.ContactFilter;

    if (!ContactFilter) {
        console.error("[Contact Filter] ERROR: Core module not loaded.");
        return;
    }

    const searchFilter = document.getElementById("searchFilter");
    const departmentFilter = document.getElementById("departmentFilter");
    const serviceFilter = document.getElementById("serviceFilter");
    const dateFilter = document.getElementById("dateFilter");
    const resetBtn = document.getElementById("resetFilterBtn");

    /* SEARCH FILTER */
    if (searchFilter) {
        searchFilter.addEventListener("input", ContactFilter.filterContacts);
    }

    /* DEPARTMENT FILTER */
    if (departmentFilter) {
        departmentFilter.addEventListener(
            "input",
            ContactFilter.filterContacts,
        );
    }

    /*SERVICE FILTER */
    if (serviceFilter) {
        serviceFilter.addEventListener("input", ContactFilter.filterContacts);
    }

    /*DATE FILTER */
    if (dateFilter) {
        dateFilter.addEventListener("change", ContactFilter.filterContacts);
    }

    /* RESET FILTER*/
    if (resetBtn) {
        resetBtn.addEventListener("click", function () {
            if (searchFilter) {
                searchFilter.value = "";
            }

            if (departmentFilter) {
                departmentFilter.value = "";
            }

            if (serviceFilter) {
                serviceFilter.value = "";
            }

            if (dateFilter) {
                dateFilter.value = "";
            }

            ContactFilter.filterContacts();
        });
    }
});
