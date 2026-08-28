/** SYSTEM SEARCH UI - HELPERS*/

(function (window, $) {
    "use strict";
    console.log("[System Search] STATE 5D: UI helpers module loaded.");
    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 5D ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    /*HTML ESCAPE */
    window.SystemSearch.escape = function (value) {
        return $("<div>")
            .text(value || "")
            .html();
    };

    /*ATTRIBUTE ESCAPE */
    window.SystemSearch.escapeAttribute = function (value) {
        return String(value || "")
            .replace(/&/g, "&amp;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;");
    };
})(window, jQuery);
