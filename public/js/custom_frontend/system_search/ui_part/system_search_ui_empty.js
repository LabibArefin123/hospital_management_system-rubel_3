/** SYSTEM SEARCH UI - EMPTY*/
(function (window, $) {
    "use strict";

    console.log("[System Search] STATE 5B: UI empty module loaded.");

    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 5B ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW EMPTY
    |--------------------------------------------------------------------------
    */

    window.SystemSearch.showEmpty = function () {
        console.log("[System Search] STATE 9: Showing empty result.");

        $("#searchPageEmpty").removeClass("d-none");

        $("#systemSearchPageResults").empty().addClass("d-none");

        const globalResults = $("#systemSearchResults");

        if (globalResults.length) {
            globalResults.removeClass("d-none").html(`
                    <div class="system-search-empty">
                        No result found
                    </div>
                `);
        }
    };
})(window, jQuery);
