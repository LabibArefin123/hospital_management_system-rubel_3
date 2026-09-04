/* SERVICE APPOINTMENT FILTER MODAL */
(function () {
    const app = window.ServiceAppointmentFilter;
    app.openModal = function () {
        if (!app.filterModal) return;
        app.filterModal.classList.add("show");
        app.filterModal.setAttribute("aria-hidden", "false");
        if (app.filterButton) app.filterButton.classList.add("active");
        document.body.classList.add("service-filter-open");
    };
    app.closeModal = function () {
        if (!app.filterModal) return;
        app.filterModal.classList.remove("show");
        app.filterModal.setAttribute("aria-hidden", "true");
        if (app.filterButton) app.filterButton.classList.remove("active");
        document.body.classList.remove("service-filter-open");
    };
    app.toggleModal = function () {
        if (!app.filterModal) return;
        app.filterModal.classList.contains("show")
            ? app.closeModal()
            : app.openModal();
    };
})();
