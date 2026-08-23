window.bookingState = {
    currentPage: 0,
    selectedDate: "",
    selectedTime: "",
    selectedPayment: "",
};
window.bookingElements = {};
document.addEventListener("DOMContentLoaded", function () {
    "use strict";
    window.bookingElements.pages = document.querySelectorAll(".schedule-page");
    window.bookingElements.prevBtn = document.getElementById("prevSchedule");
    window.bookingElements.nextBtn = document.getElementById("nextSchedule");
    window.bookingElements.confirmBtn = document.getElementById("confirmBtn");
    window.bookingElements.form = document.querySelector(
        'form[action*="appointment"]',
    );
    window.bookingElements.formDate = document.getElementById("formDate");
    window.bookingElements.formTime = document.getElementById("formTime");
    window.bookingElements.paymentInput =
        document.getElementById("paymentMethod");
    window.bookingElements.selectedDateText =
        document.getElementById("selectedDate");
    window.bookingElements.selectedTimeText =
        document.getElementById("selectedTime");
    window.bookingElements.noSlotText = document.getElementById("noSlotText");
    window.bookingElements.name = document.getElementById("name");
    window.bookingElements.age = document.getElementById("age");
    window.bookingElements.phone = document.getElementById("phone");
    window.bookingElements.gender = document.getElementById("gender");
    window.bookingElements.email = document.querySelector('[name="email"]');
});
