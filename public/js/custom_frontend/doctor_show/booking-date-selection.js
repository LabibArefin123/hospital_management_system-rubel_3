document.addEventListener("DOMContentLoaded", function () {
    "use strict";
    if (!window.bookingState || !window.bookingElements) {
        console.error("[Booking Date] Core not loaded.");
        return;
    }
    function formatDate(date) {
        if (!date) return "";
        const value = new Date(date);
        if (isNaN(value.getTime())) return date;
        return value.toLocaleDateString("en-GB", {
            weekday: "long",
            day: "numeric",
            month: "long",
            year: "numeric",
        });
    }
    function formatTime(time) {
        if (!time) return "";
        const value = new Date(`1970-01-01T${time}`);
        if (isNaN(value.getTime())) return time;
        return value.toLocaleTimeString("en-US", {
            hour: "2-digit",
            minute: "2-digit",
            hour12: true,
        });
    }
    document.querySelectorAll(".date-card").forEach(function (card) {
        card.addEventListener("click", function () {
            document.querySelectorAll(".date-card").forEach(function (item) {
                item.classList.remove("active");
            });
            this.classList.add("active");
            bookingState.selectedDate = this.dataset.date || "";
            bookingState.selectedTime = this.dataset.time || "";
            if (bookingElements.formDate) {
                bookingElements.formDate.value = bookingState.selectedDate;
            }
            if (bookingElements.formTime) {
                bookingElements.formTime.value = bookingState.selectedTime;
            }
            if (bookingElements.selectedDateText) {
                bookingElements.selectedDateText.innerText = formatDate(
                    bookingState.selectedDate,
                );
            }
            if (bookingElements.selectedTimeText) {
                bookingElements.selectedTimeText.innerText = formatTime(
                    bookingState.selectedTime,
                );
            }
            if (bookingElements.noSlotText) {
                bookingElements.noSlotText.style.display = "none";
            }
            if (typeof window.validateBookingForm === "function") {
                window.validateBookingForm(false);
            }
            console.log("[Booking Date] Selected:", {
                date: bookingState.selectedDate,
                time: bookingState.selectedTime,
            });
        });
    });
});
