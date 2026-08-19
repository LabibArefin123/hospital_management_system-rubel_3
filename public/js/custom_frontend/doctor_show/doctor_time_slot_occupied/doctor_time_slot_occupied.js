document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    if (!window.DoctorSlotOccupied) {
        return;
    }

    if (!window.DoctorSlotOccupied.hasBookingError()) {
        return;
    }

    const slot = window.DoctorSlotOccupied.getFormSlot();

    if (!slot) {
        return;
    }

    window.DoctorSlotOccupied.markOccupied(slot.date, slot.time);
});
