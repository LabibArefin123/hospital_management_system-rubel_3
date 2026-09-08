document.addEventListener("DOMContentLoaded", function () {
    const doctorSelect = document.getElementById("doctorSelect");
    const previewImage = document.getElementById("doctorPreviewImage");
    const previewName = document.getElementById("doctorPreviewName");
    const previewSpeciality = document.getElementById(
        "doctorPreviewSpeciality",
    );
    const previewEmail = document.getElementById("doctorPreviewEmail");
    const previewUsername = document.getElementById("doctorPreviewUsername");
    const previewQualification = document.getElementById(
        "doctorPreviewQualification",
    );
    const previewExperience = document.getElementById(
        "doctorPreviewExperience",
    );
    const previewSuccessRate = document.getElementById(
        "doctorPreviewSuccessRate",
    );
    const previewTotalPatients = document.getElementById(
        "doctorPreviewTotalPatients",
    );
    const previewLocation = document.getElementById("doctorPreviewLocation");
    const previewConsultationFee = document.getElementById(
        "doctorPreviewConsultationFee",
    );
    const previewAvailability = document.getElementById(
        "doctorPreviewAvailability",
    );
    const previewAbout = document.getElementById("doctorPreviewAbout");
    function updateDoctorPreview() {
        const selectedOption = doctorSelect.options[doctorSelect.selectedIndex];
        if (!selectedOption || !selectedOption.value) {
            previewImage.src = "/uploads/images/default.jpg";
            previewName.innerText = "Doctor Name";
            previewSpeciality.innerText = "Speciality";
            previewEmail.innerText = "doctor@email.com";
            previewUsername.innerText = "username";
            previewQualification.innerText = "Qualification";
            previewExperience.innerText = "0 Years";
            previewSuccessRate.innerText = "0%";
            previewTotalPatients.innerText = "0";
            previewLocation.innerText = "Location";
            previewConsultationFee.innerText = "৳ 0";
            if (previewAvailability) previewAvailability.innerText = "N/A";
            previewAbout.innerText = "Doctor information will appear here.";
            return;
        }
        previewImage.src =
            selectedOption.dataset.image || "/uploads/images/default.jpg";
        previewName.innerText = selectedOption.dataset.name || "Doctor Name";
        previewSpeciality.innerText =
            selectedOption.dataset.speciality || "Speciality";
        previewEmail.innerText = selectedOption.dataset.email || "No Email";
        previewUsername.innerText =
            selectedOption.dataset.username || "No Username";
        previewQualification.innerText =
            selectedOption.dataset.qualification || "N/A";
        previewExperience.innerText =
            (selectedOption.dataset.experience || "0") + " Years";
        previewSuccessRate.innerText =
            (selectedOption.dataset.successRate || "0") + "%";
        previewTotalPatients.innerText =
            selectedOption.dataset.totalPatients || "0";
        previewLocation.innerText = selectedOption.dataset.location || "N/A";
        previewConsultationFee.innerText =
            "৳ " + (selectedOption.dataset.consultationFee || "0");
        if (previewAvailability)
            previewAvailability.innerText =
                selectedOption.dataset.availability || "N/A";
        previewAbout.innerText =
            selectedOption.dataset.about || "No information available.";
    }
    doctorSelect.addEventListener("change", updateDoctorPreview);
    updateDoctorPreview();
});
