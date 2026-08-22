// ==================================================
// SERVICE BOOKING - GLOBAL STATE & HELPERS
// ==================================================

(function (window) {
    "use strict";

    window.ServiceBookingState = {
        payment: null,
        date: null,
        time: null,
    };

    window.serviceEl = function (id) {
        return document.getElementById(id);
    };

    window.updateServiceHiddenInputs = function () {
        const state = window.ServiceBookingState;

        const dateInput = serviceEl("serviceFormDate");
        const timeInput = serviceEl("serviceFormTime");
        const paymentInput = serviceEl("servicePaymentMethod");

        if (dateInput) {
            dateInput.value = state.date || "";
        }

        if (timeInput) {
            timeInput.value = state.time || "";
        }

        if (paymentInput) {
            paymentInput.value = state.payment || "";
        }
    };

    window.clearServiceScheduleSelection = function () {
        const state = window.ServiceBookingState;

        state.date = null;
        state.time = null;

        document
            .querySelectorAll(".service-date-card")
            .forEach(function (slot) {
                slot.classList.remove("active");
            });

        updateServiceHiddenInputs();
    };

    window.clearServicePaymentSelection = function () {
        const state = window.ServiceBookingState;

        state.payment = null;

        document
            .querySelectorAll(".service-pay-btn, .service-pay-btn-online")
            .forEach(function (button) {
                button.classList.remove("active");
            });

        updateServiceHiddenInputs();
    };
})(window);
