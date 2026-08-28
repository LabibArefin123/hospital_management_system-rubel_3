/**
 * ==========================================================
 * SYSTEM SEARCH RENDERER
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
        /* =====================================================
           APPOINTMENTS
        ===================================================== */

        const appointments = Array.isArray(response.appointments)
            ? response.appointments
            : [];

        /* =====================================================
           DOCTORS
        ===================================================== */

        const doctors = Array.isArray(response.doctors) ? response.doctors : [];

        /* =====================================================
           NORMALIZE RESULTS
        ===================================================== */

        const results = [
            /* -------------------------------------------------
               APPOINTMENT RESULTS
            ------------------------------------------------- */

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

            /* -------------------------------------------------
               DOCTOR RESULTS
            ------------------------------------------------- */

            ...doctors.map(function (item) {
                return {
                    name: item.name || "-",

                    qualification: item.qualification || "",

                    speciality: item.speciality || "",

                    experience_years:
                        item.experience_years !== null &&
                        item.experience_years !== undefined
                            ? item.experience_years
                            : null,

                    location: item.location || "",

                    type: "doctor",

                    status: null,

                    date: null,

                    time: null,

                    url: item.url || null,
                };
            }),
        ];

        /* =====================================================
           DEBUG
        ===================================================== */

        console.log("[System Search] STATE 9: Rendering results.", {
            appointments: appointments.length,
            doctors: doctors.length,
            total: results.length,
        });

        /* =====================================================
           EMPTY RESULTS
        ===================================================== */

        if (!results.length) {
            console.log("[System Search] STATE 9: No results found.");

            window.SystemSearch.showEmpty(input);

            return;
        }

        /* =====================================================
           RENDER PAGE RESULTS
        ===================================================== */

        window.SystemSearch.renderPageResults(results);

        /* =====================================================
           RENDER GLOBAL SEARCH RESULTS
        ===================================================== */

        window.SystemSearch.renderGlobalResults(results);

        /* =====================================================
           SUCCESS
        ===================================================== */

        console.log("[System Search] STATE 9: Results rendered successfully.");
    };
})(window, jQuery);
