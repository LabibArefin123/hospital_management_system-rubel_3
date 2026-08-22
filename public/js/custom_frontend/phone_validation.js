/**
 * ==========================================================
 * GLOBAL MOBILE VALIDATION
 * ==========================================================
 *
 * Rules:
 * - Numbers only
 * - Exactly 11 digits
 * - Bangladesh mobile format
 * - Automatically removes text/symbols
 * - Shows small validation message below input
 * ==========================================================
 */

document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    const MOBILE_SELECTOR = ".global-mobile-input";

    /*
    |--------------------------------------------------------------------------
    | VALIDATION MESSAGE
    |--------------------------------------------------------------------------
    */

    function getMessageElement(input) {
        let message = input.parentElement.querySelector(
            ".global-mobile-validation-message",
        );

        if (!message) {
            message = document.createElement("small");

            message.className = "global-mobile-validation-message";

            message.style.display = "none";
            message.style.marginTop = "4px";
            message.style.fontSize = "11px";

            input.parentElement.appendChild(message);
        }

        return message;
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATE MOBILE
    |--------------------------------------------------------------------------
    */

    function validateMobile(input) {
        const message = getMessageElement(input);

        /*
        | Remove everything except numbers
        */

        let value = input.value.replace(/\D/g, "");

        /*
        | Maximum 11 digits
        */

        if (value.length > 11) {
            value = value.substring(0, 11);
        }

        input.value = value;

        /*
        |--------------------------------------------------------------------------
        | Empty
        |--------------------------------------------------------------------------
        */

        if (value.length === 0) {
            message.textContent = "";
            message.style.display = "none";

            input.classList.remove("is-valid", "is-invalid");

            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | Less than 11 digits
        |--------------------------------------------------------------------------
        */

        if (value.length < 11) {
            message.textContent = "Mobile number must be 11 digits.";

            message.style.display = "block";
            message.style.color = "#dc3545";

            input.classList.remove("is-valid");
            input.classList.add("is-invalid");

            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | Bangladesh mobile number
        |
        | Example:
        | 01712345678
        | 01812345678
        | 01912345678
        | 01312345678
        | 01412345678
        | 01512345678
        | 01612345678
        |
        |--------------------------------------------------------------------------
        */

        const bangladeshMobile = /^01[3-9]\d{8}$/;

        if (!bangladeshMobile.test(value)) {
            message.textContent =
                "Please enter a valid Bangladesh mobile number.";

            message.style.display = "block";
            message.style.color = "#dc3545";

            input.classList.remove("is-valid");
            input.classList.add("is-invalid");

            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | Valid
        |--------------------------------------------------------------------------
        */

        message.textContent = "Valid mobile number.";

        message.style.display = "block";
        message.style.color = "#198754";

        input.classList.remove("is-invalid");
        input.classList.add("is-valid");

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | INITIALIZE INPUT
    |--------------------------------------------------------------------------
    */

    function initializeMobileInput(input) {
        if (input.dataset.mobileValidationInitialized === "true") {
            return;
        }

        input.dataset.mobileValidationInitialized = "true";

        /*
        |--------------------------------------------------------------------------
        | Input
        |--------------------------------------------------------------------------
        */

        input.addEventListener("input", function () {
            validateMobile(this);
        });

        /*
        |--------------------------------------------------------------------------
        | Change
        |--------------------------------------------------------------------------
        */

        input.addEventListener("change", function () {
            validateMobile(this);
        });

        /*
        |--------------------------------------------------------------------------
        | Paste
        |--------------------------------------------------------------------------
        */

        input.addEventListener("paste", function () {
            setTimeout(() => {
                validateMobile(this);
            }, 0);
        });

        /*
        |--------------------------------------------------------------------------
        | Initial value
        |--------------------------------------------------------------------------
        */

        if (input.value.trim() !== "") {
            validateMobile(input);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | INITIALIZE EXISTING INPUTS
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll(MOBILE_SELECTOR).forEach(function (input) {
        initializeMobileInput(input);
    });

    /*
    |--------------------------------------------------------------------------
    | GLOBAL ACCESS
    |--------------------------------------------------------------------------
    */

    window.GlobalMobileValidation = {
        validate: validateMobile,

        initialize: initializeMobileInput,

        isValid: function (input) {
            if (!input) {
                return false;
            }

            return /^01[3-9]\d{8}$/.test(input.value.trim());
        },
    };

    console.log("[Mobile Validation] Global mobile validation initialized.");
});
