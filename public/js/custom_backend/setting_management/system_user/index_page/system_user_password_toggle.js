/**
 * ==========================================================
 * SUSTHOCARE SYSTEM USER - PASSWORD TOGGLE
 * ==========================================================
 */

$(function () {
    "use strict";

    console.log("[System User] Password toggle module loaded.");

    /*
    |--------------------------------------------------------------------------
    | TOGGLE PASSWORD VISIBILITY
    |--------------------------------------------------------------------------
    */

    $(document).on("click", ".toggle-password", function () {
        const targetId = $(this).data("target");

        const input = $("#" + targetId);

        const icon = $(this).find("i");

        /*
        |--------------------------------------------------------------------------
        | VALIDATE INPUT
        |--------------------------------------------------------------------------
        */

        if (!input.length) {
            console.warn("[System User] Password input not found:", targetId);

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | TOGGLE INPUT TYPE
        |--------------------------------------------------------------------------
        */

        if (input.attr("type") === "password") {
            input.attr("type", "text");

            icon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            input.attr("type", "password");

            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
});
