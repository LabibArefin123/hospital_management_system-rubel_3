/**
 * ==========================================================
 * SUSTHOCARE SYSTEM SEARCH CONTAINER RENDERER
 * ==========================================================
 */
(function (window, $) {
    "use strict";
    console.log("[System Search] STATE 4C: Container renderer module loaded.");
    if (!window.SystemSearch) {
        console.error(
            "[System Search] CONTAINER ERROR: SystemSearch core not loaded.",
        );
        return;
    }
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
