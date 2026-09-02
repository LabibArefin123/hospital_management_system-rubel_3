/*  SYSTEM USER - PASSWORD MANAGEMENT*/

$(function () {
    "use strict";

    console.log("[System User] Password management module loaded.");

    /*  OPEN CHANGE PASSWORD MODAL  */
    $(document).on("click", ".change-password-btn", function () {
        /*  THIS IS VARIABLE PART  */
        const userId = $(this).attr("data-user-id");
        const userName = $(this).attr("data-user-name") || "";
        const userEmail = $(this).attr("data-user-email") || "";
        const userRole = $(this).attr("data-user-role") || "";
        const userPicture = $(this).attr("data-user-picture") || "";

        /*  SET USER NAME  */
        $("#modalUserName").text(userName);

        /*  SET USER EMAIL  */
        $("#modalUserEmail").text(userEmail);

        /*  SET USER ROLE  */
        if (userRole.trim() !== "") {
            $("#modalUserRole")
                .text("(" + userRole + ")")
                .show();
        } else {
            $("#modalUserRole").text("").hide();
        }

        /*  SET USER PROFILE PICTURE  */
        $("#modalUserPicture").attr("src", userPicture);

        /*  FALLBACK PROFILE PICTURE  */
        $("#modalUserPicture")
            .off("error")
            .on("error", function () {
                $(this).attr("src", "/uploads/images/default.jpg");
            });

        /*  SET FORM ACTION  */
        $("#changePasswordForm").attr(
            "action",
            "/system_users/" + userId + "/change-password",
        );

        /*  RESET PASSWORD FIELDS  */
        $("#password").val("").attr("type", "password");
        $("#password_confirmation").val("").attr("type", "password");

        /*  RESET PASSWORD ICONS  */
        $("#password,#password_confirmation")
            .closest(".input-group")
            .find(".toggle-password i")
            .removeClass("fa-eye-slash")
            .addClass("fa-eye");
    });

    /*  RESET MODAL WHEN CLOSED  */
    $("#changePasswordModal").on("hidden.bs.modal", function () {
        /*  RESET FORM  */
        const form = $("#changePasswordForm");

        if (form.length) {
            form[0].reset();
        }

        /*  RESET USER INFORMATION  */
        $("#modalUserName").text("User Name");
        $("#modalUserEmail").text("user@email.com");
        $("#modalUserRole").text("").hide();
        $("#modalUserPicture").attr("src", "/uploads/images/default.jpg");

        /*  RESET PASSWORD TYPE  */
        $("#password,#password_confirmation").attr("type", "password");

        /*  RESET PASSWORD ICONS  */
        $(".toggle-password i").removeClass("fa-eye-slash").addClass("fa-eye");
    });
});
