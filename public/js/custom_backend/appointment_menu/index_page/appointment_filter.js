document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const statusFilter = document.getElementById("statusFilter");
    const typeFilter = document.getElementById("typeFilter");
    const clearButton = document.getElementById("clearAppointmentFilters");
    const cards = document.querySelectorAll(".appointment-card");
    const sections = document.querySelectorAll(".appointment-section");
    function filterAppointments() {
        const search = searchInput.value.trim().toLowerCase();
        const status = statusFilter.value.toLowerCase();
        const type = typeFilter.value.toLowerCase();
        sections.forEach((section) => {
            let visibleCount = 0;
            const sectionType = section.dataset.sectionType;
            const sectionCards = section.querySelectorAll(".appointment-card");
            sectionCards.forEach((card) => {
                const cardSearch = card.dataset.search || "";
                const cardStatus = card.dataset.status || "";
                const cardType = card.dataset.type || "";
                const matchSearch = cardSearch.includes(search);
                const matchStatus = !status || cardStatus === status;
                const matchType = !type || cardType === type;
                const visible = matchSearch && matchStatus && matchType;
                card.style.display = visible ? "" : "none";
                if (visible) visibleCount++;
            });
            section.style.display = visibleCount > 0 ? "" : "none";
            const countElement = section.querySelector(
                ".appointment-section-count",
            );
            if (countElement) {
                countElement.textContent =
                    visibleCount +
                    " " +
                    (visibleCount === 1 ? "Appointment" : "Appointments");
            }
        });
    }
    searchInput.addEventListener("input", filterAppointments);
    statusFilter.addEventListener("change", filterAppointments);
    typeFilter.addEventListener("change", filterAppointments);
    if (clearButton) {
        clearButton.addEventListener("click", function () {
            searchInput.value = "";
            statusFilter.value = "";
            typeFilter.value = "";
            filterAppointments();
            searchInput.focus();
        });
    }
    filterAppointments();
});
