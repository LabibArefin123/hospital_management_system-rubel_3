/** PATIENT USER AUTO FILL CORE */
(function (window, $) {
    "use strict";
    window.PatientAutoFill = window.PatientAutoFill || {};
    PatientAutoFill.elements = {};
    PatientAutoFill.initElements = function () {
        this.elements.appointmentSelect = $("#patientAppointment");
        this.elements.nameInput = $("#patientUserName");
        this.elements.phoneInput = $("#patientUserPhone");
        this.elements.emailInput = $("#patientUserEmail");
        this.elements.infoBox = $("#patientUserInfo");
        this.elements.submitButton = $("#patientUserSubmit");
        this.elements.modal = $("#patientUserModal");
        this.elements.form = $("#patientUserForm");
    };
})(window, jQuery);
