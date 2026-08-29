/**USER APPOINTMENT FORM AUTO FILL*/
(function (window) {
    "use strict";
    console.log("[User Form Fill] STATE 4: Main module loaded.");
    const FormFill = window.SusthoCareUserForm;

    if (!FormFill) {
        console.error(
            "[User Form Fill] ERROR: Required modules are not loaded.",
        );

        return;
    }

    const user = FormFill.user;

    /* USER DATA CHECK*/
    if (!user) {
        console.log("[User Form Fill] No user data found.");
        return;
    }

    /*AUTHENTICATION CHECK*/
    if (!user.authenticated) {
        console.log("[User Form Fill] Guest user. Auto-fill skipped.");
        return;
    }

    /* ROLE CHECK  */
    if (user.role !== "user") {
        console.log(
            "[User Form Fill] Current role is not 'user'. Auto-fill skipped.",
        );

        return;
    }

    /*INITIALIZE */
    function initialize() {
        FormFill.fillDoctorForm();
        FormFill.fillServiceForm();

        console.log(
            "[User Form Fill] STATE 5: Appointment information auto-filled.",
            {
                name: user.name,
                age: user.age,
                phone: user.phone,
                email: user.email,
            },
        );
    }

    /* DOCUMENT READY*/

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initialize);
    } else {
        initialize();
    }
})(window);
