$(document).ready(function () {
    "use strict";
    let lastChecked = null;
    function getCheckboxes() {
        return $("#dataTables .row-checkbox");
    }

    function updateSelectionState() {
        const checkboxes = getCheckboxes();
        const checked = checkboxes.filter(":checked");
        const total = checkboxes.length;
        const selected = checked.length;

        $("#select-all").prop("checked", total > 0 && selected === total);

        $("#select-all").prop(
            "indeterminate",
            selected > 0 && selected < total,
        );

        $(document).trigger("permissionSelectionChanged", {
            selected: selected,
            total: total,
        });
    }

    $("#dataTables").on("click", ".row-checkbox", function (event) {
        const checkboxes = getCheckboxes();
        if (!lastChecked) {
            lastChecked = this;
            updateSelectionState();
            return;
        }

        if (event.shiftKey) {
            const start = checkboxes.index(this);
            const end = checkboxes.index(lastChecked);

            if (start !== -1 && end !== -1) {
                checkboxes
                    .slice(Math.min(start, end), Math.max(start, end) + 1)
                    .prop("checked", lastChecked.checked);
            }
        }

        lastChecked = this;

        updateSelectionState();
    });

    $("#select-all").on("change", function () {
        const checked = $(this).prop("checked");
        getCheckboxes().prop("checked", checked);
        $(this).prop("indeterminate", false);
        updateSelectionState();
    });

    $(document).on("permissionSelectionReset", function () {
        getCheckboxes().prop("checked", false);
        $("#select-all").prop("checked", false).prop("indeterminate", false);
        lastChecked = null;
        updateSelectionState();
    });
    updateSelectionState();
});
