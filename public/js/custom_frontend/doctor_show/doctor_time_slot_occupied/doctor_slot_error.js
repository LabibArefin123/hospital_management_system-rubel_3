(function (window) {
    "use strict";

    window.DoctorSlotOccupied = window.DoctorSlotOccupied || {};

    window.DoctorSlotOccupied.hasBookingError = function () {
        const errorElements = document.querySelectorAll(".text-danger");

        for (const element of errorElements) {
            const message = element.textContent.trim().toLowerCase();

            if (message.includes("this time slot is already booked")) {
                return true;
            }
        }

        return false;
    };
})(window);
