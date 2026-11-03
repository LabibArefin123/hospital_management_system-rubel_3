/** PROFILE - SHOW / HIDE PASSWORD */
(function (window, $) {
    "use strict";

    console.log("[Profile] STATE 1: Show password module loaded.");

    $(document).on("click", ".toggle-password", function () {
        const $button = $(this);
        const targetId = $button.data("target");
        const $input = $("#" + targetId);
        const $icon = $button.find("i");

        /* VALIDATE TARGET */
        if (!$input.length) {
            console.error(
                "[Profile] ERROR: Password input not found.",
                targetId,
            );
            return;
        }

        /* TOGGLE PASSWORD VISIBILITY */
        const isPassword = $input.attr("type") === "password";

        $input.attr("type", isPassword ? "text" : "password");

        /* UPDATE ICON */
        $icon.toggleClass("fa-eye", !isPassword);
        $icon.toggleClass("fa-eye-slash", isPassword);

        /* UPDATE ACCESSIBILITY */
        $button.attr(
            "aria-label",
            isPassword ? "Hide password" : "Show password",
        );

        console.log("[Profile] STATE 2: Password visibility changed.", {
            field: targetId,
            visible: isPassword,
        });
    });

    console.log("[Profile] STATE 1: Password toggle handler initialized.");
})(window, jQuery);
