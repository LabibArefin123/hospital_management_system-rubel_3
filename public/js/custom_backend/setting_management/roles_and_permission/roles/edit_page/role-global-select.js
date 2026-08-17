document.addEventListener("DOMContentLoaded", function () {
    const selectAllBtn = document.getElementById("selectAllPermissions");

    if (selectAllBtn) {
        selectAllBtn.addEventListener("click", function () {
            document
                .querySelectorAll(".perm-all")
                .forEach((cb) => (cb.checked = true));
        });
    }
});
