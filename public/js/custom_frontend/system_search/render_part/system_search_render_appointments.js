/** SYSTEM SEARCH RENDERER - APPOINTMENTS */
(function (window, $) {
    "use strict";

    console.log(
        "[System Search] STATE 4D: Appointment renderer module loaded.",
    );

    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 4D ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    /* NORMALIZE APPOINTMENTS */
    window.SystemSearch.normalizeAppointments = function (appointments) {
        if (!Array.isArray(appointments)) {
            console.warn(
                "[System Search] STATE 4D WARNING: Invalid appointments data.",
            );
            return [];
        }

        return appointments.map(function (item) {
            return {
                id: item.id || null,
                name: item.name || "-",
                phone: item.phone || "",
                email: item.email || "",
                type: "appointment",
                status: item.status || "pending",
                date: item.date || "-",
                time: item.time || "-",
                image: item.image || window.SystemSearch.defaultImage,
                url: item.url || null,
            };
        });
    };
})(window, jQuery);
