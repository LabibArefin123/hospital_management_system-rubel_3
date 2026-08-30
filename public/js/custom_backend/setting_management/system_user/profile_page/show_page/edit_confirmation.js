/*  USER PROFILE EDIT CONFIRMATION  */

document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    const editProfileBtn = document.getElementById("editProfileBtn");

    if (!editProfileBtn) {
        return;
    }

    editProfileBtn.addEventListener("click", function (e) {
        e.preventDefault();

        const profileUrl = this.dataset.profileUrl;

        Swal.fire({
            title: "Do you want to edit your profile?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, edit it!",
            cancelButtonText: "No, cancel",
        }).then(function (result) {
            if (result.isConfirmed && profileUrl) {
                window.location.href = profileUrl;
            }
        });
    });
});
