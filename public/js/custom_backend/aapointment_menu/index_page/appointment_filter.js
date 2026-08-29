document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const statusFilter = document.getElementById("statusFilter");
    const typeFilter = document.getElementById("typeFilter");
    const cards = document.querySelectorAll(".appointment-card");
    function filterAppointments() {
        const search = searchInput.value.toLowerCase();
        const status = statusFilter.value.toLowerCase();
        const type = typeFilter.value.toLowerCase();
        cards.forEach((card) => {
            const cardSearch = card.dataset.search;
            const cardStatus = card.dataset.status;
            const cardType = card.dataset.type;
            const matchSearch = cardSearch.includes(search);
            const matchStatus = !status || cardStatus === status;
            const matchType = !type || cardType === type;
            if (matchSearch && matchStatus && matchType) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    }

    searchInput.addEventListener("keyup", filterAppointments);
    statusFilter.addEventListener("change", filterAppointments);
    typeFilter.addEventListener("change", filterAppointments);
});
