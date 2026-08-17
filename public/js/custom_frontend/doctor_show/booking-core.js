/* =========================================================
   FILE: booking-core.js
========================================================= */

window.bookingState = {
    currentPage: 0,
    selectedDate: "",
    selectedTime: "",
    selectedPayment: "",
};

window.bookingElements = {};

document.addEventListener("DOMContentLoaded", function () {
    bookingElements.pages = document.querySelectorAll(".schedule-page");

    bookingElements.prevBtn = document.getElementById("prevSchedule");

    bookingElements.nextBtn = document.getElementById("nextSchedule");

    bookingElements.confirmBtn = document.getElementById("confirmBtn");

    bookingElements.form = document.querySelector(
        'form[action*="appointment"]',
    );

    bookingElements.formDate = document.getElementById("formDate");

    bookingElements.formTime = document.getElementById("formTime");

    bookingElements.paymentInput = document.getElementById("paymentMethod");

    bookingElements.selectedDateText = document.getElementById("selectedDate");

    bookingElements.selectedTimeText = document.getElementById("selectedTime");

    bookingElements.noSlotText = document.getElementById("noSlotText");
});
