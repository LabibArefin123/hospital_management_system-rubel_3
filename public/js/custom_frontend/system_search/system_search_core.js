/**
 * ==========================================================
 * SUSTHOCARE SYSTEM SEARCH CORE
 * ==========================================================
 */

(function (window, $) {
    "use strict";

    console.log("[System Search] STATE 1: Core loaded.");

    if (!$) {
        console.error("[System Search] STATE 1 ERROR: jQuery not loaded.");
        return;
    }

    window.SystemSearch = {
        timer: null,
        delay: 300,
        initialized: false,
    };

    console.log("[System Search] STATE 1: SystemSearch object created.");
})(window, jQuery);
