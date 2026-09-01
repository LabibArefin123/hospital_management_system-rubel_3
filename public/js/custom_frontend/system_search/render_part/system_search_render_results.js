/**SYSTEM SEARCH RENDERER - RESULTS*/
(function (window, $) {
    "use strict";
    console.log("[System Search] STATE 4F: Result renderer module loaded.");
    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 4D ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    /* BUILD RESULTS  */
    window.SystemSearch.buildResults = function (appointments, doctors) {
        const normalizedAppointments = Array.isArray(appointments)
            ? appointments
            : [];

        const normalizedDoctors = Array.isArray(doctors) ? doctors : [];
        return [...normalizedAppointments, ...normalizedDoctors];
    };
})(window, jQuery);
