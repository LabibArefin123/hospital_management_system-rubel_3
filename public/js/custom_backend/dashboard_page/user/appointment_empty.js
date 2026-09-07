/* EMPTY APPOINTMENT*/
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("appointmentEmptyModal");
    const closeButton = document.getElementById("closeAppointmentEmpty");
    if (!modal) {
        return;
    }
    requestAnimationFrame(function () {
        modal.classList.add("show");
    });
    if (closeButton) {
        closeButton.addEventListener("click", function () {
            modal.classList.remove("show");
        });
    }
    modal.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.classList.remove("show");
        }
    });
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            modal.classList.remove("show");
        }
    });
});
