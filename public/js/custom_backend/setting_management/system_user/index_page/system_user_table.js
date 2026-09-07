$(document).ready(function () {
    window.SystemUserTable = $("#systemUsersTable").DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        lengthChange: false,
        pageLength: 10,
        ordering: false,
        responsive: true,
        ajax: {
            url: systemUserDataUrl,
            data: function (data) {
                data.role = $("#systemUserRoleFilter").val() || "";
                data.search = $("#systemUserSearch").val() || "";
            },
        },
        columns: [
            {
                data: "number",
                name: "number",
                className: "text-center",
            },
            {
                data: "role",
                name: "role",
                orderable: false,
                searchable: false,
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "email",
                name: "email",
            },
            {
                data: "phone",
                name: "phone",
            },
            {
                data: "phone_2",
                name: "phone_2",
            },
            {
                data: "username",
                name: "username",
            },
            {
                data: "actions",
                name: "actions",
                orderable: false,
                searchable: false,
                // className: "text-nowrap",
            },
        ],
        language: {
            processing:
                '<i class="fas fa-spinner fa-spin mr-1"></i> Loading users...',
            emptyTable: "No system users found.",
            zeroRecords: "No users match your filter.",
        },
    });
});
