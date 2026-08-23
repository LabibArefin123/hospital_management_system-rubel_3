// ==================================================
// SERVICE TIME OCCUPIED - MARK SLOT
// ==================================================
window.ServiceTimeOccupied = window.ServiceTimeOccupied || {};
window.ServiceTimeOccupied.markSlot = function (bookedDate, bookedTime) {
    document.querySelectorAll(".service-date-card").forEach(function (slot) {
        const slotDate = slot.dataset.date || "";
        const slotTime = slot.dataset.time || "";
        if (slotDate !== bookedDate || slotTime !== bookedTime) {
            return;
        }
        slot.classList.add("occupied");
        slot.classList.remove("active");
        slot.dataset.occupied = "true";
        slot.setAttribute("aria-disabled", "true");
        slot.innerHTML =
            '<i class="fas fa-times-circle text-danger"></i><span class="slot-booked-text">Booked</span>';
        if (window.ServiceBookingState) {
            window.ServiceBookingState.date = null;
            window.ServiceBookingState.time = null;
            if (typeof window.updateServiceHiddenInputs === "function") {
                window.updateServiceHiddenInputs();
            }
            if (typeof window.updateServiceSummary === "function") {
                window.updateServiceSummary();
            }
            if (typeof window.checkServiceBookingForm === "function") {
                window.checkServiceBookingForm();
            }
        }
        console.log("[Service Slot Occupied] Marked occupied:", {
            date: bookedDate,
            time: bookedTime,
        });
    });
};
