document.addEventListener("DOMContentLoaded", function () {
    let selectedFile = null;

    let currentImage = "";

    const openBtn = document.getElementById("openImageModal");

    const chooseBtn = document.getElementById("chooseImageBtn");

    const input = document.getElementById("doctorImageInput");

    const modalPreview = document.getElementById("modalImagePreview");

    const finalPreview = document.getElementById("finalPreviewImage");

    const oldPreview = document.getElementById("oldImagePreview");

    const newPreview = document.getElementById("newImagePreview");

    const sizeEl = document.getElementById("imageSize");

    const typeEl = document.getElementById("imageType");

    const dimEl = document.getElementById("imageDimension");

    const shapeEl = document.getElementById("imageShape");

    /*
    |--------------------------------------------------------------------------
    | OPEN MODAL
    |--------------------------------------------------------------------------
    */

    openBtn.addEventListener("click", function () {
        $("#imageUploadModal").modal("show");
    });

    /*
    |--------------------------------------------------------------------------
    | OPEN FILE PICKER
    |--------------------------------------------------------------------------
    */

    chooseBtn.addEventListener("click", function () {
        input.click();
    });

    /*
    |--------------------------------------------------------------------------
    | IMAGE CHANGE
    |--------------------------------------------------------------------------
    */

    input.addEventListener("change", function (e) {
        const file = e.target.files[0];

        if (!file) return;

        const allowed = ["image/jpeg", "image/jpg", "image/png", "image/webp"];

        if (!allowed.includes(file.type)) {
            alert("Only JPG, JPEG, PNG, WEBP allowed");

            input.value = "";

            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert("Image must be less than 2MB");

            input.value = "";

            return;
        }

        selectedFile = file;

        sizeEl.innerText = (file.size / 1024).toFixed(2) + " KB";

        typeEl.innerText = file.type;

        const reader = new FileReader();

        reader.onload = function (event) {
            modalPreview.src = event.target.result;

            modalPreview.classList.remove("d-none");

            const img = new Image();

            img.onload = function () {
                dimEl.innerText = `${img.width} x ${img.height}`;

                if (img.width > img.height) {
                    shapeEl.innerText = "Landscape";
                } else if (img.width < img.height) {
                    shapeEl.innerText = "Portrait";
                } else {
                    shapeEl.innerText = "Square";
                }
            };

            img.src = event.target.result;
        };

        reader.readAsDataURL(file);
    });

    /*
    |--------------------------------------------------------------------------
    | SAVE IMAGE
    |--------------------------------------------------------------------------
    */

    document
        .getElementById("saveImageBtn")
        .addEventListener("click", function () {
            if (!selectedFile) {
                alert("Please choose an image");

                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                oldPreview.src = currentImage || e.target.result;

                newPreview.src = e.target.result;

                $("#imageUploadModal").modal("hide");

                $("#replaceImageModal").modal("show");
            };

            reader.readAsDataURL(selectedFile);
        });

    /*
    |--------------------------------------------------------------------------
    | CONFIRM REPLACE
    |--------------------------------------------------------------------------
    */

    document
        .getElementById("confirmReplaceBtn")
        .addEventListener("click", function () {
            const reader = new FileReader();

            reader.onload = function (e) {
                finalPreview.src = e.target.result;

                finalPreview.classList.remove("d-none");

                currentImage = e.target.result;

                $("#replaceImageModal").modal("hide");
            };

            reader.readAsDataURL(selectedFile);
        });

    /*
    |--------------------------------------------------------------------------
    | CANCEL IMAGE
    |--------------------------------------------------------------------------
    */

    document
        .getElementById("cancelImageBtn")
        .addEventListener("click", function () {
            selectedFile = null;

            input.value = "";

            modalPreview.src = "";

            modalPreview.classList.add("d-none");

            sizeEl.innerText = "-";

            typeEl.innerText = "-";

            dimEl.innerText = "-";

            shapeEl.innerText = "-";
        });
});
