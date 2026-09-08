(function (window, $) {
    "use strict";

    window.SystemUserFilterState = {
        getTable: function () {
            if ($.fn.DataTable.isDataTable("#dataTables")) {
                return $("#dataTables").DataTable();
            }

            return null;
        },

        hasActiveFilter: function () {
            const searchValue = $("#systemUserSearch").val().trim();
            const roleValue = $("#systemUserRoleFilter").val().trim();

            return searchValue !== "" || roleValue !== "";
        },

        updateClearSearchButton: function () {
            const searchInput = $("#systemUserSearch");
            const clearSearchButton = $("#systemUserClearSearch");

            if (searchInput.val().trim() !== "") {
                clearSearchButton.removeClass("d-none");
            } else {
                clearSearchButton.addClass("d-none");
            }
        },

        updateFilterButton: function () {
            const toggleButton = $("#toggleSystemUserFilter");
            const buttonText = $("#systemUserFilterButtonText");

            if (this.hasActiveFilter()) {
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
        },

        update: function () {
            this.updateClearSearchButton();
            this.updateFilterButton();
        },
    };
})(window, jQuery);
