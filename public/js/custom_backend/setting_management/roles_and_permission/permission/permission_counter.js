$(document).ready(function () {
    "use strict";
    function updatePermissionCounter(data) {
        const selected = Number(data.selected) || 0;
        const total = Number(data.total) || 0;

        $("#selectedPermissionCount").text(selected);
        $("#totalPermissionCount").text(total);
        $("#permissionTableTotal").text(total);

        const deleteButton = $("#delete-selected");
        const status = $("#permissionSelectionStatus");

        if (selected > 0) {
            deleteButton.stop(true, true).fadeIn(180);

            status
                .addClass("has-selection")
                .html(
                    '<i class="fas fa-check-circle"></i>' +
                        "<span>" +
                        selected +
                        (selected === 1
                            ? " permission selected"
                            : " permissions selected") +
                        "</span>",
                );
        } else {
            deleteButton.stop(true, true).fadeOut(180);

            status
                .removeClass("has-selection")
                .html(
                    '<i class="fas fa-check-circle"></i>' +
                        "<span>No permissions selected</span>",
                );
        }
    }

    $(document).on("permissionSelectionChanged", function (event, data) {
        updatePermissionCounter(data);
    });

    $(document).on("permissionSelectionReset", function () {
        const total = $("#dataTables .row-checkbox").length;

        updatePermissionCounter({
            selected: 0,
            total: total,
        });
    });
});
