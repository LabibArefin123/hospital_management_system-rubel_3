/**SYSTEM SEARCH UI - CLEAR*/
(function (window, $) {
    "use strict";
    console.log("[System Search] STATE 6C: UI clear module loaded.");

    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 5C ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    /*CLEAR SEARCH UI    */
    window.SystemSearch.clear = function () {
        clearTimeout(window.SystemSearch.timer);
        $("#systemSearchResults").empty().addClass("d-none");
        $("#systemSearchPageResults").empty().addClass("d-none");
        $("#searchPageLoading").addClass("d-none");
        $("#systemSearchLoading").addClass("d-none");
        $("#searchPageEmpty").addClass("d-none");
        console.log("[System Search] STATE 13: Search cleared.");
    };
})(window, jQuery);
