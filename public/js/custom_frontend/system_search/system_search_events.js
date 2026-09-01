/**
 * ==========================================================
 * SUSTHOCARE SYSTEM SEARCH EVENTS
 * ==========================================================
 */

(function (window, $) {
    "use strict";

    console.log("[System Search] STATE 2: Event module loaded.");

    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 2 ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    window.SystemSearch.bindEvents = function () {
        console.log("[System Search] STATE 2: Binding global search events.");

        $(document).on(
            "input",
            "#systemSearchInput,#systemSearchPageInput",
            function () {
                const input = $(this);
                const search = $.trim(input.val());

                clearTimeout(window.SystemSearch.timer);

                console.log(
                    "[System Search] STATE 8: Search input changed:",
                    search,
                );

                window.SystemSearch.timer = setTimeout(function () {
                    window.SystemSearch.search(search, input);
                }, window.SystemSearch.delay);
            },
        );

        $(document).on(
            "click",
            "#systemSearchClear,#systemSearchPageClear",
            function () {
                console.log("[System Search] STATE 13: Clear button clicked.");

                const input = $("#systemSearchPageInput").length
                    ? $("#systemSearchPageInput")
                    : $("#systemSearchInput");

                input.val("");

                window.SystemSearch.clear();
            },
        );

        $(document).on("keydown", function (event) {
            if (event.key === "Escape") {
                console.log("[System Search] STATE 13: Escape pressed.");
                window.SystemSearch.clear();
            }
        });

        console.log("[System Search] STATE 2: Events successfully bound.");
    };
})(window, jQuery);
