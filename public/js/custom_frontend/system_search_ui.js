/**
 * ==========================================================
 * SUSTHOCARE SYSTEM SEARCH UI
 * ==========================================================
 */

(function (window, $) {
    "use strict";

    console.log("[System Search] STATE 5: UI module loaded.");

    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 5 ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | LOADING
    |--------------------------------------------------------------------------
    */

    window.SystemSearch.showLoading = function () {
        console.log("[System Search] STATE 7: Showing loading.");

        $("#searchPageLoading").removeClass("d-none");

        $("#systemSearchLoading").removeClass("d-none");
    };

    window.SystemSearch.hideLoading = function () {
        $("#searchPageLoading").addClass("d-none");

        $("#systemSearchLoading").addClass("d-none");
    };

    /*
    |--------------------------------------------------------------------------
    | EMPTY
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

    /*
    |--------------------------------------------------------------------------
    | CLEAR
    |--------------------------------------------------------------------------
    */

    window.SystemSearch.clear = function () {
        clearTimeout(window.SystemSearch.timer);

        $("#systemSearchResults").empty().addClass("d-none");

        $("#systemSearchPageResults").empty().addClass("d-none");

        $("#searchPageLoading").addClass("d-none");

        $("#systemSearchLoading").addClass("d-none");

        $("#searchPageEmpty").addClass("d-none");

        console.log("[System Search] STATE 10: Search cleared.");
    };

    /*
    |--------------------------------------------------------------------------
    | HTML ESCAPE
    |--------------------------------------------------------------------------
    */

    window.SystemSearch.escape = function (value) {
        return $("<div>")
            .text(value || "")
            .html();
    };

    /*
    |--------------------------------------------------------------------------
    | ATTRIBUTE ESCAPE
    |--------------------------------------------------------------------------
    */

    window.SystemSearch.escapeAttribute = function (value) {
        return String(value || "")
            .replace(/&/g, "&amp;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;");
    };
})(window, jQuery);
