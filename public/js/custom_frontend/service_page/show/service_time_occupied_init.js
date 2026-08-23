// ==================================================
// SERVICE TIME OCCUPIED - INIT
// ==================================================
document.addEventListener("DOMContentLoaded", function () {
    "use strict";
    if (typeof window.ServiceTimeOccupied === "undefined") {
        window.ServiceTimeOccupied = {};
    }
    if (typeof window.ServiceTimeOccupied.detectError === "function") {
        window.ServiceTimeOccupied.detectError();
    }
});
