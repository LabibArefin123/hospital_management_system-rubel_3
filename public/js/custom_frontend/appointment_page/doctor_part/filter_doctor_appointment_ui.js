/* DOCTOR APPOINTMENT FILTER UI */
(function () {
    const app = window.DoctorAppointmentFilter;
    app.updateEmptyMessage = function (count) {
        let emptyMessage = document.getElementById("doctorAppointmentEmpty");
        if (Number(count) === 0) {
            if (!emptyMessage) {
                emptyMessage = document.createElement("p");
                emptyMessage.id = "doctorAppointmentEmpty";
                emptyMessage.className = "empty-text";
                emptyMessage.textContent = "No doctor appointments found.";
                app.appointmentGrid.parentNode.insertBefore(
                    emptyMessage,
                    app.appointmentGrid,
                );
            }
        } else {
            if (emptyMessage) {
                emptyMessage.remove();
            }
        }
    };
})();
