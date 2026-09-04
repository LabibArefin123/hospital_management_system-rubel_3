/* DOCTOR APPOINTMENT FILTER API */
(function () {
    const app = window.DoctorAppointmentFilter;
    app.loadAppointments = async function () {
        if (!app.filterUrl || !app.filterForm || !app.appointmentGrid) return;
        const submitButton = app.filterForm.querySelector(".filter-apply-btn");
        const originalButtonText = submitButton ? submitButton.innerHTML : "";
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.innerHTML =
                '<i class="fas fa-spinner fa-spin mr-1"></i> Loading...';
        }
        if (app.resetButton) {
            app.resetButton.disabled = true;
        }
        app.appointmentGrid.classList.add("filter-loading");
        try {
            const formData = new FormData(app.filterForm);
            const params = new URLSearchParams();
            formData.forEach(function (value, key) {
                if (value !== "") {
                    params.append(key, value);
                }
            });
            const url = params.toString()
                ? `${app.filterUrl}?${params.toString()}`
                : app.filterUrl;
            const response = await fetch(url, {
                method: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    Accept: "application/json",
                },
            });
            if (!response.ok) {
                throw new Error("Failed to filter appointments.");
            }
            const data = await response.json();
            app.appointmentGrid.innerHTML = data.html;
            if (typeof app.updateEmptyMessage === "function") {
                app.updateEmptyMessage(data.count);
            }
            app.closeModal();
        } catch (error) {
            console.error("Doctor appointment filter error:", error);
            alert("Unable to filter appointments. Please try again.");
        } finally {
            app.appointmentGrid.classList.remove("filter-loading");
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            }
            if (app.resetButton) {
                app.resetButton.disabled = false;
            }
        }
    };
})();
