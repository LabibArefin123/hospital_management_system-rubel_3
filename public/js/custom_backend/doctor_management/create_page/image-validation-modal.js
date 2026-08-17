document.addEventListener("DOMContentLoaded", function () {
    let currentImage = null;

    const openBtn = document.getElementById("openImageModal");

    const input = document.getElementById("doctorImageInput");

    const preview = document.getElementById("imagePreview");

    const sizeEl = document.getElementById("imageSize");

    const typeEl = document.getElementById("imageType");

    const dimEl = document.getElementById("imageDimension");

    const shapeEl = document.getElementById("imageShape");

    /*
    |--------------------------------------------------------------------------
    | BLOCK ENTER SUBMIT
    |--------------------------------------------------------------------------
    */

    document.addEventListener("keydown", function (e) {
        if (e.key === "Enter") {
            const active = document.activeElement;

            if (active && active.tagName !== "TEXTAREA") {
                e.preventDefault();
            }
        }
    });

    /*
    |--------------------------------------------------------------------------
    | OPEN FILE PICKER
    |--------------------------------------------------------------------------
    */

    openBtn?.addEventListener("click", function () {
        input.click();
    });

    /*
    |--------------------------------------------------------------------------
    | IMAGE CHANGE
    |--------------------------------------------------------------------------
    */

    input?.addEventListener("change", function (e) {
        const file = e.target.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = function (event) {
            preview.src = event.target.result;

            currentImage = event.target.result;

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

            /*
            |--------------------------------------------------------------------------
            | SHOW COMPARE MODAL
            |--------------------------------------------------------------------------
            */

            document.getElementById("newImagePreview").src =
                event.target.result;

            document.getElementById("oldImagePreview").src = currentImage || "";

            $("#replaceImageModal").modal("show");
        };

        reader.readAsDataURL(file);

        sizeEl.innerText = (file.size / 1024).toFixed(2) + " KB";

        typeEl.innerText = file.type;
    });

    /*
    |--------------------------------------------------------------------------
    | CONFIRM IMAGE
    |--------------------------------------------------------------------------
    */

    document
        .getElementById("confirmReplaceBtn")
        ?.addEventListener("click", function () {
            $("#replaceImageModal").modal("hide");
        });

    /*
    |--------------------------------------------------------------------------
    | CANCEL IMAGE
    |--------------------------------------------------------------------------
    */

    document
        .getElementById("cancelImageBtn")
        ?.addEventListener("click", function () {
            input.value = "";

            preview.src = "";

            sizeEl.innerText = "-";

            typeEl.innerText = "-";

            dimEl.innerText = "-";

            shapeEl.innerText = "-";

            $("#replaceImageModal").modal("hide");
        });
});
