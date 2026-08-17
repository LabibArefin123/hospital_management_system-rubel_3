document.addEventListener("DOMContentLoaded", function () {
    /*
    |--------------------------------------------------------------------------
    | CURRENT IMAGE INFO
    |--------------------------------------------------------------------------
    */

    const currentImage = document.getElementById("currentServiceImage");

    if (currentImage) {
        const imageUrl = currentImage.dataset.imageUrl;

        /*
        |--------------------------------------------------------------------------
        | FILE NAME
        |--------------------------------------------------------------------------
        */

        const fileName = imageUrl.split("/").pop();

        document.getElementById("currentImageName").innerText = fileName;

        /*
        |--------------------------------------------------------------------------
        | FILE TYPE
        |--------------------------------------------------------------------------
        */

        const extension = fileName.split(".").pop().toUpperCase();

        document.getElementById("currentImageType").innerText = extension;

        /*
        |--------------------------------------------------------------------------
        | IMAGE DIMENSIONS
        |--------------------------------------------------------------------------
        */

        const img = new Image();

        img.onload = function () {
            const width = img.width;

            const height = img.height;

            document.getElementById("currentImageDimension").innerText =
                `${width} x ${height}`;

            /*
            |--------------------------------------------------------------------------
            | IMAGE SHAPE
            |--------------------------------------------------------------------------
            */

            let shape = "Square";

            if (width > height) {
                shape = "Horizontal Rectangle";
            } else if (height > width) {
                shape = "Vertical Rectangle";
            }

            document.getElementById("currentImageShape").innerText = shape;
        };

        img.src = imageUrl;

        /*
        |--------------------------------------------------------------------------
        | FILE SIZE
        |--------------------------------------------------------------------------
        */

        fetch(imageUrl)
            .then((response) => response.blob())
            .then((blob) => {
                const sizeKB = (blob.size / 1024).toFixed(2);

                document.getElementById("currentImageSize").innerText =
                    `${sizeKB} KB`;
            });
    }

    /*
    |--------------------------------------------------------------------------
    | NEW IMAGE INFO
    |--------------------------------------------------------------------------
    */

    const fileInput = document.getElementById("doctorImageInput");

    fileInput?.addEventListener("change", function (e) {
        const file = e.target.files[0];

        if (!file) return;

        document
            .getElementById("newImageInfoWrapper")
            .classList.remove("d-none");

        /*
        |--------------------------------------------------------------------------
        | FILE NAME
        |--------------------------------------------------------------------------
        */

        document.getElementById("newImageName").innerText = file.name;

        /*
        |--------------------------------------------------------------------------
        | FILE SIZE
        |--------------------------------------------------------------------------
        */

        document.getElementById("newImageSize").innerText =
            `${(file.size / 1024).toFixed(2)} KB`;

        /*
        |--------------------------------------------------------------------------
        | FILE TYPE
        |--------------------------------------------------------------------------
        */

        document.getElementById("newImageType").innerText = file.type;

        /*
        |--------------------------------------------------------------------------
        | IMAGE DIMENSION + SHAPE
        |--------------------------------------------------------------------------
        */

        const reader = new FileReader();

        reader.onload = function (event) {
            const img = new Image();

            img.onload = function () {
                const width = img.width;

                const height = img.height;

                document.getElementById("newImageDimension").innerText =
                    `${width} x ${height}`;

                let shape = "Square";

                if (width > height) {
                    shape = "Horizontal Rectangle";
                } else if (height > width) {
                    shape = "Vertical Rectangle";
                }

                document.getElementById("newImageShape").innerText = shape;
            };

            img.src = event.target.result;
        };

        reader.readAsDataURL(file);
    });
});
