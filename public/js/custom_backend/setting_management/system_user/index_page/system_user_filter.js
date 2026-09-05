$(document).ready(function () {
    const filterSection = $("#systemUserFilterSection");
    const toggleButton = $("#toggleSystemUserFilter");
    const buttonText = $("#systemUserFilterButtonText");
    const searchInput = $("#systemUserSearch");
    const roleFilter = $("#systemUserRoleFilter");
    const applyButton = $("#applySystemUserFilter");
    const clearButton = $("#clearSystemUserFilter");
    const clearSearchButton = $("#clearSystemUserSearch");

    function hasActiveFilter() {
        return searchInput.val().trim() !== "" || roleFilter.val() !== "";
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

    toggleButton.on("click", function () {
        filterSection.toggleClass("d-none");

        if (filterSection.hasClass("d-none")) {
            buttonText.text(
                hasActiveFilter() ? "Filter Applied" : "Filter Users",
            );
        } else {
            buttonText.text("Hide Filter");
            searchInput.trigger("focus");
        }
    });

    applyButton.on("click", function () {
        updateClearSearchButton();
        updateFilterButton();

        if (window.SystemUserTable) {
            window.SystemUserTable.ajax.reload(null, true);
        }
    });

    clearButton.on("click", function () {
        searchInput.val("");
        roleFilter.val("");

        updateClearSearchButton();
        updateFilterButton();

        if (window.SystemUserTable) {
            window.SystemUserTable.ajax.reload(null, true);
        }
    });

    clearSearchButton.on("click", function () {
        searchInput.val("");
        updateClearSearchButton();
        searchInput.trigger("focus");
    });

    searchInput.on("input", function () {
        updateClearSearchButton();
    });

    searchInput.on("keypress", function (event) {
        if (event.which === 13) {
            event.preventDefault();
            applyButton.trigger("click");
        }
    });

    updateClearSearchButton();
    updateFilterButton();
});
