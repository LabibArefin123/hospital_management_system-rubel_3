/** PATIENT USER AUTO FILL FIELDS */
(function (window, $) {
    "use strict";
    const PatientAutoFill = window.PatientAutoFill;

    PatientAutoFill.fillFields = function (data) {
        this.elements.nameInput.val(data.name || "");
        this.elements.phoneInput.val(data.phone || "");
        this.elements.emailInput.val(data.email || "");
    };

    PatientAutoFill.clearFields = function () {
        this.elements.nameInput.val("");
        this.elements.phoneInput.val("");
        this.elements.emailInput.val("");
    };
})(window, jQuery);
