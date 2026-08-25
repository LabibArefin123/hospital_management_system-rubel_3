/* =========================================================
   DOCTOR BOOKING - PAYMENT SELECTION
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    /* =====================================================
       CORE CHECK
    ===================================================== */

    if (!window.bookingState || !window.bookingElements) {
        console.error("[Booking Payment] Core not loaded.");
        return;
    }

    /* =====================================================
       PAYMENT BUTTONS
       
       IMPORTANT:
       Only select doctor booking payment buttons that
       actually contain data-value.

       This prevents this script from affecting:
       payment page .pay-btn buttons.
    ===================================================== */

    const paymentButtons = document.querySelectorAll(
        ".pay-btn[data-value], .pay-btn-2[data-value]",
    );

    /* =====================================================
       NO PAYMENT BUTTONS
    ===================================================== */

    if (!paymentButtons.length) {
        return;
    }

    /* =====================================================
       SELECT PAYMENT
    ===================================================== */

    function selectPayment(button) {
        const paymentMethod = button.dataset.value || button.value || "";

        /* ---------------------------------------------
           Validate payment value
        --------------------------------------------- */

        if (!paymentMethod) {
            console.warn("[Booking Payment] Payment value missing.", button);

            return;
        }

        /* ---------------------------------------------
           Remove active state
           
           IMPORTANT:
           Use paymentButtons instead of querying
           all .pay-btn elements on the page.
           --------------------------------------------- */

        paymentButtons.forEach(function (btn) {
            btn.classList.remove("active");

            btn.setAttribute("aria-pressed", "false");
        });

        /* ---------------------------------------------
           Activate selected button
        --------------------------------------------- */

        button.classList.add("active");

        button.setAttribute("aria-pressed", "true");

        /* ---------------------------------------------
           Update booking state
        --------------------------------------------- */

        bookingState.selectedPayment = paymentMethod;

        /* ---------------------------------------------
           Update hidden payment input
        --------------------------------------------- */

        if (bookingElements.paymentInput) {
            bookingElements.paymentInput.value = paymentMethod;
        }

        /* ---------------------------------------------
           Online payment requires email
        --------------------------------------------- */

        if (bookingElements.email) {
            bookingElements.email.required = paymentMethod === "Online";
        }

        /* ---------------------------------------------
           Email required indicator
        --------------------------------------------- */

        const emailRequiredMark = document.getElementById("emailRequiredMark");

        if (emailRequiredMark) {
            emailRequiredMark.innerText =
                paymentMethod === "Online" ? "*" : "(optional)";
        }

        /* ---------------------------------------------
           Validate booking form
        --------------------------------------------- */

        if (typeof window.validateBookingForm === "function") {
            window.validateBookingForm(false);
        }

        /* ---------------------------------------------
           Debug
        --------------------------------------------- */

        console.log("[Booking Payment] Selected:", paymentMethod);

        console.log("[Booking Payment] State:", bookingState);
    }

    /* =====================================================
       PAYMENT BUTTON EVENTS
    ===================================================== */

    paymentButtons.forEach(function (button) {
        button.addEventListener("click", function (event) {
            /*
             * These are type="button" payment-selection
             * buttons, so prevent their default action.
             */

            event.preventDefault();

            event.stopPropagation();

            selectPayment(this);
        });
    });
});
