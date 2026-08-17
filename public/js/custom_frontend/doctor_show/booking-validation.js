/* =========================================================
   FILE: booking-validation.js
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    window.validateBookingForm = function () {
        const name = document.getElementById("name")?.value.trim() || "";

        const age = document.getElementById("age")?.value.trim() || "";

        const phone = document.getElementById("phone")?.value.trim() || "";

        const gender = document.getElementById("gender")?.value || "";

        const isValid =
            name !== "" &&
            age !== "" &&
            phone !== "" &&
            gender !== "" &&
            bookingState.selectedDate !== "" &&
            bookingState.selectedTime !== "" &&
            bookingState.selectedPayment !== "";

        if (bookingElements.confirmBtn) {
            bookingElements.confirmBtn.disabled = !isValid;

            bookingElements.confirmBtn.style.background = isValid
                ? "#22c55e"
                : "gray";

            bookingElements.confirmBtn.style.cursor = isValid
                ? "pointer"
                : "not-allowed";

            bookingElements.confirmBtn.style.opacity = isValid ? "1" : "0.7";
        }

        console.log({
            name,
            age,
            phone,
            gender,
            selectedDate: bookingState.selectedDate,
            selectedTime: bookingState.selectedTime,
            selectedPayment: bookingState.selectedPayment,
            isValid,
        });
    };

    ["name", "age", "phone", "gender"].forEach((id) => {
        const input = document.getElementById(id);

        if (!input) return;

        input.addEventListener("input", window.validateBookingForm);

        input.addEventListener("change", window.validateBookingForm);
    });

    if (bookingElements.form) {
        bookingElements.form.addEventListener("submit", function (e) {
            window.validateBookingForm();

            if (
                bookingState.selectedDate === "" ||
                bookingState.selectedTime === "" ||
                bookingState.selectedPayment === ""
            ) {
                e.preventDefault();

                alert("Please complete booking information");

                return;
            }
        });
    }
});
