/*SYSTEM SEARCH RENDERER - DOCTORS */
(function (window, $) {
    "use strict";
    console.log("[System Search] STATE 4C: Doctor renderer module loaded.");

    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 4C ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    /* NORMALIZE DOCTORS  */
    window.SystemSearch.normalizeDoctors = function (doctors) {
        if (!Array.isArray(doctors)) {
            return [];
        }

        return doctors.map(function (item) {
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
        });
    };
})(window, jQuery);
