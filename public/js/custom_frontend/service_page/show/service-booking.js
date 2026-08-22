// ==================================================
// SERVICE BOOKING SCRIPT
// ==================================================

document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    const state = window.ServiceBookingState;

    if (!state) {
        console.error("[Service Booking] ServiceBookingState is not loaded.");

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | PATIENT INPUTS
    |--------------------------------------------------------------------------
    */

    const patientInputs = [
        "serviceName",
        "servicePhone",
        "serviceAge",
        "serviceGender",
        "serviceEmail",
    ];

    patientInputs.forEach(function (id) {
        const input = document.getElementById(id);

        if (!input) {
            return;
        }

        input.addEventListener("input", function () {
            updateServiceSummary();
            checkServiceBookingForm();
        });

        input.addEventListener("change", function () {
            updateServiceSummary();
            checkServiceBookingForm();
        });
    });

    /*
    |--------------------------------------------------------------------------
    | SCHEDULE SLOT SELECTION
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll(".service-date-card").forEach(function (slot) {
        slot.addEventListener("click", function () {
            const occupied =
                this.dataset.occupied === "true" ||
                this.classList.contains("occupied");

            if (occupied) {
                return;
            }

            const date = this.dataset.date;
            const time = this.dataset.time;

            if (!date || !time) {
                return;
            }

            /*
                |--------------------------------------------------------------------------
                | Prevent Friday selection
                |--------------------------------------------------------------------------
                */

            const selectedDate = new Date(date + "T00:00:00");

            if (selectedDate.getDay() === 5) {
                return;
            }

            /*
                |--------------------------------------------------------------------------
                | Remove previous selection
                |--------------------------------------------------------------------------
                */

            document
                .querySelectorAll(".service-date-card")
                .forEach(function (item) {
                    item.classList.remove("active");
                });

            /*
                |--------------------------------------------------------------------------
                | Select current slot
                |--------------------------------------------------------------------------
                */

            this.classList.add("active");

            state.date = date;
            state.time = time;

            updateServiceHiddenInputs();
            updateServiceSummary();
            checkServiceBookingForm();

            console.log("[Service Booking] Slot selected:", {
                date: state.date,
                time: state.time,
            });
        });
    });

    /*
    |--------------------------------------------------------------------------
    | PAYMENT SELECTION
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(".service-pay-btn, .service-pay-btn-online")
        .forEach(function (button) {
            button.addEventListener("click", function () {
                const value = this.dataset.value;

                if (!value) {
                    return;
                }

                document
                    .querySelectorAll(
                        ".service-pay-btn, .service-pay-btn-online",
                    )
                    .forEach(function (item) {
                        item.classList.remove("active");
                    });

                this.classList.add("active");

                state.payment = value;

                updateServiceHiddenInputs();
                updateServiceSummary();
                checkServiceBookingForm();

                console.log(
                    "[Service Booking] Payment selected:",
                    state.payment,
                );
            });
        });

    /*
    |--------------------------------------------------------------------------
    | SCHEDULE PAGINATION
    |--------------------------------------------------------------------------
    */

    const pages = document.querySelectorAll(".service-schedule-page");

    const previousButton = document.getElementById("prevServiceSchedule");

    const nextButton = document.getElementById("nextServiceSchedule");

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

    /*
    |--------------------------------------------------------------------------
    | RESTORE OLD INPUT / VALIDATION STATE
    |--------------------------------------------------------------------------
    */

    const oldDate = document.getElementById("serviceFormDate")?.value;

    const oldTime = document.getElementById("serviceFormTime")?.value;

    const oldPayment = document.getElementById("servicePaymentMethod")?.value;

    if (oldDate && oldTime) {
        const oldSlot = document.querySelector(
            `.service-date-card[data-date="${oldDate}"][data-time="${oldTime}"]`,
        );

        if (oldSlot && oldSlot.dataset.occupied !== "true") {
            oldSlot.classList.add("active");

            state.date = oldDate;
            state.time = oldTime;
        }
    }

    if (oldPayment) {
        const oldPaymentButton = document.querySelector(
            `.service-pay-btn[data-value="${oldPayment}"], .service-pay-btn-online[data-value="${oldPayment}"]`,
        );

        if (oldPaymentButton) {
            oldPaymentButton.classList.add("active");
            state.payment = oldPayment;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | FORM SUBMIT
    |--------------------------------------------------------------------------
    */

    const form = document.getElementById("serviceAppointmentForm");

    if (form) {
        form.addEventListener("submit", function (event) {
            updateServiceHiddenInputs();

            if (!checkServiceBookingForm()) {
                event.preventDefault();

                let missing = [];

                if (!document.getElementById("serviceName")?.value.trim()) {
                    missing.push("Name");
                }

                if (!document.getElementById("servicePhone")?.value.trim()) {
                    missing.push("Mobile Number");
                }

                if (!document.getElementById("serviceAge")?.value) {
                    missing.push("Age");
                }

                if (!document.getElementById("serviceGender")?.value) {
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

                return false;
            }

            /*
            |--------------------------------------------------------------------------
            | Final hidden input sync
            |--------------------------------------------------------------------------
            */

            updateServiceHiddenInputs();

            console.log("[Service Booking] Submitting:", {
                service_id: form.querySelector('[name="service_id"]')?.value,

                date: document.getElementById("serviceFormDate")?.value,

                time: document.getElementById("serviceFormTime")?.value,

                payment: document.getElementById("servicePaymentMethod")?.value,
            });
        });
    }

    /*
    |--------------------------------------------------------------------------
    | INITIALIZE
    |--------------------------------------------------------------------------
    */

    updateServiceHiddenInputs();
    updateServiceSummary();
    checkServiceBookingForm();

    console.log("[Service Booking] Initialized successfully.");
});
