// ==========================================================
// SERVICE BOOKING - SUMMARY
// ==========================================================

(function () {
    "use strict";

    window.ServiceBookingSummary = window.ServiceBookingSummary || {};

    function initialize() {
        const state = window.ServiceBooking.state;
        const elements = window.ServiceBooking.elements;

        /*
        |--------------------------------------------------------------------------
        | UPDATE PATIENT SUMMARY
        |--------------------------------------------------------------------------
        */

        function updatePatientSummary() {
            const helpers = window.ServiceBookingHelpers;

            if (elements.summaryName) {
                elements.summaryName.textContent = helpers.summaryValue(
                    helpers.getInputValue(elements.nameInput),
                    "Not Filled",
                );
            }

            if (elements.summaryAge) {
                elements.summaryAge.textContent = helpers.summaryValue(
                    helpers.getInputValue(elements.ageInput),
                    "Not Filled",
                );
            }

            if (elements.summaryPhone) {
                elements.summaryPhone.textContent = helpers.summaryValue(
                    helpers.getInputValue(elements.phoneInput),
                    "Not Filled",
                );
            }

            if (elements.summaryGender) {
                elements.summaryGender.textContent = helpers.summaryValue(
                    helpers.getInputValue(elements.genderInput),
                    "Not Filled",
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATE / TIME SUMMARY
        |--------------------------------------------------------------------------
        */

        function updateScheduleSummary() {
            if (elements.summaryDate) {
                elements.summaryDate.textContent = state.date
                    ? state.date
                    : "Not Selected";
            }

            if (elements.summaryTime) {
                elements.summaryTime.textContent = state.time
                    ? window.ServiceBookingHelpers.formatTime(state.time)
                    : "Not Selected";
            }

            if (elements.noSlotText) {
                if (state.date && state.time) {
                    elements.noSlotText.textContent =
                        "Appointment slot selected";
                } else {
                    elements.noSlotText.textContent =
                        "Select a date and time slot";
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE PAYMENT SUMMARY
        |--------------------------------------------------------------------------
        */

        function updatePaymentSummary() {
            if (!elements.summaryPayment) {
                return;
            }

            elements.summaryPayment.textContent = state.payment
                ? state.payment
                : "Not Selected";
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE ALL SUMMARY
        |--------------------------------------------------------------------------
        */

        function updateSummary() {
            updatePatientSummary();
            updateScheduleSummary();
            updatePaymentSummary();
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE HIDDEN INPUTS
        |--------------------------------------------------------------------------
        */

        function updateHiddenInputs() {
            if (elements.hiddenDate) {
                elements.hiddenDate.value = state.date || "";
            }

            if (elements.hiddenTime) {
                elements.hiddenTime.value = state.time || "";
            }

            if (elements.hiddenPayment) {
                elements.hiddenPayment.value = state.payment || "";
            }

            const hiddenScheduleId =
                window.ServiceBooking.getElement("serviceScheduleId");

            if (hiddenScheduleId) {
                hiddenScheduleId.value = state.scheduleId || "";
            }
        }

        /*
        |--------------------------------------------------------------------------
        | EXPORT
        |--------------------------------------------------------------------------
        */

        window.ServiceBookingSummary.updatePatientSummary =
            updatePatientSummary;

        window.ServiceBookingSummary.updateScheduleSummary =
            updateScheduleSummary;

        window.ServiceBookingSummary.updatePaymentSummary =
            updatePaymentSummary;

        window.ServiceBookingSummary.updateSummary = updateSummary;

        window.ServiceBookingSummary.updateHiddenInputs = updateHiddenInputs;
    }

    window.ServiceBookingSummary.initialize = initialize;
})();
