document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    const imageInput = document.getElementById("profile_picture");
    const imagePreview = document.getElementById("profileImagePreview");
    const previewEmpty = document.getElementById("profileImagePreviewEmpty");

    if (!imageInput || !imagePreview || !previewEmpty) {
        return;
    }

    imageInput.addEventListener("change", function () {
        const file = this.files && this.files[0];

        if (!file) {
            imagePreview.src = "";
            imagePreview.style.display = "none";
            previewEmpty.style.display = "flex";
            return;
        }

        if (!file.type.startsWith("image/")) {
            this.value = "";

            imagePreview.src = "";
            imagePreview.style.display = "none";
            previewEmpty.style.display = "flex";

            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            imagePreview.src = event.target.result;

            imagePreview.style.display = "block";
            previewEmpty.style.display = "none";
        };

        reader.readAsDataURL(file);
    });
});
