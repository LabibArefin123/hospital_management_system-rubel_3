$(document).ready(function () {
    "use strict";

    console.log("[Permission] Permission management initialized.");

    const totalPermissions = $("#dataTables .row-checkbox").length;

    $("#totalPermissionCount").text(totalPermissions);
    $("#permissionTableTotal").text(totalPermissions);
});
