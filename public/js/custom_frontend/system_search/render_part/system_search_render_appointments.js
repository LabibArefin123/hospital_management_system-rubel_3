/** SYSTEM SEARCH RENDERER - APPOINTMENTS*/
(function (window, $) {
    "use strict";
    console.log(
        "[System Search] STATE 4B: Appointment renderer module loaded.",
    );

    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 4B ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    /* NORMALIZE APPOINTMENTS */
    window.SystemSearch.normalizeAppointments = function (appointments) {
        if (!Array.isArray(appointments)) {
            return [];
        }

        return appointments.map(function (item) {
            return {
                name: item.name || "-",
                type: "appointment",
                status: item.status || "pending",
                date: item.date || "-",
                time: item.time || "-",
                url: null,
            };
        });
    };
})(window, jQuery);
