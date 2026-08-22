// ==================================================
// SERVICE TIME OCCUPIED
// ==================================================

document.addEventListener("DOMContentLoaded", function () {
    "use strict";

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

    document.querySelectorAll(".service-date-card").forEach(function (slot) {
        const slotDate = slot.dataset.date || "";

        const slotTime = slot.dataset.time || "";

        if (slotDate === bookedDate && slotTime === bookedTime) {
            slot.classList.add("occupied");
            slot.classList.remove("active");

            slot.dataset.occupied = "true";
            slot.setAttribute("aria-disabled", "true");

            slot.innerHTML = `
                    <i class="fas fa-times-circle text-danger"></i>
                    <span class="slot-booked-text">
                        Booked
                    </span>
                `;

            /*
                |--------------------------------------------------------------------------
                | Clear invalid state
                |--------------------------------------------------------------------------
                */

            if (window.ServiceBookingState) {
                window.ServiceBookingState.date = null;
                window.ServiceBookingState.time = null;

                updateServiceHiddenInputs();
                updateServiceSummary();
                checkServiceBookingForm();
            }

            console.log("[Service Slot Occupied] Marked occupied:", {
                date: bookedDate,
                time: bookedTime,
            });
        }
    });
});
