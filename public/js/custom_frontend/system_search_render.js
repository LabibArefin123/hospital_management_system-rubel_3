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

    /*
    |--------------------------------------------------------------------------
    | MAIN RENDER
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | STATUS CLASS
    |--------------------------------------------------------------------------
    */

    window.SystemSearch.getStatusClass = function (status) {
        status = (status || "pending").toLowerCase();

        if (status === "confirmed") {
            return "confirmed";
        }

        if (status === "cancelled") {
            return "cancelled";
        }

        return "pending";
    };

    /*
    |--------------------------------------------------------------------------
    | STATUS LABEL
    |--------------------------------------------------------------------------
    */

    window.SystemSearch.getStatusLabel = function (status) {
        status = (status || "pending").toLowerCase();

        if (status === "confirmed") {
            return "Confirmed";
        }

        if (status === "cancelled") {
            return "Cancelled";
        }

        return "Pending";
    };

    /*
    |--------------------------------------------------------------------------
    | CREATE RESULT HTML
    |--------------------------------------------------------------------------
    */

    window.SystemSearch.createResultHtml = function (item) {
        const name = window.SystemSearch.escape(item.name || "-");

        /*
        |----------------------------------------------------------------------
        | DOCTOR RESULT
        |----------------------------------------------------------------------
        */

        if (item.type === "doctor") {
            return `
                <a
                    href="${window.SystemSearch.escapeAttribute(item.url || "#")}"
                    class="system-search-result-item"
                    data-result-type="doctor"
                >
                    <span class="system-search-result-content">

                        <span class="system-search-result-name">
                            ${name}
                        </span>

                        <span class="system-search-result-type">
                            Doctor
                        </span>

                    </span>

                    <i class="fas fa-chevron-right system-search-result-arrow"></i>

                </a>
            `;
        }

        /*
        |----------------------------------------------------------------------
        | APPOINTMENT RESULT
        |----------------------------------------------------------------------
        */

        const statusClass = window.SystemSearch.getStatusClass(item.status);

        const statusLabel = window.SystemSearch.getStatusLabel(item.status);

        const date = window.SystemSearch.escape(item.date || "-");

        const time = window.SystemSearch.escape(item.time || "-");

        return `
            <div
                class="system-search-result-item"
                data-result-type="appointment"
            >
                <span class="system-search-result-content">

                    <span class="system-search-result-name">
                        ${name}
                    </span>

                    <span class="system-search-result-type">
                        Appointment
                    </span>

                    <span class="system-search-result-meta">

                        <span class="system-search-result-date">
                            <i class="far fa-calendar-alt"></i>
                            ${date}
                        </span>

                        <span class="system-search-result-time">
                            <i class="far fa-clock"></i>
                            ${time}
                        </span>

                        <span
                            class="system-search-result-status ${statusClass}"
                        >
                            ${statusLabel}
                        </span>

                    </span>

                </span>
            </div>
        `;
    };

    /*
    |--------------------------------------------------------------------------
    | PAGE RESULTS
    |--------------------------------------------------------------------------
    */

    window.SystemSearch.renderPageResults = function (results) {
        const container = $("#systemSearchPageResults");

        if (!container.length) {
            console.log(
                "[System Search] STATE 9: Dedicated search page not present.",
            );

            return;
        }

        container.empty();

        results.forEach(function (item) {
            container.append(window.SystemSearch.createResultHtml(item));
        });

        container.removeClass("d-none");

        $("#searchPageEmpty").addClass("d-none");

        console.log("[System Search] STATE 9: Search page results rendered.");
    };

    /*
    |--------------------------------------------------------------------------
    | GLOBAL RESULTS
    |--------------------------------------------------------------------------
    */

    window.SystemSearch.renderGlobalResults = function (results) {
        const container = $("#systemSearchResults");

        if (!container.length) {
            console.log(
                "[System Search] STATE 9: Global result container not present.",
            );

            return;
        }

        container.empty();

        results.forEach(function (item) {
            container.append(window.SystemSearch.createResultHtml(item));
        });

        container.removeClass("d-none");

        console.log("[System Search] STATE 9: Global search results rendered.");
    };
})(window, jQuery);
