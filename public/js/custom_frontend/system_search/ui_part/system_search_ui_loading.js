/**
 * ==========================================================
 * SYSTEM SEARCH UI - LOADING
 * ==========================================================
 */

(function (window, $) {
    "use strict";

    console.log("[System Search] STATE 5A: UI loading module loaded.");

    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 5A ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW LOADING
    |--------------------------------------------------------------------------
    */

    window.SystemSearch.showLoading = function () {
        console.log("[System Search] STATE 7: Showing loading.");

        $("#searchPageLoading").removeClass("d-none");

        $("#systemSearchLoading").removeClass("d-none");
    };

    /*
    |--------------------------------------------------------------------------
    | HIDE LOADING
    |--------------------------------------------------------------------------
    */

    window.SystemSearch.hideLoading = function () {
        $("#searchPageLoading").addClass("d-none");

        $("#systemSearchLoading").addClass("d-none");
    };
})(window, jQuery);
