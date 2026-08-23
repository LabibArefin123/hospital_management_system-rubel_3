// ==========================================================
// SERVICE BOOKING - INIT
// ==========================================================

(function () {
    "use strict";

    window.ServiceBooking = window.ServiceBooking || {};

    document.addEventListener("DOMContentLoaded", function () {
        const state = window.ServiceBookingState;

        if (!state) {
            console.error(
                "[Service Booking] ServiceBookingState is not loaded.",
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | DEFAULT STATE
        |--------------------------------------------------------------------------
        */

        if (typeof state.date === "undefined") {
            state.date = "";
        }

        if (typeof state.time === "undefined") {
            state.time = "";
        }

        if (typeof state.payment === "undefined") {
            state.payment = "";
        }

        if (typeof state.scheduleId === "undefined") {
            state.scheduleId = "";
        }

        /*
        |--------------------------------------------------------------------------
        | ELEMENT HELPER
        |--------------------------------------------------------------------------
        */

        const getElement = (id) => document.getElementById(id);

        /*
        |--------------------------------------------------------------------------
        | ELEMENTS
        |--------------------------------------------------------------------------
        */

        const elements = {
            form: getElement("serviceAppointmentForm"),

            nameInput: getElement("serviceName"),
            ageInput: getElement("serviceAge"),
            phoneInput: getElement("servicePhone"),
            genderInput: getElement("serviceGender"),
            emailInput: getElement("serviceEmail"),

            hiddenDate: getElement("serviceFormDate"),
            hiddenTime: getElement("serviceFormTime"),
            hiddenPayment: getElement("servicePaymentMethod"),

            summaryName: getElement("serviceSummaryName"),
            summaryAge: getElement("serviceSummaryAge"),
            summaryPhone: getElement("serviceSummaryPhone"),
            summaryGender: getElement("serviceSummaryGender"),

            summaryDate: getElement("serviceSelectedDate"),
            summaryTime: getElement("serviceSelectedTime"),
            summaryPayment: getElement("serviceSelectedPayment"),

            noSlotText: getElement("serviceNoSlotText"),
            confirmButton: getElement("serviceConfirmBtn"),
        };

        /*
        |--------------------------------------------------------------------------
        | CREATE CONTEXT
        |--------------------------------------------------------------------------
        */

        window.ServiceBooking.state = state;
        window.ServiceBooking.elements = elements;
        window.ServiceBooking.getElement = getElement;

        /*
        |--------------------------------------------------------------------------
        | INITIALIZE MODULES
        |--------------------------------------------------------------------------
        */

        if (typeof window.ServiceBookingHelpers?.initialize === "function") {
            window.ServiceBookingHelpers.initialize();
        }

        if (typeof window.ServiceBookingSummary?.initialize === "function") {
            window.ServiceBookingSummary.initialize();
        }

        if (typeof window.ServiceBookingSchedule?.initialize === "function") {
            window.ServiceBookingSchedule.initialize();
        }

        if (typeof window.ServiceBookingPayment?.initialize === "function") {
            window.ServiceBookingPayment.initialize();
        }

        if (typeof window.ServiceBookingForm?.initialize === "function") {
            window.ServiceBookingForm.initialize();
        }

        /*
        |--------------------------------------------------------------------------
        | INITIAL SYNC
        |--------------------------------------------------------------------------
        */

        if (typeof window.ServiceBookingForm?.restoreOldValues === "function") {
            window.ServiceBookingForm.restoreOldValues();
        }

        if (
            typeof window.ServiceBookingSummary?.updateHiddenInputs ===
            "function"
        ) {
            window.ServiceBookingSummary.updateHiddenInputs();
        }

        if (typeof window.ServiceBookingSummary?.updateSummary === "function") {
            window.ServiceBookingSummary.updateSummary();
        }

        if (typeof window.ServiceBookingForm?.checkBookingForm === "function") {
            window.ServiceBookingForm.checkBookingForm();
        }

        /*
        |--------------------------------------------------------------------------
        | DEBUG
        |--------------------------------------------------------------------------
        */

        console.log("[Service Booking] Initialized successfully.", {
            date: state.date,
            time: state.time,
            scheduleId: state.scheduleId,
            payment: state.payment,
        });
    });
})();
