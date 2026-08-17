/* =========================================================
   DOCTOR IMAGE INFORMATION
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById("doctorImageInput");

    const previewImage = document.getElementById("doctorPreviewImage");

    /*
    |--------------------------------------------------------------------------
    | FUNCTION : UPDATE IMAGE INFO
    |--------------------------------------------------------------------------
    */

    function updateImageInfo(file = null, imageSrc = null) {
        /*
        |--------------------------------------------------------------------------
        | FILE FROM INPUT
        |--------------------------------------------------------------------------
        */

        if (file) {
            // FILE NAME
            document.getElementById("imageFileName").innerText = file.name;

            // FILE SIZE
            const fileSizeKB = (file.size / 1024).toFixed(2);

            document.getElementById("imageFileSize").innerText =
                fileSizeKB + " KB";

            // FILE FORMAT
            const fileFormat = file.type.split("/")[1].toUpperCase();

            document.getElementById("imageFormat").innerText = fileFormat;

            // PREVIEW IMAGE
            const reader = new FileReader();

            reader.onload = function (event) {
                previewImage.src = event.target.result;

                loadImageDimensions(event.target.result);
            };

            reader.readAsDataURL(file);
        } else if (imageSrc) {
            /*
        |--------------------------------------------------------------------------
        | DEFAULT EXISTING IMAGE
        |--------------------------------------------------------------------------
        */
            // FILE NAME
            const imageName = imageSrc.split("/").pop();

            document.getElementById("imageFileName").innerText = imageName;

            // FORMAT
            const extension = imageName.split(".").pop().toUpperCase();

            document.getElementById("imageFormat").innerText = extension;

            // LOAD DIMENSIONS
            loadImageDimensions(imageSrc);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTION : LOAD IMAGE DIMENSIONS
    |--------------------------------------------------------------------------
    */

    function loadImageDimensions(src) {
        const img = new Image();

        img.onload = function () {
            const width = img.width;
            const height = img.height;

            // DIMENSIONS
            document.getElementById("imageDimensions").innerText =
                width + " × " + height + " px";

            /*
            |--------------------------------------------------------------------------
            | SHAPE
            |--------------------------------------------------------------------------
            */

            let shape = "";

            if (width === height) {
                shape = "Square";
            } else if (width > height) {
                shape = "Landscape Rectangle";
            } else {
                shape = "Portrait Rectangle";
            }

            document.getElementById("imageShape").innerText = shape;
        };

        img.src = src;
    }

    /*
    |--------------------------------------------------------------------------
    | DEFAULT PAGE LOAD IMAGE INFO
    |--------------------------------------------------------------------------
    */

    if (previewImage) {
        updateImageInfo(null, previewImage.src);
    }

    /*
    |--------------------------------------------------------------------------
    | IMAGE INPUT CHANGE
    |--------------------------------------------------------------------------
    */

    if (imageInput) {
        imageInput.addEventListener("change", function (e) {
            const file = e.target.files[0];

            if (!file) return;

            updateImageInfo(file);
        });
    }
});
