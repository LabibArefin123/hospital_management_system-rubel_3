document.addEventListener("DOMContentLoaded", function () {
    const doctorSelect = document.getElementById("doctorSelect");

    const previewImage = document.getElementById("doctorPreviewImage");

    const previewName = document.getElementById("doctorPreviewName");

    const previewSpeciality = document.getElementById(
        "doctorPreviewSpeciality",
    );

    const previewEmail = document.getElementById("doctorPreviewEmail");

    const previewUsername = document.getElementById("doctorPreviewUsername");

    /*
    |--------------------------------------------------------------------------
    | UPDATE PREVIEW
    |--------------------------------------------------------------------------
    */

    function updateDoctorPreview() {
        const selectedOption = doctorSelect.options[doctorSelect.selectedIndex];

        if (!selectedOption.value) {
            previewImage.src = "/uploads/images/default.jpg";

            previewName.innerText = "Doctor Name";

            previewSpeciality.innerText = "Speciality";

            previewEmail.innerText = "doctor@email.com";

            previewUsername.innerText = "username";

            return;
        }

        previewImage.src = selectedOption.dataset.image;

        previewName.innerText = selectedOption.dataset.name;

        previewSpeciality.innerText = selectedOption.dataset.speciality;

        previewEmail.innerText = selectedOption.dataset.email;

        previewUsername.innerText = selectedOption.dataset.username;
    }

    /*
    |--------------------------------------------------------------------------
    | CHANGE EVENT
    |--------------------------------------------------------------------------
    */

    doctorSelect.addEventListener("change", updateDoctorPreview);

    /*
    |--------------------------------------------------------------------------
    | INITIAL LOAD (OLD VALUE)
    |--------------------------------------------------------------------------
    */

    updateDoctorPreview();
});
