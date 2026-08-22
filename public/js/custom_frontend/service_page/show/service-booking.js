// ==========================================================
// SERVICE BOOKING SCRIPT
// ==========================================================

document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    /*
    |--------------------------------------------------------------------------
    | STATE
    |--------------------------------------------------------------------------
    */

    const state = window.ServiceBookingState;

    if (!state) {
        console.error("[Service Booking] ServiceBookingState is not loaded.");

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | ELEMENT HELPERS
    |--------------------------------------------------------------------------
    */

    const getElement = (id) => document.getElementById(id);

    const form = getElement("serviceAppointmentForm");

    const nameInput = getElement("serviceName");
    const ageInput = getElement("serviceAge");
    const phoneInput = getElement("servicePhone");
    const genderInput = getElement("serviceGender");
    const emailInput = getElement("serviceEmail");

    const hiddenDate = getElement("serviceFormDate");
    const hiddenTime = getElement("serviceFormTime");
    const hiddenPayment = getElement("servicePaymentMethod");

    const summaryName = getElement("serviceSummaryName");
    const summaryAge = getElement("serviceSummaryAge");
    const summaryPhone = getElement("serviceSummaryPhone");
    const summaryGender = getElement("serviceSummaryGender");

    const summaryDate = getElement("serviceSelectedDate");
    const summaryTime = getElement("serviceSelectedTime");
    const summaryPayment = getElement("serviceSelectedPayment");

    const noSlotText = getElement("serviceNoSlotText");
    const confirmButton = getElement("serviceConfirmBtn");

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
    | UPDATE PATIENT SUMMARY
    |--------------------------------------------------------------------------
    */

    function updatePatientSummary() {
        if (summaryName) {
            summaryName.textContent = summaryValue(
                getInputValue(nameInput),
                "Not Filled",
            );
        }

        if (summaryAge) {
            summaryAge.textContent = summaryValue(
                getInputValue(ageInput),
                "Not Filled",
            );
        }

        if (summaryPhone) {
            summaryPhone.textContent = summaryValue(
                getInputValue(phoneInput),
                "Not Filled",
            );
        }

        if (summaryGender) {
            summaryGender.textContent = summaryValue(
                getInputValue(genderInput),
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
        if (summaryDate) {
            summaryDate.textContent = state.date ? state.date : "Not Selected";
        }

        if (summaryTime) {
            summaryTime.textContent = state.time
                ? formatTime(state.time)
                : "Not Selected";
        }

        if (noSlotText) {
            if (state.date && state.time) {
                noSlotText.textContent = "Appointment slot selected";
            } else {
                noSlotText.textContent = "Select a date and time slot";
            }
        }
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

        /*
        | Handle HH:mm:ss
        */

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

        return String(hours).padStart(2, "0") + ":" + minutes + " " + period;
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PAYMENT SUMMARY
    |--------------------------------------------------------------------------
    */

    function updatePaymentSummary() {
        if (!summaryPayment) {
            return;
        }

        summaryPayment.textContent = state.payment
            ? state.payment
            : "Not Selected";
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE ALL SUMMARY
    |--------------------------------------------------------------------------
    */

    function updateServiceSummary() {
        updatePatientSummary();

        updateScheduleSummary();

        updatePaymentSummary();
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE HIDDEN INPUTS
    |--------------------------------------------------------------------------
    */

    function updateServiceHiddenInputs() {
        if (hiddenDate) {
            hiddenDate.value = state.date || "";
        }

        if (hiddenTime) {
            hiddenTime.value = state.time || "";
        }

        if (hiddenPayment) {
            hiddenPayment.value = state.payment || "";
        }

        /*
        | Schedule ID
        |
        | If your form contains this hidden input, keep it synced.
        */

        const hiddenScheduleId = getElement("serviceScheduleId");

        if (hiddenScheduleId) {
            hiddenScheduleId.value = state.scheduleId || "";
        }
    }

    /*
    |--------------------------------------------------------------------------
    | PATIENT VALIDATION
    |--------------------------------------------------------------------------
    */

    function isPatientValid() {
        const name = getInputValue(nameInput);
        const age = getInputValue(ageInput);
        const phone = getInputValue(phoneInput);
        const gender = getInputValue(genderInput);

        return name !== "" && age !== "" && phone !== "" && gender !== "";
    }

    /*
    |--------------------------------------------------------------------------
    | SCHEDULE VALIDATION
    |--------------------------------------------------------------------------
    */

    function isScheduleValid() {
        return state.date !== "" && state.time !== "";
    }

    /*
    |--------------------------------------------------------------------------
    | PAYMENT VALIDATION
    |--------------------------------------------------------------------------
    */

    function isPaymentValid() {
        return state.payment !== "";
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK COMPLETE BOOKING
    |--------------------------------------------------------------------------
    */

    function checkServiceBookingForm() {
        const patientValid = isPatientValid();

        const scheduleValid = isScheduleValid();

        const paymentValid = isPaymentValid();

        const valid = patientValid && scheduleValid && paymentValid;

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

    [nameInput, ageInput, phoneInput, genderInput, emailInput].forEach(
        function (input) {
            if (!input) {
                return;
            }

            input.addEventListener("input", function () {
                updatePatientSummary();

                checkServiceBookingForm();
            });

            input.addEventListener("change", function () {
                updatePatientSummary();

                checkServiceBookingForm();
            });
        },
    );

    /*
    |--------------------------------------------------------------------------
    | SCHEDULE SLOT SELECTION
    |--------------------------------------------------------------------------
    */

    function initializeScheduleSlots() {
        document
            .querySelectorAll(".service-date-card")
            .forEach(function (slot) {
                slot.addEventListener("click", function () {
                    /*
                        |--------------------------------------------------------------------------
                        | Do not select occupied slot
                        |--------------------------------------------------------------------------
                        */

                    const occupied =
                        this.dataset.occupied === "true" ||
                        this.classList.contains("occupied");

                    if (occupied) {
                        return;
                    }

                    /*
                        |--------------------------------------------------------------------------
                        | Read slot
                        |--------------------------------------------------------------------------
                        */

                    const date = String(this.dataset.date || "").trim();

                    const time = String(this.dataset.time || "").trim();

                    const scheduleId = String(
                        this.dataset.scheduleId || "",
                    ).trim();

                    if (!date || !time) {
                        return;
                    }

                    /*
                        |--------------------------------------------------------------------------
                        | Friday protection
                        |--------------------------------------------------------------------------
                        */

                    const selectedDate = new Date(date + "T00:00:00");

                    if (
                        !Number.isNaN(selectedDate.getTime()) &&
                        selectedDate.getDay() === 5
                    ) {
                        return;
                    }

                    /*
                        |--------------------------------------------------------------------------
                        | Remove old active slot
                        |--------------------------------------------------------------------------
                        */

                    document
                        .querySelectorAll(".service-date-card.active")
                        .forEach(function (item) {
                            item.classList.remove("active");
                        });

                    /*
                        |--------------------------------------------------------------------------
                        | Activate selected slot
                        |--------------------------------------------------------------------------
                        */

                    this.classList.add("active");

                    /*
                        |--------------------------------------------------------------------------
                        | Update state
                        |--------------------------------------------------------------------------
                        */

                    state.date = date;

                    state.time = time;

                    state.scheduleId = scheduleId;

                    /*
                        |--------------------------------------------------------------------------
                        | Sync everything
                        |--------------------------------------------------------------------------
                        */

                    updateServiceHiddenInputs();

                    updateServiceSummary();

                    checkServiceBookingForm();

                    console.log("[Service Booking] Slot selected:", {
                        id: state.scheduleId,
                        date: state.date,
                        time: state.time,
                    });
                });
            });
    }

    /*
    |--------------------------------------------------------------------------
    | PAYMENT SELECTION
    |--------------------------------------------------------------------------
    */

    function initializePaymentButtons() {
        document
            .querySelectorAll(".service-pay-btn, .service-pay-btn-online")
            .forEach(function (button) {
                button.addEventListener("click", function () {
                    const value = String(this.dataset.value || "").trim();

                    if (!value) {
                        return;
                    }

                    /*
                        |--------------------------------------------------------------------------
                        | Remove previous active
                        |--------------------------------------------------------------------------
                        */

                    document
                        .querySelectorAll(
                            ".service-pay-btn, .service-pay-btn-online",
                        )
                        .forEach(function (item) {
                            item.classList.remove("active");
                        });

                    /*
                        |--------------------------------------------------------------------------
                        | Activate current
                        |--------------------------------------------------------------------------
                        */

                    this.classList.add("active");

                    /*
                        |--------------------------------------------------------------------------
                        | Update state
                        |--------------------------------------------------------------------------
                        */

                    state.payment = value;

                    /*
                        |--------------------------------------------------------------------------
                        | Sync
                        |--------------------------------------------------------------------------
                        */

                    updateServiceHiddenInputs();

                    updatePaymentSummary();

                    checkServiceBookingForm();

                    console.log(
                        "[Service Booking] Payment selected:",
                        state.payment,
                    );
                });
            });
    }

    /*
    |--------------------------------------------------------------------------
    | SCHEDULE PAGINATION
    |--------------------------------------------------------------------------
    */

    function initializeSchedulePagination() {
        const pages = document.querySelectorAll(".service-schedule-page");

        const previousButton = getElement("prevServiceSchedule");

        const nextButton = getElement("nextServiceSchedule");

        let currentPage = 0;

        function showSchedulePage(page) {
            if (!pages.length) {
                return;
            }

            if (page < 0) {
                page = 0;
            }

            if (page >= pages.length) {
                page = pages.length - 1;
            }

            currentPage = page;

            pages.forEach(function (item, index) {
                item.classList.toggle("active", index === currentPage);
            });

            if (previousButton) {
                previousButton.disabled = currentPage === 0;
            }

            if (nextButton) {
                nextButton.disabled = currentPage === pages.length - 1;
            }
        }

        if (previousButton) {
            previousButton.addEventListener("click", function () {
                showSchedulePage(currentPage - 1);
            });
        }

        if (nextButton) {
            nextButton.addEventListener("click", function () {
                showSchedulePage(currentPage + 1);
            });
        }

        showSchedulePage(0);
    }

    /*
    |--------------------------------------------------------------------------
    | RESTORE OLD FORM VALUES
    |--------------------------------------------------------------------------
    */

    function restoreOldValues() {
        const oldDate = hiddenDate ? String(hiddenDate.value || "").trim() : "";

        const oldTime = hiddenTime ? String(hiddenTime.value || "").trim() : "";

        const oldPayment = hiddenPayment
            ? String(hiddenPayment.value || "").trim()
            : "";

        /*
        |--------------------------------------------------------------------------
        | Restore date/time
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
                    /*
                    | Remove other active slots
                    */

                    slots.forEach(function (item) {
                        item.classList.remove("active");
                    });

                    slot.classList.add("active");

                    state.date = oldDate;

                    state.time = oldTime;

                    state.scheduleId = slot.dataset.scheduleId || "";

                    return;
                }
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Restore payment
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

    if (form) {
        form.addEventListener("submit", function (event) {
            /*
                |--------------------------------------------------------------------------
                | Sync everything before validation
                |--------------------------------------------------------------------------
                */

            updateServiceHiddenInputs();

            updateServiceSummary();

            /*
                |--------------------------------------------------------------------------
                | Validate
                |--------------------------------------------------------------------------
                */

            if (!checkServiceBookingForm()) {
                event.preventDefault();

                const missing = [];

                if (!getInputValue(nameInput)) {
                    missing.push("Name");
                }

                if (!getInputValue(phoneInput)) {
                    missing.push("Mobile Number");
                }

                if (!getInputValue(ageInput)) {
                    missing.push("Age");
                }

                if (!getInputValue(genderInput)) {
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
                | Final sync
                |--------------------------------------------------------------------------
                */

            updateServiceHiddenInputs();

            console.log("[Service Booking] Submitting:", {
                service_id:
                    form.querySelector('[name="service_id"]')?.value || "",

                schedule_id: state.scheduleId || "",

                date: state.date || "",

                time: state.time || "",

                payment: state.payment || "",
            });
        });
    }

    /*
    |--------------------------------------------------------------------------
    | INITIALIZE EVERYTHING
    |--------------------------------------------------------------------------
    */

    restoreOldValues();

    initializeScheduleSlots();

    initializePaymentButtons();

    initializeSchedulePagination();

    updateServiceHiddenInputs();

    updateServiceSummary();

    checkServiceBookingForm();

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
