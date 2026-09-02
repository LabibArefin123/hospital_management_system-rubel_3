/** PATIENT USER AUTO FILL RESET */

(function (window, $) {
    "use strict";

    const PatientAutoFill = window.PatientAutoFill;

    PatientAutoFill.reset = function () {
        if (this.elements.form.length) {
            this.elements.form[0].reset();
        }

        this.clearFields();

        $("#patientUserPassword").val("");
        $("#patientUserPasswordConfirmation").val("");

        this.elements.infoBox
            .removeClass("alert-success alert-danger")
            .addClass("alert-info").html(`
                <i class="fas fa-info-circle mr-1"></i>
                Select an appointment to fill patient information.
            `);

        this.elements.submitButton.prop("disabled", true);
    };

    PatientAutoFill.showSelected = function () {
        this.elements.infoBox
            .removeClass("alert-info alert-danger")
            .addClass("alert-success").html(`
                <i class="fas fa-check-circle mr-1"></i>
                Patient information loaded. You can edit the email address before saving.
            `);

        this.elements.submitButton.prop("disabled", false);
    };
})(window, jQuery);
