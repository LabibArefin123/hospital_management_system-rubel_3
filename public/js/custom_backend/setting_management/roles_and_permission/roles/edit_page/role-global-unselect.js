document.addEventListener("DOMContentLoaded", function () {
    const unselectAllBtn = document.getElementById("unselectAllPermissions");

    if (unselectAllBtn) {
        unselectAllBtn.addEventListener("click", function () {
            document
                .querySelectorAll(".perm-all")
                .forEach((cb) => (cb.checked = false));
        });
    }
});
