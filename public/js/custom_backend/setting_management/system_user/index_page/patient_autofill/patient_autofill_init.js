/** PATIENT USER AUTO FILL INIT */
(function (window, $) {
    "use strict";
    $(document).ready(function () {
        const PatientAutoFill = window.PatientAutoFill;
        PatientAutoFill.initElements();

        if (!PatientAutoFill.elements.appointmentSelect.length) {
            return;
        }

        PatientAutoFill.bindAppointmentChange();
        PatientAutoFill.bindModalClose();
        PatientAutoFill.reset();
    });
})(window, jQuery);
