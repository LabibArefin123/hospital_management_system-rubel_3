/* SYSTEM SEARCH RENDERER - DOCTORS */
(function (window, $) {
    "use strict";
    console.log("[System Search] STATE 4E: Doctor renderer module loaded.");

    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 4E ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    /*NORMALIZE DOCTORS */
    window.SystemSearch.normalizeDoctors = function (doctors) {
        if (!Array.isArray(doctors)) {
            return [];
        }

        return doctors.map(function (item) {
            return {
                id: item.id || null,
                name: item.name || "-",
                email: item.email || "",
                speciality: item.speciality || "",
                image: item.image || window.SystemSearch.defaultImage,
                success_rate:
                    item.success_rate !== null &&
                    item.success_rate !== undefined &&
                    item.success_rate !== ""
                        ? item.success_rate
                        : null,

                experience_years:
                    item.experience_years !== null &&
                    item.experience_years !== undefined &&
                    item.experience_years !== ""
                        ? item.experience_years
                        : null,

                total_patients:
                    item.total_patients !== null &&
                    item.total_patients !== undefined &&
                    item.total_patients !== ""
                        ? item.total_patients
                        : null,

                qualification: item.qualification || "",
                location: item.location || "",

                consultation_fee:
                    item.consultation_fee !== null &&
                    item.consultation_fee !== undefined &&
                    item.consultation_fee !== ""
                        ? item.consultation_fee
                        : null,

                availability: item.availability || "",
                about: item.about || "",
                type: "doctor",
                status: null,
                date: null,
                time: null,
                url: item.url || null,
            };
        });
    };
})(window, jQuery);
