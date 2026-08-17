export function initFilterToggle() {
    const toggleFilterBtn = document.getElementById("toggleFilterBtn");

    const adminFilterSection = document.getElementById("adminFilterSection");

    const filterArrow = document.getElementById("filterArrow");

    if (toggleFilterBtn && adminFilterSection) {
        toggleFilterBtn.addEventListener("click", function () {
            adminFilterSection.classList.toggle("d-none");

            if (adminFilterSection.classList.contains("d-none")) {
                filterArrow.classList.remove("fa-chevron-up");

                filterArrow.classList.add("fa-chevron-down");
            } else {
                filterArrow.classList.remove("fa-chevron-down");

                filterArrow.classList.add("fa-chevron-up");
            }
        });
    }
}
