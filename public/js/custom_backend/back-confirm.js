document.addEventListener("DOMContentLoaded", function () {
    let formChanged = false;
    let nextUrl = "";

    // Detect form changes
    const forms = document.querySelectorAll("form");

    forms.forEach((form) => {
        form.querySelectorAll("input, textarea, select").forEach((field) => {
            field.addEventListener("change", function () {
                formChanged = true;
            });

            field.addEventListener("keyup", function () {
                formChanged = true;
            });
        });
    });

    // Detect back button / links
    document.querySelectorAll("a").forEach((link) => {
        link.addEventListener("click", function (e) {
            const href = link.getAttribute("href");

            if (
                formChanged &&
                href &&
                href !== "#" &&
                !href.includes("javascript:")
            ) {
                e.preventDefault();

                nextUrl = href;

                const modal = new bootstrap.Modal(
                    document.getElementById("backConfirmModal"),
                );

                modal.show();
            }
        });
    });

    // Leave page button
    const leaveBtn = document.querySelector(".leave-page");

    if (leaveBtn) {
        leaveBtn.addEventListener("click", function (e) {
            e.preventDefault();

            window.location.href = nextUrl;
        });
    }
});
