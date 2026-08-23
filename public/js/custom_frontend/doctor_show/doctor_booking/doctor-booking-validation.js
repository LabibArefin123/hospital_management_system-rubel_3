document.addEventListener("DOMContentLoaded", function () {
    "use strict";
    window.validateBookingForm = function (showLog = true) {
        const name = bookingElements.name?.value.trim() || "";
        const age = bookingElements.age?.value.trim() || "";
        const phone = bookingElements.phone?.value.trim() || "";
        const gender = bookingElements.gender?.value || "";
        const email = bookingElements.email?.value.trim() || "";
        const isOnline = bookingState.selectedPayment === "Online";
        const emailValid = !isOnline || email !== "";
        const isValid =
            name !== "" &&
            age !== "" &&
            phone !== "" &&
            gender !== "" &&
            bookingState.selectedDate !== "" &&
            bookingState.selectedTime !== "" &&
            bookingState.selectedPayment !== "" &&
            emailValid;
        if (bookingElements.confirmBtn) {
            bookingElements.confirmBtn.disabled = !isValid;
            bookingElements.confirmBtn.classList.toggle("ready", isValid);
            bookingElements.confirmBtn.setAttribute(
                "aria-disabled",
                isValid ? "false" : "true",
            );
        }
        if (showLog) {
            console.log("[Booking Validation]", {
                name: name,
                age: age,
                phone: phone,
                gender: gender,
                email: email,
                selectedDate: bookingState.selectedDate,
                selectedTime: bookingState.selectedTime,
                selectedPayment: bookingState.selectedPayment,
                isValid: isValid,
            });
        }
        return isValid;
    };
    ["name", "age", "phone", "gender"].forEach(function (id) {
        const input = document.getElementById(id);
        if (!input) return;
        input.addEventListener("input", function () {
            window.validateBookingForm(false);
        });
        input.addEventListener("change", function () {
            window.validateBookingForm(false);
        });
    });
    const email = bookingElements.email;
    if (email) {
        email.addEventListener("input", function () {
            window.validateBookingForm(false);
        });
        email.addEventListener("change", function () {
            window.validateBookingForm(false);
        });
    }
    if (bookingElements.form) {
        bookingElements.form.addEventListener("submit", function (e) {
            const valid = window.validateBookingForm(true);
            if (!valid) {
                e.preventDefault();
                console.warn(
                    "[Booking Validation] Form blocked because required information is missing.",
                );
            }
        });
    }
    window.validateBookingForm(false);
});
