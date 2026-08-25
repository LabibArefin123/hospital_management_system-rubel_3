
// ==========================================================
// PAYMENT PAGE
// ==========================================================

document.addEventListener("DOMContentLoaded", function () {

    "use strict";


    // ======================================================
    // ELEMENTS
    // ======================================================

    const paymentForm = document.getElementById("paymentForm");

    const paymentMethodInput =
        document.getElementById("paymentMethod");

    const transactionInput =
        document.getElementById("transaction_id");

    const referenceInput =
        document.getElementById("payment_reference");

    const confirmButton =
        document.getElementById("confirmPaymentBtn");


    if (!paymentForm) {
        return;
    }


    // ======================================================
    // PAYMENT METHOD SELECTION
    // ======================================================

    const paymentButtons =
        document.querySelectorAll(".payment-method-tab");


    const paymentPanels =
        document.querySelectorAll(".payment-method-panel");


    function selectPaymentMethod(button) {

        const method =
            String(
                button.dataset.paymentMethod || ""
            ).trim();


        if (!method) {
            return;
        }


        // ----------------------------------------------
        // Remove active state
        // ----------------------------------------------

        paymentButtons.forEach(function (item) {

            item.classList.remove("active");

            item.setAttribute(
                "aria-pressed",
                "false"
            );

        });


        // ----------------------------------------------
        // Activate selected method
        // ----------------------------------------------

        button.classList.add("active");

        button.setAttribute(
            "aria-pressed",
            "true"
        );


        // ----------------------------------------------
        // Update hidden input
        // ----------------------------------------------

        if (paymentMethodInput) {

            paymentMethodInput.value =
                method;

        }


        // ----------------------------------------------
        // Update payment panels
        // ----------------------------------------------

        paymentPanels.forEach(function (panel) {

            const panelMethod =
                String(
                    panel.dataset.paymentPanel || ""
                ).trim();


            panel.classList.toggle(
                "active",
                panelMethod === method
            );

        });


        console.log(
            "[Payment] Method selected:",
            method
        );

    }


    paymentButtons.forEach(function (button) {

        button.addEventListener(
            "click",
            function (event) {

                event.preventDefault();

                selectPaymentMethod(this);

            }
        );

    });


    // ======================================================
    // FORM VALIDATION
    // ======================================================

    function validatePaymentForm() {

        const transactionId =
            transactionInput
                ? transactionInput.value.trim()
                : "";


        const paymentReference =
            referenceInput
                ? referenceInput.value.trim()
                : "";


        const paymentMethod =
            paymentMethodInput
                ? paymentMethodInput.value.trim()
                : "";


        const valid =
            transactionId !== "" &&
            paymentReference !== "" &&
            paymentMethod !== "";


        if (confirmButton) {

            confirmButton.disabled = !valid;

            confirmButton.classList.toggle(
                "ready",
                valid
            );

        }


        return valid;

    }


    // ======================================================
    // REFERENCE INPUT
    // ======================================================

    if (referenceInput) {

        referenceInput.addEventListener(
            "input",
            validatePaymentForm
        );

        referenceInput.addEventListener(
            "change",
            validatePaymentForm
        );

    }


    // ======================================================
    // FORM SUBMIT
    // ======================================================

    paymentForm.addEventListener(
        "submit",
        function (event) {

            const transactionId =
                transactionInput
                    ? transactionInput.value.trim()
                    : "";


            const paymentReference =
                referenceInput
                    ? referenceInput.value.trim()
                    : "";


            const paymentMethod =
                paymentMethodInput
                    ? paymentMethodInput.value.trim()
                    : "";


            console.log(
                "[Payment] Submit:",
                {
                    appointmentId:
                        paymentForm.querySelector(
                            '[name="appointment_id"]'
                        )?.value || "",

                    amount:
                        paymentForm.querySelector(
                            '[name="amount"]'
                        )?.value || "",

                    paymentMethod:
                        paymentMethod,

                    transactionId:
                        transactionId,

                    paymentReference:
                        paymentReference
                }
            );


            // ------------------------------------------
            // Validate before submitting
            // ------------------------------------------

            if (!paymentMethod) {

                event.preventDefault();

                alert(
                    "Please select a payment method."
                );

                return;

            }


            if (!transactionId) {

                event.preventDefault();

                alert(
                    "Transaction ID is missing."
                );

                return;

            }


            if (!paymentReference) {

                event.preventDefault();

                alert(
                    "Please enter your payment reference."
                );

                if (referenceInput) {
                    referenceInput.focus();
                }

                return;

            }


            // ------------------------------------------
            // Prevent double submission
            // ------------------------------------------

            if (confirmButton) {

                confirmButton.disabled = true;

                confirmButton.classList.add(
                    "processing"
                );

                confirmButton.innerHTML = `
                    <i class="fas fa-spinner fa-spin mr-2"></i>
                    Processing Payment...
                `;

            }

            // IMPORTANT:
            // Do NOT call event.preventDefault()
            // here. The form must submit normally.
        }
    );


    // ======================================================
    // INITIALIZE PAYMENT METHOD
    // ======================================================

    const activeButton =
        document.querySelector(
            ".payment-method-tab.active"
        );


    if (activeButton) {

        selectPaymentMethod(
            activeButton
        );

    }


    // ======================================================
    // INITIAL VALIDATION
    // ======================================================

    validatePaymentForm();


    console.log(
        "[Payment] Payment page initialized."
    );

});

