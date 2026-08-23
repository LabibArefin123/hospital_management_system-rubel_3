// ==================================================
// SERVICE TIME OCCUPIED - DETECT
// ==================================================
window.ServiceTimeOccupied = window.ServiceTimeOccupied || {};
window.ServiceTimeOccupied.detectError = function () {
    const errorElements = document.querySelectorAll(".text-danger");
    let slotError = false;
    errorElements.forEach(function (element) {
        const message = element.textContent.trim().toLowerCase();
        if (
            message.includes("this time slot is already booked") ||
            message.includes("selected service time slot is not available")
        ) {
            slotError = true;
        }
    });
    if (!slotError) {
        return;
    }
    const formDate = document.getElementById("serviceFormDate");
    const formTime = document.getElementById("serviceFormTime");
    if (!formDate || !formTime) {
        console.warn("[Service Slot Occupied] Date/time fields not found.");
        return;
    }
    const bookedDate = formDate.value;
    const bookedTime = formTime.value;
    if (!bookedDate || !bookedTime) {
        return;
    }
    if (typeof window.ServiceTimeOccupied.markSlot === "function") {
        window.ServiceTimeOccupied.markSlot(bookedDate, bookedTime);
    }
};
