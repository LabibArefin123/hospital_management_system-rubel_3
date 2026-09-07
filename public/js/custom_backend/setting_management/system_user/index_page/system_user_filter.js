$(document).ready(function () {
    "use strict";

    const filterSection = $("#systemUserFilterSection");
    const toggleButton = $("#toggleSystemUserFilter");
    const buttonText = $("#systemUserFilterButtonText");
    const searchInput = $("#systemUserSearch");
    const roleFilter = $("#systemUserRoleFilter");
    const applyButton = $("#applySystemUserFilter");
    const clearButton = $("#clearSystemUserFilter");
    const clearSearchButton = $("#clearSystemUserSearch");

    function getTable() {
        if ($.fn.DataTable.isDataTable("#dataTables")) {
            return $("#dataTables").DataTable();
        }

        return null;
    }

    function hasActiveFilter() {
        return (
            searchInput.val().trim() !== "" || roleFilter.val().trim() !== ""
        );
    }

    function updateClearSearchButton() {
        if (searchInput.val().trim() !== "") {
            clearSearchButton.removeClass("d-none");
        } else {
            clearSearchButton.addClass("d-none");
        }
    }

    function updateFilterButton() {
        if (hasActiveFilter()) {
            toggleButton
                .removeClass("btn-outline-primary")
                .addClass("btn-primary");

            buttonText.text("Filter Applied");
        } else {
            toggleButton
                .removeClass("btn-primary")
                .addClass("btn-outline-primary");

            buttonText.text("Filter Users");
        }
    }

    function applyFilters() {
        const table = getTable();

        if (!table) {
            console.warn(
                "[System User Filter] DataTable #dataTables is not initialized.",
            );
            return;
        }

        const searchValue = searchInput.val().trim();
        const roleValue = roleFilter.val().trim();

        /*
        |--------------------------------------------------------------------------
        | GLOBAL DATATABLE SEARCH
        |--------------------------------------------------------------------------
        */

        table.search(searchValue);

        /*
        |--------------------------------------------------------------------------
        | ROLE COLUMN FILTER
        |--------------------------------------------------------------------------
        |
        | Column index:
        | 0 = #
        | 1 = Role
        | 2 = Picture
        | 3 = Name
        | 4 = Email
        | 5 = Primary Phone
        | 6 = Alt. Phone
        | 7 = Username
        | 8 = Actions
        |
        */

        table.column(1).search(roleValue);

        table.draw();

        updateClearSearchButton();
        updateFilterButton();
    }

    toggleButton.on("click", function () {
        filterSection.toggleClass("d-none");

        if (filterSection.hasClass("d-none")) {
            buttonText.text(
                hasActiveFilter() ? "Filter Applied" : "Filter Users",
            );
        } else {
            buttonText.text("Hide Filter");

            setTimeout(function () {
                searchInput.trigger("focus");
            }, 100);
        }
    });

    /*
    |--------------------------------------------------------------------------
    | APPLY FILTER
    |--------------------------------------------------------------------------
    */

    applyButton.on("click", function (event) {
        event.preventDefault();

        applyFilters();
    });

    /*
    |--------------------------------------------------------------------------
    | CLEAR ALL FILTERS
    |--------------------------------------------------------------------------
    */

    clearButton.on("click", function (event) {
        event.preventDefault();

        searchInput.val("");
        roleFilter.val("");

        const table = getTable();

        if (table) {
            table.search("");
            table.column(1).search("");
            table.draw();
        }

        updateClearSearchButton();
        updateFilterButton();
    });

    /*
    |--------------------------------------------------------------------------
    | CLEAR SEARCH ONLY
    |--------------------------------------------------------------------------
    */

    clearSearchButton.on("click", function (event) {
        event.preventDefault();

        searchInput.val("");

        updateClearSearchButton();

        searchInput.trigger("focus");
    });

    /*
    |--------------------------------------------------------------------------
    | SEARCH INPUT
    |--------------------------------------------------------------------------
    */

    searchInput.on("input", function () {
        updateClearSearchButton();
    });

    /*
    |--------------------------------------------------------------------------
    | ENTER TO APPLY
    |--------------------------------------------------------------------------
    */

    searchInput.on("keypress", function (event) {
        if (event.which === 13) {
            event.preventDefault();

            applyFilters();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | ROLE CHANGE
    |--------------------------------------------------------------------------
    */

    roleFilter.on("change", function () {
        updateFilterButton();
    });

    /*
    |--------------------------------------------------------------------------
    | INITIAL STATE
    |--------------------------------------------------------------------------
    */

    updateClearSearchButton();
    updateFilterButton();
});
