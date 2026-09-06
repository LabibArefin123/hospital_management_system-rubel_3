document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById("serviceImageInput");
    const imagePreview = document.getElementById("serviceImagePreview");
    const imageName = document.getElementById("serviceImageName");

    if (!imageInput || !imagePreview || !imageName) {
        return;
    }

    const defaultImage = imagePreview.getAttribute("src");

    imageInput.addEventListener("change", function () {
        const file = this.files && this.files[0];

        if (!file) {
            imagePreview.src = defaultImage;
            imageName.textContent = "No image selected";
            return;
        }

        if (!file.type.startsWith("image/")) {
            imageInput.value = "";
            imagePreview.src = defaultImage;
            imageName.textContent = "No image selected";
            return;
        }

        imageName.textContent = file.name;

        const reader = new FileReader();

        reader.onload = function (event) {
            imagePreview.src = event.target.result;
        };

        reader.onerror = function () {
            imageInput.value = "";
            imagePreview.src = defaultImage;
            imageName.textContent = "Unable to preview image";
        };

        reader.readAsDataURL(file);
    });
});
