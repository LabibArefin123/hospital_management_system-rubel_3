$(document).ready(function () {
    const filterModal = $("#systemUserFilterModal");
    const roleFilter = $("#systemUserRoleFilter");
    const applyButton = $("#applySystemUserFilter");
    const clearButton = $("#clearSystemUserFilter");
    const filterBadge = $("#activeFilterBadge");

    window.SystemUserFilter = {
        updateBadge: function () {
            const role = roleFilter.val();

            if (role) {
                filterBadge.removeClass("d-none").text("1");
            } else {
                filterBadge.addClass("d-none");
            }
        },
    };

    /*Apply Filter */
    applyButton.on("click", function () {
        if (window.SystemUserTable) {
            window.SystemUserTable.ajax.reload(null, true);
        }

        window.SystemUserFilter.updateBadge();
        filterModal.modal("hide");
    });

    /* Clear Filter */
    clearButton.on("click", function () {
        roleFilter.val("");

        if (window.SystemUserTable) {
            window.SystemUserTable.ajax.reload(null, true);
        }

        window.SystemUserFilter.updateBadge();
        filterModal.modal("hide");
    });

    /* Initial State*/
    window.SystemUserFilter.updateBadge();
});
