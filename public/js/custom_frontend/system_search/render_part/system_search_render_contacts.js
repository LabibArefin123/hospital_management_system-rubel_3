/* SYSTEM SEARCH RENDERER - CONTACTS */

(function (window, $) {
    "use strict";

    if (!window.SystemSearch) {
        console.error("[System Search] Contact renderer: Core not loaded.");
        return;
    }

    window.SystemSearch.normalizeContacts = function (contacts) {
        if (!Array.isArray(contacts)) {
            return [];
        }

        return contacts.map(function (item) {
            return {
                id: item.id || null,
                name: item.name || "-",
                email: item.email || "",
                phone: item.phone || "",
                department: item.department || "",
                service: item.service || "",
                message: item.message || "",
                date: item.date || "-",
                type: "contact",
                url: null,
            };
        });
    };
})(window, jQuery);
