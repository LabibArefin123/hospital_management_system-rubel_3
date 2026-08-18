/* =========================================================
   FILE: booking-payment-selection.js
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    if (!window.bookingState || !window.bookingElements) {
        console.error("[Booking Payment] Core not loaded.");
        return;
    }

    function selectPayment(button) {
        const paymentMethod = button.dataset.value || button.value || "";

        if (!paymentMethod) {
            console.warn("[Booking Payment] Payment value missing.", button);
            return;
        }

        /*
|--------------------------------------------------------------------------
| NORMAL PAYMENT BUTTON
|--------------------------------------------------------------------------
*/

        document.querySelectorAll(".pay-btn").forEach(function (btn) {
            btn.classList.remove("active");
        });

        /*
|--------------------------------------------------------------------------
| SECOND PAYMENT BUTTON
|--------------------------------------------------------------------------
*/

        document.querySelectorAll(".pay-btn-2").forEach(function (btn) {
            btn.classList.remove("active");
        });

        /*
|--------------------------------------------------------------------------
| ACTIVATE SELECTED BUTTON
|--------------------------------------------------------------------------
*/

        button.classList.add("active");

        /*
|--------------------------------------------------------------------------
| SAVE PAYMENT METHOD
|--------------------------------------------------------------------------
*/

        bookingState.selectedPayment = paymentMethod;

        if (bookingElements.paymentInput) {
            bookingElements.paymentInput.value = paymentMethod;
        }

        /*
|--------------------------------------------------------------------------
| ONLINE EMAIL REQUIREMENT
|--------------------------------------------------------------------------
*/

        if (bookingElements.email) {
            if (paymentMethod === "Online") {
                bookingElements.email.required = true;
            } else {
                bookingElements.email.required = false;
            }
        }

        /*
|--------------------------------------------------------------------------
| EMAIL LABEL
|--------------------------------------------------------------------------
*/

        const emailRequiredMark = document.getElementById("emailRequiredMark");

        if (emailRequiredMark) {
            emailRequiredMark.innerText =
                paymentMethod === "Online" ? "*" : "(optional)";
        }

        /*
|--------------------------------------------------------------------------
| VALIDATE
|--------------------------------------------------------------------------
*/

        if (typeof window.validateBookingForm === "function") {
            window.validateBookingForm(false);
        }

        console.log("[Booking Payment] Selected:", paymentMethod);
    }

    /*
|--------------------------------------------------------------------------
| .pay-btn
|--------------------------------------------------------------------------
*/

    document.querySelectorAll(".pay-btn").forEach(function (btn) {
        btn.addEventListener("click", function (event) {
            event.preventDefault();

            selectPayment(this);
        });
    });

    /*
|--------------------------------------------------------------------------
| .pay-btn-2
|--------------------------------------------------------------------------
*/

    document.querySelectorAll(".pay-btn-2").forEach(function (btn) {
        btn.addEventListener("click", function (event) {
            event.preventDefault();

            selectPayment(this);
        });
    });
});
