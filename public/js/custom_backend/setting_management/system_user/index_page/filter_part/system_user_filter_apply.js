$(document).ready(function () {
    "use strict";
    const applyButton = $("#applySystemUserFilter");

    if (!applyButton.length) {
        return;
    }

    applyButton.on("click", function (event) {
        event.preventDefault();

        const table = window.SystemUserFilterState.getTable();

        if (!table) {
            console.warn(
                "[System User Filter] DataTable #dataTables is not initialized.",
            );

            return;
        }

        const searchValue = $("#systemUserSearch").val().trim();
        const roleValue = $("#systemUserRoleFilter").val().trim();

        table.search(searchValue);

        /*
        |--------------------------------------------------------------------------
        | DATA TABLE COLUMN INDEX
        |--------------------------------------------------------------------------
        |
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

        window.SystemUserFilterState.update();
    });
});
