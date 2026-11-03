/** SYSTEM SEARCH RENDERER - RESULTS */
(function (window, $) {
    "use strict";

    console.log("[System Search] STATE 4F: Result renderer module loaded.");

    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 4D ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    /* BUILD RESULTS */
    window.SystemSearch.buildResults = function (
        appointments,
        doctors,
        contacts,
    ) {
        const normalizedAppointments = Array.isArray(appointments)
            ? appointments
            : [];

        const normalizedDoctors = Array.isArray(doctors) ? doctors : [];

        const normalizedContacts = Array.isArray(contacts) ? contacts : [];

        const results = [
            ...normalizedAppointments,
            ...normalizedDoctors,
            ...normalizedContacts,
        ];

        /* DEBUG */
        console.log("[System Search] STATE 4F: Results combined.", {
            appointments: normalizedAppointments.length,
            doctors: normalizedDoctors.length,
            contacts: normalizedContacts.length,
            total: results.length,
        });

        return results;
    };
})(window, jQuery);
