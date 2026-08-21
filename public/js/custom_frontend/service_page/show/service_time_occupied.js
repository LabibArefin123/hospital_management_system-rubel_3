document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    /*
    |--------------------------------------------------------------------------
    | SERVICE TIME OCCUPIED
    |--------------------------------------------------------------------------
    | Converts the selected service slot to "Booked" when the backend
    | returns the "already booked" validation error.
    |--------------------------------------------------------------------------
    */

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

    const formDate = document.getElementById("formDate");
    const formTime = document.getElementById("formTime");

    if (!formDate || !formTime) {
        console.warn("[Service Slot Occupied] Date/time fields not found.");
        return;
    }

    const bookedDate = formDate.value;
    const bookedTime = formTime.value;

    if (!bookedDate || !bookedTime) {
        console.warn("[Service Slot Occupied] Booked date/time not available.");
        return;
    }

    document.querySelectorAll(".date-card").forEach(function (slot) {
        const slotDate = slot.dataset.date || "";
        const slotTime = slot.dataset.time || "";

        if (slotDate === bookedDate && slotTime === bookedTime) {
            /*
            |--------------------------------------------------------------------------
            | Mark slot occupied
            |--------------------------------------------------------------------------
            */

            slot.classList.add("occupied");
            slot.classList.remove("active");

            slot.dataset.occupied = "true";

            slot.setAttribute("aria-disabled", "true");

            /*
            |--------------------------------------------------------------------------
            | Update icon
            |--------------------------------------------------------------------------
            */

            const icon = slot.querySelector("i");

            if (icon) {
                icon.className = "fas fa-times-circle text-danger";
            }

            /*
            |--------------------------------------------------------------------------
            | Replace time with Booked
            |--------------------------------------------------------------------------
            */

            const existingBookedText = slot.querySelector(".slot-booked-text");

            if (!existingBookedText) {
                slot.innerHTML = `
                    <i class="fas fa-times-circle text-danger"></i>
                    <span class="slot-booked-text">Booked</span>
                `;
            }

            console.log("[Service Slot Occupied] Occupied slot:", {
                date: bookedDate,
                time: bookedTime,
            });
        }
    });
});
