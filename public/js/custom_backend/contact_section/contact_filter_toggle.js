document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    const toggleBtn = document.getElementById("toggleFilterBtn");
    const filterSection = document.getElementById("contactFilterSection");
    const filterArrow = document.getElementById("filterArrow");

    if (!toggleBtn || !filterSection || !filterArrow) {
        return;
    }

    toggleBtn.addEventListener("click", function () {
        const isHidden = filterSection.classList.toggle("d-none");

        if (isHidden) {
            filterArrow.classList.remove("fa-chevron-up");
            filterArrow.classList.add("fa-chevron-down");
        } else {
            filterArrow.classList.remove("fa-chevron-down");
            filterArrow.classList.add("fa-chevron-up");
        }
    });
});
