document.addEventListener("DOMContentLoaded", function () {
    "use strict";
    const ContactFilter = window.ContactFilter;

    if (!ContactFilter) {
        console.error("[Contact Filter] ERROR: Filter core module not loaded.");
        return;
    }

    /*INITIAL FILTER*/
    ContactFilter.filterContacts();
    console.log("[Contact Filter] Contact filtering initialized successfully.");
});
