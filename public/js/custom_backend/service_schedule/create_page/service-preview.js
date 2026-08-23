$(document).ready(function () {
    "use strict";
    const $serviceSelect = $("#serviceSelect");
    const $image = $("#servicePreviewImage");
    const $title = $("#servicePreviewTitle");
    const $price = $("#servicePreviewPrice");
    const $description = $("#servicePreviewDescription");
    const $id = $("#servicePreviewId");
    $image.css({
        width: "140px",
        height: "140px",
        "object-fit": "cover",
        "object-position": "center",
        display: "block",
        margin: "0 auto",
    });
    function updateServicePreview() {
        const $selected = $serviceSelect.find("option:selected");
        if (!$selected.val()) {
            $image.attr("src", "/uploads/images/default.jpg");
            $title.text("Service Title");
            $price.text("Price");
            $description.text("Service description");
            $id.text("---");
            return;
        }
        $image.attr(
            "src",
            $selected.data("image") || "/uploads/images/default.jpg",
        );
        $title.text($selected.data("title") || "Service Title");
        $price.text(
            $selected.data("price") ? "৳ " + $selected.data("price") : "Price",
        );
        $description.text(
            $selected.data("description") || "No description available.",
        );
        $id.text($selected.val());
    }
    $serviceSelect.on("change", updateServicePreview);
    updateServicePreview();
});
