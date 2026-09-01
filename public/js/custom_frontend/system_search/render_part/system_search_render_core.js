/** SYSTEM SEARCH RENDERER - CORE*/
(function (window, $) {
    "use strict";
    console.log("[System Search] STATE 5: Renderer core module loaded.");

    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 4A ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    /*MAIN RENDER*/
    window.SystemSearch.render = function (response, input) {
        response = response || {};

        /*NORMALIZE APPOINTMENTS */
        const appointments = window.SystemSearch.normalizeAppointments(
            response.appointments,
        );

        /* NORMALIZE DOCTORS */
        const doctors = window.SystemSearch.normalizeDoctors(response.doctors);

        /*COMBINE RESULTS */
        const results = [...appointments, ...doctors];

        /* DEBUG */
        console.log("[System Search] STATE 10: Rendering results.", {
            appointments: appointments.length,
            doctors: doctors.length,
            total: results.length,
        });

        /*EMPTY RESULTS */
        if (!results.length) {
            console.log("[System Search] STATE 10: No results found.");
            window.SystemSearch.showEmpty(input);
            return;
        }

        /*PAGE RESULTS */
        window.SystemSearch.renderPageResults(results);

        /* GLOBAL RESULTS */
        window.SystemSearch.renderGlobalResults(results);

        /* SUCCESS */
        console.log("[System Search] STATE 10: Results rendered successfully.");
    };
})(window, jQuery);
