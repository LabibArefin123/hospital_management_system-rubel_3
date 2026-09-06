/* APPOINTMENT SEARCH */
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("appointmentSearch");
    const doctorGrid = document.getElementById("doctorAppointmentGrid");
    const serviceGrid = document.getElementById("serviceAppointmentGrid");
    if (!searchInput) return;
    function normalize(value) {
        return String(value || "")
            .toLowerCase()
            .replace(/\s+/g, " ")
            .trim();
    }
    function getSearchableText(card) {
        return normalize(card.textContent);
    }
    function filterGrid(grid, query) {
        if (!grid) {
            return {
                total: 0,
                visible: 0,
            };
        }
        const cards = Array.from(grid.querySelectorAll(".appointment-card"));
        let visible = 0;
        cards.forEach(function (card) {
            const searchableText = getSearchableText(card);
            const matches = !query || searchableText.includes(query);
            card.style.display = matches ? "" : "none";
            if (matches) {
                visible++;
            }
        });
        return {
            total: cards.length,
            visible: visible,
        };
    }
    function getSection(grid) {
        if (!grid) return null;
        return grid.closest(".appointment-section");
    }
    function updateSection(section, result, type) {
        if (!section) return;
        const emptyText = section.querySelector(".empty-text");
        if (result.total === 0) {
            section.style.display = "";
            if (emptyText) {
                emptyText.style.display = "";
            }
            return;
        }
        if (result.visible === 0) {
            section.style.display = "none";
            return;
        }
        section.style.display = "";
        if (emptyText) {
            emptyText.style.display = "none";
        }
    }
    function getNoResultsElement() {
        let element = document.getElementById("appointmentSearchNoResults");
        if (element) return element;
        element = document.createElement("div");
        element.id = "appointmentSearchNoResults";
        element.className = "appointment-search-no-results";
        element.innerHTML =
            '<div class="appointment-search-no-results-icon">' +
            '<i class="fas fa-search"></i>' +
            "</div>" +
            "<h4>No appointments found</h4>" +
            "<p>Try searching with a different doctor, service, name, phone number, date, or status.</p>";
        const searchSection = searchInput.closest(".appointment-page-intro");
        const firstSection = document.querySelector(".appointment-section");
        if (firstSection && firstSection.parentNode) {
            firstSection.parentNode.insertBefore(element, firstSection);
        } else if (searchSection && searchSection.parentNode) {
            searchSection.parentNode.appendChild(element);
        }
        return element;
    }
    function updateNoResults(doctorResult, serviceResult, query) {
        const noResults = getNoResultsElement();
        if (!query) {
            noResults.style.display = "none";
            return;
        }
        const hasResults =
            doctorResult.visible > 0 || serviceResult.visible > 0;
        noResults.style.display = hasResults ? "none" : "";
    }
    function searchAppointments() {
        const query = normalize(searchInput.value);
        const doctorResult = filterGrid(doctorGrid, query);
        const serviceResult = filterGrid(serviceGrid, query);
        updateSection(getSection(doctorGrid), doctorResult, "doctor");
        updateSection(getSection(serviceGrid), serviceResult, "service");
        updateNoResults(doctorResult, serviceResult, query);
    }
    searchInput.addEventListener("input", searchAppointments);
    searchInput.addEventListener("search", searchAppointments);
    searchInput.addEventListener("change", searchAppointments);
});
