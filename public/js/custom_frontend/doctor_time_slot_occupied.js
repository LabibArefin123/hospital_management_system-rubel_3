document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    const errorElements = document.querySelectorAll(".text-danger");

    let slotError = false;

    errorElements.forEach(function (element) {
        if (
            element.textContent
                .trim()
                .toLowerCase()
                .includes("this time slot is already booked")
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
        console.warn("[Doctor Slot Occupied] Date/time fields not found.");
        return;
    }

    const bookedDate = formDate.value;
    const bookedTime = formTime.value;

    if (!bookedDate || !bookedTime) {
        console.warn("[Doctor Slot Occupied] Booked date/time not available.");
        return;
    }

    document.querySelectorAll(".date-card").forEach(function (slot) {
        const slotDate = slot.dataset.date || "";
        const slotTime = slot.dataset.time || "";

        if (slotDate === bookedDate && slotTime === bookedTime) {
            slot.classList.add("occupied");
            slot.classList.remove("active");

            slot.dataset.occupied = "true";
            slot.setAttribute("aria-disabled", "true");

            const icon = slot.querySelector("i");

            if (icon) {
                icon.className = "fas fa-times-circle text-danger";
            }

            const existingText = slot.textContent.trim();

            if (!existingText.toLowerCase().includes("booked")) {
                const timeText = document.createTextNode(" Booked");
                slot.appendChild(timeText);
            }

            console.log("[Doctor Slot Occupied] Occupied slot:", {
                date: bookedDate,
                time: bookedTime,
            });
        }
    });
});
