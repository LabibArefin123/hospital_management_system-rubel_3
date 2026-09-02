/** PATIENT USER AUTO FILL RESET */
(function (window, $) {
    "use strict";
    const PatientAutoFill = window.PatientAutoFill;

    PatientAutoFill.reset = function () {
        this.elements.form[0].reset();
        this.clearFields();

        this.elements.statusText
            .removeClass("text-success text-danger")
            .addClass("text-muted")
            .text("Select an appointment first.");

        this.elements.infoBox
            .removeClass("alert-success alert-danger")
            .addClass("alert-info").html(`
                <i class="fas fa-info-circle mr-1"></i>
                Select an appointment to fill patient information.
            `);

        this.elements.submitButton.prop("disabled", true);
    };

    PatientAutoFill.showSelected = function () {
        this.elements.statusText
            .removeClass("text-muted text-danger")
            .addClass("text-success")
            .text("Patient information loaded.");

        this.elements.infoBox
            .removeClass("alert-info alert-danger")
            .addClass("alert-success").html(`
                <i class="fas fa-check-circle mr-1"></i>
                Patient information loaded. You can edit the email address before saving.
            `);

        this.elements.submitButton.prop("disabled", false);
    };
})(window, jQuery);
