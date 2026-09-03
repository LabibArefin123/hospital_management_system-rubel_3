document.addEventListener("DOMContentLoaded", function () {
    const doctorSearch = document.getElementById("doctorSearch");
    const doctorGrid = document.getElementById("doctorGrid");

    if (!doctorSearch || !doctorGrid) {
        return;
    }

    const doctorCards = doctorGrid.querySelectorAll(".doctor-card");

    doctorSearch.addEventListener("input", function () {
        const value = this.value.trim().toLowerCase();

        doctorCards.forEach(function (card) {
            const text = card.innerText.toLowerCase();

            if (text.includes(value)) {
                card.classList.remove("doctor-card-hidden");
            } else {
                card.classList.add("doctor-card-hidden");
            }
        });
    });
});
