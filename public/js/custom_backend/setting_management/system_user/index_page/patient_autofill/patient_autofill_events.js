/** PATIENT USER AUTO FILL EVENTS */
(function (window, $) {
    "use strict";
    const PatientAutoFill = window.PatientAutoFill;

    PatientAutoFill.bindAppointmentChange = function () {
        this.elements.appointmentSelect.on("change", function () {
            const selected = $(this).find("option:selected");
            const appointmentId = $(this).val();

            if (!appointmentId) {
                PatientAutoFill.reset();
                return;
            }

            PatientAutoFill.fillFields({
                name: selected.attr("data-name") || "",
                phone: selected.attr("data-phone") || "",
                email: selected.attr("data-email") || "",
            });

            PatientAutoFill.showSelected();
        });
    };

    PatientAutoFill.bindModalClose = function () {
        this.elements.modal.on("hidden.bs.modal", function () {
            PatientAutoFill.reset();
        });
    };
})(window, jQuery);
