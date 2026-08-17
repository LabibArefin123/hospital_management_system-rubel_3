$(document).ready(function () {
    let lastChecked = null;

    /* =========================================================
       SHIFT + CLICK RANGE SELECT
    ========================================================= */

    $(".row-checkbox").on("click", function (e) {
        if (!lastChecked) {
            lastChecked = this;
            return;
        }

        if (e.shiftKey) {
            let start = $(".row-checkbox").index(this);
            let end = $(".row-checkbox").index(lastChecked);

            $(".row-checkbox")
                .slice(Math.min(start, end), Math.max(start, end) + 1)
                .prop("checked", lastChecked.checked);
        }

        lastChecked = this;

        updateSelectAll();
    });

    /* =========================================================
       SELECT ALL
    ========================================================= */

    $("#select-all").on("click", function () {
        const checked = $(this).prop("checked");

        $(".row-checkbox").prop("checked", checked);
    });

    /* =========================================================
       SINGLE CHECKBOX CHANGE
    ========================================================= */

    $("#dataTables").on("change", ".row-checkbox", function () {
        updateSelectAll();
    });

    /* =========================================================
       BULK DELETE
    ========================================================= */

    $("#delete-selected").on("click", function () {
        const ids = $(".row-checkbox:checked")
            .map(function () {
                return $(this).val();
            })
            .get();

        if (ids.length === 0) {
            Swal.fire({
                icon: "warning",
                title: "No Permission Selected",
                text: "Please select at least one permission.",
            });

            return;
        }

        Swal.fire({
            title: "Delete Selected Permissions?",
            text: "This action cannot be undone.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Yes, Delete",
        }).then((result) => {
            if (!result.isConfirmed) return;

            $.ajax({
                url: permissionsDeleteUrl,
                method: "POST",

                data: {
                    _token: csrfToken,
                    ids: ids,
                },

                success: function (res) {
                    Swal.fire({
                        icon: "success",
                        title: "Deleted",
                        text:
                            res.message ||
                            "Selected permissions deleted successfully.",
                        timer: 2000,
                        showConfirmButton: false,
                    });

                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                },

                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Something went wrong!",
                    });
                },
            });
        });
    });

    /* =========================================================
       HELPER
    ========================================================= */

    function updateSelectAll() {
        const allChecked =
            $(".row-checkbox").length === $(".row-checkbox:checked").length;

        $("#select-all").prop("checked", allChecked);
    }
});
