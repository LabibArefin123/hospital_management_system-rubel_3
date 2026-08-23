// ==========================================================
// SERVICE BOOKING - HELPERS
// ==========================================================

(function () {
    "use strict";

    window.ServiceBookingHelpers = window.ServiceBookingHelpers || {};

    function initialize() {
        /*
        |--------------------------------------------------------------------------
        | GET INPUT VALUE
        |--------------------------------------------------------------------------
        */

        function getInputValue(element) {
            if (!element) {
                return "";
            }

            return String(element.value || "").trim();
        }

        /*
        |--------------------------------------------------------------------------
        | SUMMARY VALUE
        |--------------------------------------------------------------------------
        */

        function summaryValue(value, fallback) {
            return value && String(value).trim() !== ""
                ? String(value).trim()
                : fallback;
        }

        /*
        |--------------------------------------------------------------------------
        | FORMAT TIME
        |--------------------------------------------------------------------------
        */

        function formatTime(time) {
            if (!time) {
                return "";
            }

            const parts = String(time).split(":");

            if (parts.length < 2) {
                return time;
            }

            let hours = parseInt(parts[0], 10);
            const minutes = parts[1];

            if (Number.isNaN(hours)) {
                return time;
            }

            const period = hours >= 12 ? "PM" : "AM";

            hours = hours % 12;

            if (hours === 0) {
                hours = 12;
            }

            return (
                String(hours).padStart(2, "0") + ":" + minutes + " " + period
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PATIENT VALIDATION
        |--------------------------------------------------------------------------
        */

        function isPatientValid() {
            const elements = window.ServiceBooking.elements;

            const name = getInputValue(elements.nameInput);
            const age = getInputValue(elements.ageInput);
            const phone = getInputValue(elements.phoneInput);
            const gender = getInputValue(elements.genderInput);

            return name !== "" && age !== "" && phone !== "" && gender !== "";
        }

        /*
        |--------------------------------------------------------------------------
        | SCHEDULE VALIDATION
        |--------------------------------------------------------------------------
        */

        function isScheduleValid() {
            const state = window.ServiceBooking.state;

            return state.date !== "" && state.time !== "";
        }

        /*
        |--------------------------------------------------------------------------
        | PAYMENT VALIDATION
        |--------------------------------------------------------------------------
        */

        function isPaymentValid() {
            const state = window.ServiceBooking.state;

            return state.payment !== "";
        }

        /*
        |--------------------------------------------------------------------------
        | EXPORT
        |--------------------------------------------------------------------------
        */

        window.ServiceBookingHelpers.getInputValue = getInputValue;

        window.ServiceBookingHelpers.summaryValue = summaryValue;

        window.ServiceBookingHelpers.formatTime = formatTime;

        window.ServiceBookingHelpers.isPatientValid = isPatientValid;

        window.ServiceBookingHelpers.isScheduleValid = isScheduleValid;

        window.ServiceBookingHelpers.isPaymentValid = isPaymentValid;
    }

    window.ServiceBookingHelpers.initialize = initialize;
})();
