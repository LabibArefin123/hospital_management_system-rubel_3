/* =========================================================
   DOCTOR DASHBOARD FILTER - TOGGLE
========================================================= */
document.addEventListener("DOMContentLoaded", function () {
    "use strict";
    const toggleBtn = document.getElementById("toggleFilterBtn");
    const filterSection = document.getElementById("filterSection");
    const filterArrow = document.getElementById("filterArrow");

    if (!toggleBtn || !filterSection) {
        return;
    }

    toggleBtn.addEventListener("click", function () {
        filterSection.classList.toggle("d-none");

        if (!filterArrow) {
            return;
        }


        if (filterSection.classList.contains("d-none")) {
            filterArrow.classList.remove("fa-chevron-up");
            filterArrow.classList.add("fa-chevron-down");

        } else {
            filterArrow.classList.remove("fa-chevron-down");
            filterArrow.classList.add("fa-chevron-up");
        }
    });
});

