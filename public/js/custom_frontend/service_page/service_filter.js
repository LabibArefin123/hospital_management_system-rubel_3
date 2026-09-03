document.addEventListener("DOMContentLoaded", function () {
    const serviceSearch = document.getElementById("serviceSearch");
    const serviceGrid = document.getElementById("serviceGrid");
    const serviceNoResults = document.getElementById("serviceNoResults");
    if (!serviceSearch || !serviceGrid) {
        return;
    }

    const serviceCards = serviceGrid.querySelectorAll(
        ".service-page-layout-card",
    );

    serviceSearch.addEventListener("input", function () {
        const searchValue = this.value.trim().toLowerCase();

        let visibleCount = 0;

        serviceCards.forEach(function (card) {
            const serviceTitle = card.getAttribute("data-service-title") || "";

            if (serviceTitle.includes(searchValue)) {
                card.style.display = "";
                visibleCount++;
            } else {
                card.style.display = "none";
            }
        });

        if (serviceNoResults) {
            serviceNoResults.style.display =
                visibleCount === 0 ? "block" : "none";
        }
    });
});
