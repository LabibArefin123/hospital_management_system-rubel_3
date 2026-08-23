// ==========================================================
// SERVICE BOOKING - PAYMENT
// ==========================================================

(function () {
    "use strict";

    window.ServiceBookingPayment = window.ServiceBookingPayment || {};

    function initialize() {
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
                        | REMOVE PREVIOUS ACTIVE
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
                        | ACTIVATE CURRENT
                        |--------------------------------------------------------------------------
                        */

                    this.classList.add("active");

                    /*
                        |--------------------------------------------------------------------------
                        | UPDATE STATE
                        |--------------------------------------------------------------------------
                        */

                    const state = window.ServiceBooking.state;

                    state.payment = value;

                    /*
                        |--------------------------------------------------------------------------
                        | SYNC
                        |--------------------------------------------------------------------------
                        */

                    window.ServiceBookingSummary.updateHiddenInputs();

                    window.ServiceBookingSummary.updatePaymentSummary();

                    window.ServiceBookingForm.checkBookingForm();

                    console.log(
                        "[Service Booking] Payment selected:",
                        state.payment,
                    );
                });
            });
    }

    window.ServiceBookingPayment.initialize = initialize;
})();
