/* =========================================================
   FILE: booking-selection-restore.js
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    if (!window.bookingState || !window.bookingElements) {
        console.error("[Booking Restore] Core not loaded.");
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

    const oldDate = bookingElements.formDate?.value || "";
    const oldTime = bookingElements.formTime?.value || "";
    const oldPayment = bookingElements.paymentInput?.value || "";

    if (oldDate) {
        bookingState.selectedDate = oldDate;
    }

    if (oldTime) {
        bookingState.selectedTime = oldTime;
    }

    if (oldPayment) {
        bookingState.selectedPayment = oldPayment;
    }

    if (oldDate && oldTime) {
        document.querySelectorAll(".date-card").forEach(function (card) {
            const cardDate = card.dataset.date || "";
            const cardTime = card.dataset.time || "";

            if (cardDate === oldDate && cardTime === oldTime) {
                card.classList.add("active");

                if (bookingElements.selectedDateText) {
                    bookingElements.selectedDateText.innerText =
                        formatDate(oldDate);
                }

                if (bookingElements.selectedTimeText) {
                    bookingElements.selectedTimeText.innerText =
                        formatTime(oldTime);
                }

                const parentPage = card.closest(".schedule-page");

                if (parentPage && bookingElements.pages) {
                    bookingElements.pages.forEach(function (page, index) {
                        if (page === parentPage) {
                            bookingState.currentPage = index;

                            if (typeof window.showBookingPage === "function") {
                                window.showBookingPage(index);
                            }
                        }
                    });
                }
            }
        });
    }

    if (oldPayment) {
        document
            .querySelectorAll(".pay-btn,.pay-btn-2")
            .forEach(function (btn) {
                const value = btn.dataset.value || btn.value || "";

                if (value === oldPayment) {
                    btn.classList.add("active");
                }
            });
    }

    if (typeof window.validateBookingForm === "function") {
        window.validateBookingForm(false);
    }
});
