
/**SYSTEM SEARCH INITIALIZER */
$(function () {
    "use strict";

    console.log("[System Search] STATE 7A: DOM ready.");

    if (typeof jQuery === "undefined") {
        console.error(
            "[System Search] STATE 7A ERROR: jQuery is not available."
        );
        return;
    }

    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 7A ERROR: SystemSearch core is not loaded."
        );
        return;
    }

    if (!window.systemSearchUrl) {
        console.error(
            "[System Search] STATE 7A ERROR: systemSearchUrl is not defined."
        );
        return;
    }

    if (typeof window.SystemSearch.bindEvents !== "function") {
        console.error(
            "[System Search] STATE 7A ERROR: Event module is not loaded."
        );
        return;
    }

    if (typeof window.SystemSearch.search !== "function") {
        console.error(
            "[System Search] STATE 7A ERROR: API module is not loaded."
        );
        return;
    }

    if (typeof window.SystemSearch.render !== "function") {
        console.error(
            "[System Search] STATE 7A ERROR: Renderer module is not loaded."
        );
        return;
    }

    if (typeof window.SystemSearch.clear !== "function") {
        console.error(
            "[System Search] STATE 7A ERROR: UI module is not loaded."
        );
        return;
    }

    window.SystemSearch.bindEvents();

    window.SystemSearch.initialized = true;

    console.log(
        "[System Search] STATE 7B: System search initialized successfully."
    );
});

