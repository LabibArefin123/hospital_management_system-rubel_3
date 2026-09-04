/* DOCTOR APPOINTMENT FILTER INIT */
document.addEventListener("DOMContentLoaded", function () {
    const app = window.DoctorAppointmentFilter;
    app.filterButton = document.getElementById("doctorAppointmentFilterBtn");
    app.filterModal = document.getElementById("doctorAppointmentFilterModal");
    app.closeButton = document.getElementById("doctorAppointmentFilterClose");
    app.filterForm = document.getElementById("doctorAppointmentFilterForm");
    app.resetButton = document.getElementById("doctorAppointmentFilterReset");
    app.appointmentGrid = document.getElementById("doctorAppointmentGrid");
    app.overlay = app.filterModal
        ? app.filterModal.querySelector(".doctor-filter-modal-overlay")
        : null;
    if (
        !app.filterButton ||
        !app.filterModal ||
        !app.filterForm ||
        !app.appointmentGrid
    ) {
        return;
    }
    app.filterUrl = app.filterButton.dataset.filterUrl;
    if (!app.filterUrl) {
        console.error("Doctor appointment filter URL is missing.");
        return;
    }
    /* FILTER BUTTON */
    app.filterButton.addEventListener("click", function (event) {
        event.preventDefault();
        event.stopPropagation();
        app.toggleModal();
    });
    /* CLOSE BUTTON */
    if (app.closeButton) {
        app.closeButton.addEventListener("click", function (event) {
            event.preventDefault();
            app.closeModal();
        });
    }
    /* OVERLAY */
    if (app.overlay) {
        app.overlay.addEventListener("click", function () {
            app.closeModal();
        });
    }
    /* ESCAPE */
    document.addEventListener("keydown", function (event) {
        if (
            event.key === "Escape" &&
            app.filterModal.classList.contains("show")
        ) {
            app.closeModal();
        }
    });
    /* SUBMIT */
    app.filterForm.addEventListener("submit", function (event) {
        event.preventDefault();
        app.loadAppointments();
    });
    /* RESET */
    if (app.resetButton) {
        app.resetButton.addEventListener("click", function () {
            app.filterForm.reset();
            app.loadAppointments();
        });
    }
});
