(function (window) {
    "use strict";

    window.DoctorSlotOccupied = window.DoctorSlotOccupied || {};

    window.DoctorSlotOccupied.markOccupied = function (bookedDate, bookedTime) {
        const slots = document.querySelectorAll(".date-card");

        slots.forEach(function (slot) {
            const slotDate = slot.dataset.date || "";
            const slotTime = slot.dataset.time || "";

            if (slotDate !== bookedDate || slotTime !== bookedTime) {
                return;
            }

            slot.classList.add("occupied");
            slot.classList.remove("active");

            slot.dataset.occupied = "true";
            slot.setAttribute("aria-disabled", "true");

            slot.innerHTML = `
                <i class="fas fa-times-circle"></i>
                <span>Booked</span>
            `;

            console.log("[Doctor Slot Occupied] Occupied slot:", {
                date: bookedDate,
                time: bookedTime,
            });
        });
    };
})(window);
