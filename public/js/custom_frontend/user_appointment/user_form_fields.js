/*  USER FORM FIELDS */
(function (window) {
    "use strict";
    const FormFill = window.SusthoCareUserForm;
    if (!FormFill) {
        console.error("[User Form Fill] ERROR: Form modules not loaded.");

        return;
    }

    const user = FormFill.user;

    /* DOCTOR FORM */
    FormFill.fillDoctorForm = function () {
        if (!user) {
            return;
        }

        FormFill.fillIfEmpty("#name", user.name);
        FormFill.fillIfEmpty("#age", user.age);
        FormFill.fillIfEmpty("#phone", user.phone);
        FormFill.fillIfEmpty("#email", user.email);
        FormFill.fillIfEmpty("#gender", user.gender);
    };

    /* SERVICE FORM */
    FormFill.fillServiceForm = function () {
        if (!user) {
            return;
        }

        FormFill.fillIfEmpty("#serviceName", user.name);
        FormFill.fillIfEmpty("#serviceAge", user.age);
        FormFill.fillIfEmpty("#servicePhone", user.phone);
        FormFill.fillIfEmpty("#serviceEmail", user.email);
        FormFill.fillIfEmpty("#serviceGender", user.gender);
    };
})(window);
