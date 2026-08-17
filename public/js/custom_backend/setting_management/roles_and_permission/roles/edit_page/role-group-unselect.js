document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".unselect-all-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            const group = this.getAttribute("data-group");

            document
                .querySelectorAll(`.perm-${group}`)
                .forEach((cb) => (cb.checked = false));
        });
    });
});
