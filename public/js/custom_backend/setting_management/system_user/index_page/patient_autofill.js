/** PATIENT USER AUTO FILL*/

(function ($) {
    "use strict";
    $(document).ready(function () {
        const appointmentSelect = $("#patientAppointment");
        const userSelect = $("#patientUser");
        const nameInput = $("#patientUserName");
        const phoneInput = $("#patientUserPhone");
        const emailInput = $("#patientUserEmail");
        const statusText = $("#patientUserStatus");
        const infoBox = $("#patientUserInfo");
        const submitButton = $("#patientUserSubmit");

        if (!appointmentSelect.length) {
            return;
        }

        /*Reset user fields */
        function resetUserFields() {
            userSelect.html(`
                <option value="">
                    Select existing user
                </option>
            `);

            nameInput.val("");
            phoneInput.val("");
            emailInput.val("");

            statusText
                .removeClass("text-success text-danger")
                .addClass("text-muted")
                .text("Select an appointment first.");

            infoBox
                .removeClass("alert-success alert-danger")
                .addClass("alert-info").html(`
                    <i class="fas fa-info-circle mr-1"></i>
                    Select an appointment to find the existing user.
                `);

            submitButton.prop("disabled", true);
        }

        /* Find existing user  */
        function findExistingUser(appointmentId, userId, name, phone, email) {
            /* Appointment already has user_id */
            if (userId) {
                $.ajax({
                    url: `/system_users/patient-user/find/${userId}`,
                    type: "GET",
                    dataType: "json",

                    beforeSend: function () {
                        statusText
                            .removeClass("text-success text-danger")
                            .addClass("text-muted")
                            .text("Finding existing user...");

                        submitButton.prop("disabled", true);
                    },

                    success: function (response) {
                        if (!response.success) {
                            showError("Existing user could not be found.");
                            return;
                        }

                        addUserOption(response.user);
                        fillUserFields(response.user);
                        showSuccess("Existing user found.");
                    },

                    error: function () {
                        showError("Unable to find the existing user.");
                    },
                });

                return;
            }

            /*Appointment has no user_id. - Search by phone/email.  */
            $.ajax({
                url: "/system_users/patient-user/find",
                type: "GET",
                dataType: "json",
                data: {
                    appointment_id: appointmentId,
                    phone: phone,
                    email: email,
                },

                beforeSend: function () {
                    statusText
                        .removeClass("text-success text-danger")
                        .addClass("text-muted")
                        .text("Searching existing users...");

                    submitButton.prop("disabled", true);
                },

                success: function (response) {
                    if (!response.success || !response.user) {
                        showError(
                            "No existing user was found for this appointment.",
                        );

                        return;
                    }

                    addUserOption(response.user);
                    fillUserFields(response.user);
                    showSuccess(
                        "Existing user found using appointment information.",
                    );
                },

                error: function () {
                    showError("Unable to search for the existing user.");
                },
            });
        }

        /*Add user to select */
        function addUserOption(user) {
            userSelect.html("");
            const option = $("<option>", {
                value: user.id,

                text: user.name + (user.phone ? " - " + user.phone : ""),
            });

            userSelect.append(option);
            userSelect.val(user.id);
        }

        /* Fill user information */
        function fillUserFields(user) {
            nameInput.val(user.name || "");
            phoneInput.val(user.phone || "");
            emailInput.val(user.email || "");
        }

        /* Success  */
        function showSuccess(message) {
            statusText
                .removeClass("text-muted text-danger")
                .addClass("text-success")
                .text(message);

            infoBox
                .removeClass("alert-info alert-danger")
                .addClass("alert-success").html(`
                    <i class="fas fa-check-circle mr-1"></i>
                    ${message}
                `);

            submitButton.prop("disabled", false);
        }

        /*Error */
        function showError(message) {
            userSelect.html(`
                <option value="">
                    No existing user found
                </option>
            `);

            nameInput.val("");
            phoneInput.val("");
            emailInput.val("");

            statusText
                .removeClass("text-muted text-success")
                .addClass("text-danger")
                .text(message);

            infoBox
                .removeClass("alert-info alert-success")
                .addClass("alert-danger").html(`
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    ${message}
                `);

            submitButton.prop("disabled", true);
        }

        /*Appointment changed */
        appointmentSelect.on("change", function () {
            const selected = $(this).find("option:selected");
            const appointmentId = $(this).val();
            if (!appointmentId) {
                resetUserFields();
                return;
            }

            const userId = selected.data("user-id") || "";
            const name = selected.data("name") || "";
            const phone = selected.data("phone") || "";
            const email = selected.data("email") || "";
            findExistingUser(appointmentId, userId, name, phone, email);
        });

        /* Reset modal when closed */
        $("#patientUserModal").on("hidden.bs.modal", function () {
            $("#patientUserForm")[0].reset();

            resetUserFields();
        });

        /* Initial state  */
        resetUserFields();
    });
})(jQuery);
