/* SYSTEM SEARCH RESULT ITEM */
(function (window, $) {
    "use strict";
    console.log("[System Search] STATE 4B: Item renderer module loaded.");
    if (!window.SystemSearch) {
        console.error(
            "[System Search] ITEM ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    window.SystemSearch.createResultHtml = function (item) {
        const name = window.SystemSearch.escape(item.name || "-");

        /* DOCTOR RESULT */
        if (item.type === "doctor") {
            const qualification = window.SystemSearch.escape(
                item.qualification || "",
            );

            const speciality = window.SystemSearch.escape(
                item.speciality || "",
            );

            const experience = window.SystemSearch.escape(
                item.experience_years
                    ? `${item.experience_years} Years Experience`
                    : "",
            );

            const location = window.SystemSearch.escape(item.location || "");

            return `
                <a href="${window.SystemSearch.escapeAttribute(
                    item.url || "#",
                )}"
                    class="system-search-result-item"
                    data-result-type="doctor">
                    <span class="system-search-result-content">
                        ${
                            qualification
                                ? `
                                    <span class="system-search-result-qualification">
                                        ${qualification}
                                    </span>
                                `
                                : ""
                        }

                        <span class="system-search-result-name">${name}</span>
                        <span class="system-search-result-type">Doctor </span>
                        ${
                            speciality || experience || location
                                ? `
                                    <span class="system-search-result-meta">
                                        ${
                                            speciality
                                                ? `
                                                    <span class="system-search-result-speciality">
                                                        <i class="fas fa-stethoscope"></i>
                                                        ${speciality}
                                                    </span>
                                                `
                                                : ""
                                        }

                                        ${
                                            experience
                                                ? `
                                                    <span class="system-search-result-experience">
                                                        <i class="fas fa-briefcase"></i>
                                                        ${experience}
                                                    </span>
                                                `
                                                : ""
                                        }

                                        ${
                                            location
                                                ? `
                                                    <span class="system-search-result-location">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        ${location}
                                                    </span>
                                                `
                                                : ""
                                        }

                                    </span>
                                `
                                : ""
                        }

                    </span>
                    <i class="fas fa-chevron-right system-search-result-arrow"></i>
                </a>
            `;
        }

        /* APPOINTMENT RESULT */
        const statusClass = window.SystemSearch.getStatusClass(item.status);
        const statusLabel = window.SystemSearch.getStatusLabel(item.status);
        const date = window.SystemSearch.escape(item.date || "-");
        const time = window.SystemSearch.escape(item.time || "-");

        return `
            <div
                class="system-search-result-item"
                data-result-type="appointment">

                <span class="system-search-result-content">
                    <span class="system-search-result-name">${name}</span>
                    <span class="system-search-result-type">Appointment</span>
                    <span class="system-search-result-meta">

                        <span class="system-search-result-date">
                            <i class="far fa-calendar-alt"></i>
                            ${date}
                        </span>

                        <span class="system-search-result-time">
                            <i class="far fa-clock"></i>
                            ${time}
                        </span>

                        <span class="system-search-result-status ${statusClass}">
                            ${statusLabel}
                        </span>
                    </span>
                </span>
            </div>
        `;
    };
})(window, jQuery);
