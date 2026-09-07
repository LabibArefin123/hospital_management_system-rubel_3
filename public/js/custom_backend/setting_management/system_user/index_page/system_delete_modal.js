document.addEventListener("DOMContentLoaded", function () {
    ("use strict");
    console.log("[System Delete Modal] INIT");
    const modalElement = document.getElementById("systemDeleteModal"),
        form = document.getElementById("systemDeleteForm"),
        confirmButton = document.getElementById("systemDeleteConfirm"),
        userName = document.getElementById("systemDeleteUserName"),
        userEmail = document.getElementById("systemDeleteUserEmail"),
        userRole = document.getElementById("systemDeleteUserRole"),
        userPicture = document.getElementById("systemDeleteUserPicture"),
        deleteButtons = document.querySelectorAll(".system-user-delete-btn");
    if (!modalElement) {
        console.error(
            "[System Delete Modal] ERROR: #systemDeleteModal not found",
        );
        return;
    }
    if (!form) {
        console.error(
            "[System Delete Modal] ERROR: #systemDeleteForm not found",
        );
        return;
    }
    if (!window.bootstrap || !window.bootstrap.Modal) {
        console.error(
            "[System Delete Modal] ERROR: Bootstrap 5 Modal API not found",
            window.bootstrap,
        );
        return;
    }
    console.log("[System Delete Modal] Bootstrap 5 Modal API found");
    console.log("[System Delete Modal] Delete buttons:", deleteButtons.length);
    const deleteModal = bootstrap.Modal.getOrCreateInstance(modalElement);
    let isSubmitting = false;
    deleteButtons.forEach(function (button, index) {
        button.removeAttribute("data-bs-toggle");
        button.removeAttribute("data-bs-target");
        button.addEventListener("click", function (event) {
            event.preventDefault();
            event.stopPropagation();
            console.group("[System Delete Modal] DELETE CLICK");
            const deleteUrl = this.dataset.deleteUrl || "";
            const name = this.dataset.userName || "User";
            const email = this.dataset.userEmail || "";
            const role = this.dataset.userRole || "No Role Assigned";
            const picture = this.dataset.userPicture || "";
            console.log("Button index:", index);
            console.log("User ID:", this.dataset.userId);
            console.log("User name:", name);
            console.log("Delete URL:", deleteUrl);
            console.log("Modal:", modalElement);
            console.log("Modal instance:", deleteModal);
            console.groupEnd();
            if (!deleteUrl) {
                console.error(
                    "[System Delete Modal] ERROR: Delete URL is empty",
                );
                return;
            }
            form.action = deleteUrl;
            if (userName) userName.textContent = name;
            if (userEmail) userEmail.textContent = email;
            if (userRole) userRole.textContent = role;
            if (userPicture) {
                userPicture.src = picture || "uploads/images/default.jpg";
                userPicture.alt = name;
            }
            isSubmitting = false;
            confirmButton.disabled = false;
            confirmButton.classList.remove("is-loading");
            confirmButton.innerHTML =
                '<i class="fas fa-trash-alt"></i> Delete User';
            console.log("[System Delete Modal] Opening modal...");
            deleteModal.show();
        });
    });
    modalElement.addEventListener("show.bs.modal", function () {
        console.log("[System Delete Modal] SHOW EVENT");
    });
    modalElement.addEventListener("shown.bs.modal", function () {
        console.log("[System Delete Modal] SHOWN EVENT");
    });
    modalElement.addEventListener("hide.bs.modal", function () {
        console.log("[System Delete Modal] HIDE EVENT");
    });
    modalElement.addEventListener("hidden.bs.modal", function () {
        console.log("[System Delete Modal] HIDDEN EVENT");
        if (isSubmitting) return;
        form.action = "";
        confirmButton.disabled = false;
        confirmButton.classList.remove("is-loading");
        confirmButton.innerHTML =
            '<i class="fas fa-trash-alt"></i> Delete User';
        if (userName) userName.textContent = "User Name";
        if (userEmail) userEmail.textContent = "Email";
        if (userRole) userRole.textContent = "Role";
        if (userPicture) userPicture.src = "uploads/images/default.jpg";
    });
    form.addEventListener("submit", function (event) {
        console.group("[System Delete Modal] FORM SUBMIT");
        console.log("Action:", form.action);
        console.log("Method:", form.method);
        if (!form.action) {
            event.preventDefault();
            console.error("[System Delete Modal] BLOCKED: empty form action");
        }
        if (isSubmitting) {
            event.preventDefault();
            console.warn("[System Delete Modal] BLOCKED: already submitting");
        } else {
            isSubmitting = true;
            confirmButton.disabled = true;
            confirmButton.classList.add("is-loading");
            confirmButton.innerHTML =
                '<i class="fas fa-spinner fa-spin"></i> Deleting...';
        }
        console.groupEnd();
    });
    console.log("[System Delete Modal] READY");
});
