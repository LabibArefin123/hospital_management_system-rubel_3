/**
 * ==========================================================
 * SUSTHOCARE SYSTEM SEARCH
 * ==========================================================
 *
 * Global search
 *
 * Searches:
 * - Users / Patients
 * - Doctors
 *
 * Result data:
 * - Name only
 */

(function ($) {
    "use strict";

    window.SystemSearch = {
        timer: null,

        delay: 300,

        /*
        |--------------------------------------------------------------------------
        | INITIALIZE
        |--------------------------------------------------------------------------
        */

        init: function () {
            this.bindEvents();
        },

        /*
        |--------------------------------------------------------------------------
        | EVENTS
        |--------------------------------------------------------------------------
        */

        bindEvents: function () {
            const self = this;

            /*
            |--------------------------------------------------------------------------
            | GLOBAL SEARCH INPUT
            |--------------------------------------------------------------------------
            */

            $(document).on(
                "input",
                "#systemSearchInput, #systemSearchPageInput",
                function () {
                    const input = $(this);

                    const search = $.trim(input.val());

                    clearTimeout(self.timer);

                    self.timer = setTimeout(function () {
                        self.search(search, input);
                    }, self.delay);
                },
            );

            /*
            |--------------------------------------------------------------------------
            | CLEAR BUTTON
            |--------------------------------------------------------------------------
            */

            $(document).on(
                "click",
                "#systemSearchClear, #systemSearchPageClear",
                function () {
                    const input = $("#systemSearchPageInput").length
                        ? $("#systemSearchPageInput")
                        : $("#systemSearchInput");

                    input.val("").trigger("input");

                    self.clear();
                },
            );

            /*
            |--------------------------------------------------------------------------
            | ESCAPE
            |--------------------------------------------------------------------------
            */

            $(document).on("keydown", function (event) {
                if (event.key === "Escape") {
                    self.clear();
                }
            });
        },

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        search: function (search, input) {
            if (!search) {
                this.clear();

                return;
            }

            this.showLoading(input);

            $.ajax({
                url: window.systemSearchUrl,

                method: "GET",

                data: {
                    search: search,
                },

                dataType: "json",

                success: function (response) {
                    if (!response || response.status !== true) {
                        SystemSearch.showEmpty(input);

                        return;
                    }

                    SystemSearch.render(response, input);
                },

                error: function () {
                    SystemSearch.showEmpty(input);
                },

                complete: function () {
                    SystemSearch.hideLoading(input);
                },
            });
        },

        /*
        |--------------------------------------------------------------------------
        | RENDER
        |--------------------------------------------------------------------------
        */

        render: function (response, input) {
            const users = Array.isArray(response.users) ? response.users : [];

            const doctors = Array.isArray(response.doctors)
                ? response.doctors
                : [];

            const results = [...users, ...doctors];

            /*
            |--------------------------------------------------------------------------
            | SEARCH PAGE
            |--------------------------------------------------------------------------
            */

            const pageResults = $("#systemSearchPageResults");

            if (pageResults.length) {
                pageResults.empty();

                if (!results.length) {
                    this.showEmpty(input);

                    return;
                }

                results.forEach(function (item) {
                    pageResults.append(`
                        <div class="system-search-result-item">
                            <span class="system-search-result-name">
                                ${SystemSearch.escape(item.name)}
                            </span>
                        </div>
                    `);
                });

                pageResults.removeClass("d-none");

                $("#searchPageEmpty").addClass("d-none");
            }

            /*
            |--------------------------------------------------------------------------
            | GLOBAL HEADER SEARCH
            |--------------------------------------------------------------------------
            */

            const globalResults = $("#systemSearchResults");

            if (globalResults.length) {
                globalResults.empty();

                if (!results.length) {
                    globalResults.html(`
                        <div class="system-search-empty">
                            No result found
                        </div>
                    `);

                    globalResults.removeClass("d-none");

                    return;
                }

                results.forEach(function (item) {
                    globalResults.append(`
                        <div class="system-search-result-item">
                            <span class="system-search-result-name">
                                ${SystemSearch.escape(item.name)}
                            </span>
                        </div>
                    `);
                });

                globalResults.removeClass("d-none");
            }
        },

        /*
        |--------------------------------------------------------------------------
        | LOADING
        |--------------------------------------------------------------------------
        */

        showLoading: function (input) {
            $("#searchPageLoading").removeClass("d-none");

            $("#systemSearchLoading").removeClass("d-none");
        },

        hideLoading: function (input) {
            $("#searchPageLoading").addClass("d-none");

            $("#systemSearchLoading").addClass("d-none");
        },

        /*
        |--------------------------------------------------------------------------
        | EMPTY
        |--------------------------------------------------------------------------
        */

        showEmpty: function (input) {
            $("#searchPageEmpty").removeClass("d-none");

            $("#systemSearchResults").removeClass("d-none").html(`
                    <div class="system-search-empty">
                        No result found
                    </div>
                `);

            $("#systemSearchPageResults").addClass("d-none");
        },

        /*
        |--------------------------------------------------------------------------
        | CLEAR
        |--------------------------------------------------------------------------
        */

        clear: function () {
            clearTimeout(this.timer);

            $("#systemSearchResults").empty().addClass("d-none");

            $("#systemSearchPageResults").empty().addClass("d-none");

            $("#searchPageLoading").addClass("d-none");

            $("#systemSearchLoading").addClass("d-none");

            $("#searchPageEmpty").addClass("d-none");
        },

        /*
        |--------------------------------------------------------------------------
        | ESCAPE HTML
        |--------------------------------------------------------------------------
        */

        escape: function (value) {
            return $("<div>")
                .text(value || "")
                .html();
        },
    };
})(jQuery);
