// ==========================================================
// SERVICE BOOKING - SCHEDULE
// ==========================================================

(function () {
    "use strict";

    window.ServiceBookingSchedule = window.ServiceBookingSchedule || {};

    function initialize() {
        initializeScheduleSlots();
        initializeSchedulePagination();
    }

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
                    | DO NOT SELECT OCCUPIED SLOT
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
                    | READ SLOT
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
                    | FRIDAY PROTECTION
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
                    | REMOVE OLD ACTIVE SLOT
                    |--------------------------------------------------------------------------
                    */

                    document
                        .querySelectorAll(".service-date-card.active")
                        .forEach(function (item) {
                            item.classList.remove("active");
                        });

                    /*
                    |--------------------------------------------------------------------------
                    | ACTIVATE SELECTED SLOT
                    |--------------------------------------------------------------------------
                    */

                    this.classList.add("active");

                    /*
                    |--------------------------------------------------------------------------
                    | UPDATE STATE
                    |--------------------------------------------------------------------------
                    */

                    const state = window.ServiceBooking.state;

                    state.date = date;
                    state.time = time;
                    state.scheduleId = scheduleId;

                    /*
                    |--------------------------------------------------------------------------
                    | SYNC
                    |--------------------------------------------------------------------------
                    */

                    window.ServiceBookingSummary.updateHiddenInputs();

                    window.ServiceBookingSummary.updateScheduleSummary();

                    window.ServiceBookingForm.checkBookingForm();

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
    | SCHEDULE PAGINATION
    |--------------------------------------------------------------------------
    */

    function initializeSchedulePagination() {
        const pages = document.querySelectorAll(".service-schedule-page");

        const previousButton = window.ServiceBooking.getElement(
            "prevServiceSchedule",
        );

        const nextButton = window.ServiceBooking.getElement(
            "nextServiceSchedule",
        );

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
    | EXPORT
    |--------------------------------------------------------------------------
    */

    window.ServiceBookingSchedule.initialize = initialize;
})();
