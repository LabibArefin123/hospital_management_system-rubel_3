import { initFilterToggle } from "./filter-toggle.js";
import { initAppointmentFilter } from "./appointment-filter.js";
import { initFilterReset } from "./filter-reset.js";

document.addEventListener("DOMContentLoaded", function () {
    initFilterToggle();
    const filterAppointments = initAppointmentFilter();
    initFilterReset(filterAppointments);
    filterAppointments();
});
