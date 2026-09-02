/*SYSTEM SEARCH STATUS HELPERS*/
(function (window, $) {
    "use strict";
    console.log("[System Search] STATE 4A: Status renderer module loaded.");
    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATUS ERROR: SystemSearch core not loaded.",
        );
        return;
    }
    window.SystemSearch.getStatusClass = function (status) {
        status = (status || "pending").toLowerCase();
        if (status === "confirmed") return "confirmed";
        if (status === "cancelled") return "cancelled";
        return "pending";
    };
    window.SystemSearch.getStatusLabel = function (status) {
        status = (status || "pending").toLowerCase();
        if (status === "confirmed") return "Confirmed";
        if (status === "cancelled") return "Cancelled";
        return "Pending";
    };
})(window, jQuery);
