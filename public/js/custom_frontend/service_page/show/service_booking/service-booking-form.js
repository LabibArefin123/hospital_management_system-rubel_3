// ==========================================================
// SERVICE BOOKING - FORM
// ==========================================================

(function () {
    "use strict";

    window.ServiceBookingForm = window.ServiceBookingForm || {};

    /*
    |--------------------------------------------------------------------------
    | CHECK COMPLETE BOOKING
    |--------------------------------------------------------------------------
    */

    function checkBookingForm() {
        const helpers = window.ServiceBookingHelpers;

        const patientValid = helpers.isPatientValid();

        const scheduleValid = helpers.isScheduleValid();

        const paymentValid = helpers.isPaymentValid();

        const valid = patientValid && scheduleValid && paymentValid;

        const confirmButton = window.ServiceBooking.elements.confirmButton;

        if (confirmButton) {
            confirmButton.disabled = !valid;

            confirmButton.setAttribute(
                "aria-disabled",
                valid ? "false" : "true",
            );
        }

        return valid;
    }

    /*
    |--------------------------------------------------------------------------
    | PATIENT INPUT EVENTS
    |--------------------------------------------------------------------------
    */

    function initializePatientInputs() {
        const elements = window.ServiceBooking.elements;

        [
            elements.nameInput,
            elements.ageInput,
            elements.phoneInput,
            elements.genderInput,
            elements.emailInput,
        ].forEach(function (input) {
            if (!input) {
                return;
            }

            input.addEventListener("input", function () {
                window.ServiceBookingSummary.updatePatientSummary();

                checkBookingForm();
            });

            input.addEventListener("change", function () {
                window.ServiceBookingSummary.updatePatientSummary();

                checkBookingForm();
            });
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RESTORE OLD FORM VALUES
    |--------------------------------------------------------------------------
    */

    function restoreOldValues() {
        const elements = window.ServiceBooking.elements;

        const state = window.ServiceBooking.state;

        const oldDate = elements.hiddenDate
            ? String(elements.hiddenDate.value || "").trim()
            : "";

        const oldTime = elements.hiddenTime
            ? String(elements.hiddenTime.value || "").trim()
            : "";

        const oldPayment = elements.hiddenPayment
            ? String(elements.hiddenPayment.value || "").trim()
            : "";

        /*
        |--------------------------------------------------------------------------
        | RESTORE DATE / TIME
        |--------------------------------------------------------------------------
        */

        if (oldDate && oldTime) {
            const slots = document.querySelectorAll(".service-date-card");

            slots.forEach(function (slot) {
                const slotDate = String(slot.dataset.date || "").trim();

                const slotTime = String(slot.dataset.time || "").trim();

                const occupied =
                    slot.dataset.occupied === "true" ||
                    slot.classList.contains("occupied");

                if (slotDate === oldDate && slotTime === oldTime && !occupied) {
                    slots.forEach(function (item) {
                        item.classList.remove("active");
                    });

                    slot.classList.add("active");

                    state.date = oldDate;
                    state.time = oldTime;

                    state.scheduleId = slot.dataset.scheduleId || "";
                }
            });
        }

        /*
        |--------------------------------------------------------------------------
        | RESTORE PAYMENT
        |--------------------------------------------------------------------------
        */

        if (oldPayment) {
            const paymentButtons = document.querySelectorAll(
                ".service-pay-btn, .service-pay-btn-online",
            );

            paymentButtons.forEach(function (button) {
                const value = String(button.dataset.value || "").trim();

                if (value === oldPayment) {
                    paymentButtons.forEach(function (item) {
                        item.classList.remove("active");
                    });

                    button.classList.add("active");

                    state.payment = oldPayment;
                }
            });
        }
    }

    /*
    |--------------------------------------------------------------------------
    | FORM SUBMIT
    |--------------------------------------------------------------------------
    */

    function initializeFormSubmit() {
        const form = window.ServiceBooking.elements.form;

        if (!form) {
            return;
        }

        form.addEventListener("submit", function (event) {
            /*
                |--------------------------------------------------------------------------
                | SYNC EVERYTHING
                |--------------------------------------------------------------------------
                */

            window.ServiceBookingSummary.updateHiddenInputs();

            window.ServiceBookingSummary.updateSummary();

            /*
                |--------------------------------------------------------------------------
                | VALIDATE
                |--------------------------------------------------------------------------
                */

            if (!checkBookingForm()) {
                event.preventDefault();

                const elements = window.ServiceBooking.elements;

                const state = window.ServiceBooking.state;

                const helpers = window.ServiceBookingHelpers;

                const missing = [];

                if (!helpers.getInputValue(elements.nameInput)) {
                    missing.push("Name");
                }

                if (!helpers.getInputValue(elements.phoneInput)) {
                    missing.push("Mobile Number");
                }

                if (!helpers.getInputValue(elements.ageInput)) {
                    missing.push("Age");
                }

                if (!helpers.getInputValue(elements.genderInput)) {
                    missing.push("Gender");
                }

                if (!state.date) {
                    missing.push("Date");
                }

                if (!state.time) {
                    missing.push("Time");
                }

                if (!state.payment) {
                    missing.push("Payment Method");
                }

                alert(
                    "Please complete the following:\n\n" + missing.join("\n"),
                );

                return;
            }

            /*
                |--------------------------------------------------------------------------
                | FINAL SYNC
                |--------------------------------------------------------------------------
                */

            window.ServiceBookingSummary.updateHiddenInputs();

            console.log("[Service Booking] Submitting:", {
                service_id:
                    form.querySelector('[name="service_id"]')?.value || "",

                schedule_id: window.ServiceBooking.state.scheduleId || "",

                date: window.ServiceBooking.state.date || "",

                time: window.ServiceBooking.state.time || "",

                payment: window.ServiceBooking.state.payment || "",
            });
        });
    }

    /*
    |--------------------------------------------------------------------------
    | INITIALIZE
    |--------------------------------------------------------------------------
    */

    function initialize() {
        initializePatientInputs();
        initializeFormSubmit();
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORT
    |--------------------------------------------------------------------------
    */

    window.ServiceBookingForm.initialize = initialize;

    window.ServiceBookingForm.checkBookingForm = checkBookingForm;

    window.ServiceBookingForm.restoreOldValues = restoreOldValues;
})();
