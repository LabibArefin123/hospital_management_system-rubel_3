/* USER FORM HELPERS*/
(function (window) {
    "use strict";
    const FormFill = window.SusthoCareUserForm;

    if (!FormFill) {
        console.error("[User Form Fill] ERROR: Config module not loaded.");
        return;
    }

    /*FILL ONLY IF EMPTY */
    FormFill.fillIfEmpty = function (selector, value) {
        const field = document.querySelector(selector);

        if (!field) {
            return;
        }

        /*DO NOT OVERRIDE OLD INPUT  */
        if (String(field.value || "").trim() !== "") {
            return;
        }

        if (
            value !== null &&
            value !== undefined &&
            String(value).trim() !== ""
        ) {
            field.value = value;
        }
    };
})(window);
