document.addEventListener("DOMContentLoaded", function () {
    let selectedAppointmentId = null;

    document.querySelectorAll(".appointment-status").forEach(function (select) {
        select.addEventListener("change", function () {
            const appointmentId = this.dataset.id;

            const selectedStatus = this.value;

            const currentStatus = this.dataset.current;

            /*
                        |--------------------------------------------------------------------------
                        | MODAL TEXT
                        |--------------------------------------------------------------------------
                        */

            document.getElementById("statusChangeText").innerText =
                `Do you want to change status to "${selectedStatus}" ?`;

            /*
                        |--------------------------------------------------------------------------
                        | FORM ACTION
                        |--------------------------------------------------------------------------
                        */

            document.getElementById("statusChangeForm").action =
                `/appointments/change-status/${appointmentId}`;

            /*
                        |--------------------------------------------------------------------------
                        | STATUS VALUE
                        |--------------------------------------------------------------------------
                        */

            document.getElementById("selectedStatus").value = selectedStatus;

            /*
                        |--------------------------------------------------------------------------
                        | SHOW MODAL
                        |--------------------------------------------------------------------------
                        */

            $("#statusChangeModal").modal("show");

            /*
                        |--------------------------------------------------------------------------
                        | RESET ON CANCEL
                        |--------------------------------------------------------------------------
                        */

            $("#statusChangeModal").on("hidden.bs.modal", function () {
                select.value = currentStatus;
            });
        });
    });
});
