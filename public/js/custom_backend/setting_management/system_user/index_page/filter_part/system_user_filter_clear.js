$(document).ready(function () {
    "use strict";

    const clearButton = $("#clearSystemUserFilter");
    const clearSearchButton = $("#clearSystemUserSearch");
    const searchInput = $("#systemUserSearch");
    const roleFilter = $("#systemUserRoleFilter");

    clearButton.on("click", function (event) {
        event.preventDefault();
        searchInput.val("");
        roleFilter.val("");

        const table = window.SystemUserFilterState.getTable();

        if (table) {
            table.search("");
            table.column(1).search("");
            table.draw();
        }

        window.SystemUserFilterState.update();
    });

    clearSearchButton.on("click", function (event) {
        event.preventDefault();

        searchInput.val("");

        window.SystemUserFilterState.update();

        searchInput.trigger("focus");
    });
});