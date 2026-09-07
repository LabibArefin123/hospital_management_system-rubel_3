$(document).ready(function () {
    "use strict";

    function getSelectedPermissionIds() {
        return $("#dataTables .row-checkbox:checked")
            .map(function () {
                return $(this).val();
            })
            .get();
    }

    $("#delete-selected").on("click", function () {
        const ids = getSelectedPermissionIds();

        if (ids.length === 0) {
            Swal.fire({
                icon: "warning",
                title: "No Permission Selected",
                text: "Please select at least one permission.",
                confirmButtonColor: "#8b0000",
            });

            return;
        }

        const permissionText = ids.length === 1 ? "permission" : "permissions";

        Swal.fire({
            title: "Delete Selected Permissions?",
            html:
                "<strong>" +
                ids.length +
                "</strong> " +
                permissionText +
                " will be permanently deleted.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#6c757d",
            confirmButtonText: '<i class="fas fa-trash-alt"></i> Yes, Delete',
            cancelButtonText: '<i class="fas fa-times"></i> Cancel',
            reverseButtons: true,
        }).then(function (result) {
            if (!result.isConfirmed) {
                return;
            }

            deletePermissions(ids);
        });
    });

    function deletePermissions(ids) {
        const deleteButton = $("#delete-selected");

        deleteButton
            .prop("disabled", true)
            .html(
                '<i class="fas fa-spinner fa-spin"></i>' +
                    "<span>Deleting...</span>",
            );

        $.ajax({
            url: permissionsDeleteUrl,
            method: "POST",
            data: {
                _token: csrfToken,
                ids: ids,
            },

            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: "Permissions Deleted",
                    text:
                        response.message ||
                        "Selected permissions deleted successfully.",
                    timer: 1800,
                    showConfirmButton: false,
                });

                setTimeout(function () {
                    location.reload();
                }, 1200);
            },

            error: function (xhr) {
                let message =
                    "Something went wrong while deleting the permissions.";

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: "error",
                    title: "Delete Failed",
                    text: message,
                    confirmButtonColor: "#8b0000",
                });

                deleteButton
                    .prop("disabled", false)
                    .html(
                        '<i class="fas fa-trash-alt"></i>' +
                            "<span>Delete Selected</span>",
                    );
            },
        });
    }
});
