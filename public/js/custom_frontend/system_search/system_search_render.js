/**
 * ==========================================================
 * SUSTHOCARE SYSTEM SEARCH RENDERER
 * ==========================================================
 */
(function (window, $) {
    "use strict";
    console.log("[System Search] STATE 4: Renderer module loaded.");
    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 4 ERROR: SystemSearch core not loaded.",
        );
        return;
    }
    window.SystemSearch.render = function (response, input) {
        const appointments = Array.isArray(response.appointments)
            ? response.appointments
            : [];
        const doctors = Array.isArray(response.doctors) ? response.doctors : [];
        const results = [
            ...appointments.map(function (item) {
                return {
                    name: item.name || "-",
                    type: "appointment",
                    status: item.status || "pending",
                    date: item.date || "-",
                    time: item.time || "-",
                    url: null,
                };
            }),
            ...doctors.map(function (item) {
                return {
                    name: item.name || "-",
                    type: "doctor",
                    status: null,
                    date: null,
                    time: null,
                    url: item.url || null,
                };
            }),
        ];
        console.log("[System Search] STATE 9: Rendering results.", {
            appointments: appointments.length,
            doctors: doctors.length,
            total: results.length,
        });
        if (!results.length) {
            console.log("[System Search] STATE 9: No results found.");
            window.SystemSearch.showEmpty(input);
            return;
        }
        window.SystemSearch.renderPageResults(results);
        window.SystemSearch.renderGlobalResults(results);
        console.log("[System Search] STATE 9: Results rendered successfully.");
    };
})(window, jQuery);
