(function (window) {
    "use strict";

    window.DoctorSlotOccupied = window.DoctorSlotOccupied || {};

    window.DoctorSlotOccupied.getFormSlot = function () {
        const formDate = document.getElementById("formDate");
        const formTime = document.getElementById("formTime");

        if (!formDate || !formTime) {
            console.warn("[Doctor Slot Occupied] Date/time fields not found.");

            return null;
        }

        const bookedDate = formDate.value;
        const bookedTime = formTime.value;

        if (!bookedDate || !bookedTime) {
            console.warn(
                "[Doctor Slot Occupied] Booked date/time not available.",
            );

            return null;
        }

        return {
            date: bookedDate,
            time: bookedTime,
        };
    };
})(window);
