/* SERVICE APPOINTMENT FILTER UI AND INIT */
(function () {
    const app = window.ServiceAppointmentFilter;
    app.updateEmptyMessage = function (count) {
        let emptyMessage = document.getElementById("serviceAppointmentEmpty");
        if (Number(count) === 0) {
            if (!emptyMessage) {
                emptyMessage = document.createElement("p");
                emptyMessage.id = "serviceAppointmentEmpty";
                emptyMessage.className = "empty-text";
                emptyMessage.textContent = "No service booking found";
                app.appointmentGrid.parentNode.insertBefore(
                    emptyMessage,
                    app.appointmentGrid,
                );
            }
        } else if (emptyMessage) {
            emptyMessage.remove();
        }
    };
    document.addEventListener("DOMContentLoaded", function () {
        app.filterButton = document.getElementById(
            "serviceAppointmentFilterBtn",
        );
        app.filterModal = document.getElementById(
            "serviceAppointmentFilterModal",
        );
        app.closeButton = document.getElementById(
            "serviceAppointmentFilterClose",
        );
        app.filterForm = document.getElementById(
            "serviceAppointmentFilterForm",
        );
        app.resetButton = document.getElementById(
            "serviceAppointmentFilterReset",
        );
        app.appointmentGrid = document.getElementById("serviceAppointmentGrid");
        app.overlay = app.filterModal
            ? app.filterModal.querySelector(".service-filter-modal-overlay")
            : null;
        if (
            !app.filterButton ||
            !app.filterModal ||
            !app.filterForm ||
            !app.appointmentGrid
        )
            return;
        app.filterUrl = app.filterButton.dataset.filterUrl;
        app.filterModal.classList.remove("show");
        app.filterModal.setAttribute("aria-hidden", "true");
        app.filterButton.classList.remove("active");
        document.body.classList.remove("service-filter-open");
        if (!app.filterUrl) {
            console.error("Service appointment filter URL is missing.");
            return;
        }
        app.filterButton.addEventListener("click", function (event) {
            event.preventDefault();
            event.stopPropagation();
            app.toggleModal();
        });
        if (app.closeButton) {
            app.closeButton.addEventListener("click", function (event) {
                event.preventDefault();
                app.closeModal();
            });
        }
        if (app.overlay)
            app.overlay.addEventListener("click", function () {
                app.closeModal();
            });
        document.addEventListener("keydown", function (event) {
            if (
                event.key === "Escape" &&
                app.filterModal.classList.contains("show")
            )
                app.closeModal();
        });
        app.filterForm.addEventListener("submit", function (event) {
            event.preventDefault();
            app.loadAppointments();
        });
        if (app.resetButton) {
            app.resetButton.addEventListener("click", function () {
                app.filterForm.reset();
                app.loadAppointments();
            });
        }
    });
})();
