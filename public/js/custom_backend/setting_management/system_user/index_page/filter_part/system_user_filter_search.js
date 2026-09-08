$(document).ready(function () {
    "use strict";
    const searchInput = $("#systemUserSearch");
    const roleFilter = $("#systemUserRoleFilter");

    searchInput.on("input", function () {
        window.SystemUserFilterState.updateClearSearchButton();
    });

    searchInput.on("keypress", function (event) {
        if (event.which === 13) {
            event.preventDefault();

            $("#applySystemUserFilter").trigger("click");
        }
    });

    roleFilter.on("change", function () {
        window.SystemUserFilterState.updateFilterButton();
    });

    window.SystemUserFilterState.update();
});
