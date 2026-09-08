$(document).ready(function () {
    "use strict";

    const filterSection = $("#systemUserFilterSection");
    const toggleButton = $("#toggleSystemUserFilter");
    const buttonText = $("#systemUserFilterButtonText");
    const searchInput = $("#systemUserSearch");

    if (!filterSection.length || !toggleButton.length) {
        return;
    }

    toggleButton.on("click", function () {
        filterSection.toggleClass("d-none");

        if (filterSection.hasClass("d-none")) {
            buttonText.text(
                window.SystemUserFilterState.hasActiveFilter()
                    ? "Filter Applied"
                    : "Filter Users",
            );
        } else {
            buttonText.text("Hide Filter");

            setTimeout(function () {
                searchInput.trigger("focus");
            }, 100);
        }
    });
});
