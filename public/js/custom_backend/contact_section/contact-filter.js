document.addEventListener("DOMContentLoaded", function () {
    /*
    |--------------------------------------------------------------------------
    | TOGGLE FILTER SECTION
    |--------------------------------------------------------------------------
    */

    const toggleBtn = document.getElementById("toggleFilterBtn");

    const filterSection = document.getElementById("contactFilterSection");

    const filterArrow = document.getElementById("filterArrow");

    if (toggleBtn && filterSection) {
        toggleBtn.addEventListener("click", function () {
            filterSection.classList.toggle("d-none");

            if (filterSection.classList.contains("d-none")) {
                filterArrow.classList.remove("fa-chevron-up");

                filterArrow.classList.add("fa-chevron-down");
            } else {
                filterArrow.classList.remove("fa-chevron-down");

                filterArrow.classList.add("fa-chevron-up");
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | FILTER ELEMENTS
    |--------------------------------------------------------------------------
    */

    const searchFilter = document.getElementById("searchFilter");

    const departmentFilter = document.getElementById("departmentFilter");

    const serviceFilter = document.getElementById("serviceFilter");

    const dateFilter = document.getElementById("dateFilter");

    const rows = document.querySelectorAll(".contact-row");

    const totalCount = document.getElementById("totalMessageCount");

    /*
    |--------------------------------------------------------------------------
    | FILTER FUNCTION
    |--------------------------------------------------------------------------
    */

    function filterContacts() {
        const search = searchFilter.value.toLowerCase().trim();

        const department = departmentFilter.value.toLowerCase().trim();

        const service = serviceFilter.value.toLowerCase().trim();

        const date = dateFilter.value;

        let visibleCount = 0;

        rows.forEach(function (row) {
            const rowSearch = row.dataset.search || "";

            const rowDepartment = row.dataset.department || "";

            const rowService = row.dataset.service || "";

            const rowDate = row.dataset.date || "";

            const matchSearch = rowSearch.includes(search);

            const matchDepartment =
                department === "" || rowDepartment.includes(department);

            const matchService = service === "" || rowService.includes(service);

            const matchDate = date === "" || rowDate === date;

            if (matchSearch && matchDepartment && matchService && matchDate) {
                row.style.display = "";

                visibleCount++;
            } else {
                row.style.display = "none";
            }
        });

        if (totalCount) {
            totalCount.innerText = visibleCount;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | FILTER EVENTS
    |--------------------------------------------------------------------------
    */

    if (searchFilter) {
        searchFilter.addEventListener("keyup", filterContacts);
    }

    if (departmentFilter) {
        departmentFilter.addEventListener("keyup", filterContacts);
    }

    if (serviceFilter) {
        serviceFilter.addEventListener("keyup", filterContacts);
    }

    if (dateFilter) {
        dateFilter.addEventListener("change", filterContacts);
    }

    /*
    |--------------------------------------------------------------------------
    | RESET FILTER
    |--------------------------------------------------------------------------
    */

    const resetBtn = document.getElementById("resetFilterBtn");

    if (resetBtn) {
        resetBtn.addEventListener("click", function () {
            searchFilter.value = "";

            departmentFilter.value = "";

            serviceFilter.value = "";

            dateFilter.value = "";

            filterContacts();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | INITIAL LOAD
    |--------------------------------------------------------------------------
    */

    filterContacts();
});
