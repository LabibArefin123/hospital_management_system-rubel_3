export function initAppointmentFilter() {
    const searchInput = document.getElementById("dashboardSearch");
    const patientInput = document.getElementById("searchPatient");
    const statusFilter = document.getElementById("appointmentStatusFilter");
    const typeFilter = document.getElementById("appointmentTypeFilter");
    const dateFilter = document.getElementById("appointmentDateFilter");
    const appointmentCards = document.querySelectorAll(".appointment-card");
    const appointmentRows = document.querySelectorAll(".appointment-row");
    const doctorCountElement = document.getElementById(
        "doctorAppointmentCount",
    );
    const serviceCountElement = document.getElementById(
        "serviceAppointmentCount",
    );
    const totalCountElement = document.getElementById("totalAppointmentCount");
    const doctorSection = document.querySelector(".doctor-appointment-section");
    const serviceSection = document.querySelector(
        ".service-appointment-section",
    );
    function updateCount(element, count, label) {
        if (!element) return;
        element.textContent = count + " " + label + (count === 1 ? "" : "s");
    }
    function filterAppointments() {
        const search = searchInput?.value.toLowerCase().trim() || "";
        const patient = patientInput?.value.toLowerCase().trim() || "";
        const status = statusFilter?.value.toLowerCase() || "";
        const type = typeFilter?.value.toLowerCase() || "";
        const date = dateFilter?.value || "";
        let visibleDoctorCount = 0;
        let visibleServiceCount = 0;
        let visibleTotalCount = 0;
        appointmentCards.forEach(function (card) {
            const cardSearch = (card.dataset.search || "").toLowerCase();
            const cardPatient = (card.dataset.patient || "").toLowerCase();
            const cardType = (card.dataset.type || "").toLowerCase();
            const cardStatus = (card.dataset.status || "").toLowerCase();
            const cardDate = card.dataset.date || "";
            const matchSearch = search === "" || cardSearch.includes(search);
            const matchPatient =
                patient === "" || cardPatient.includes(patient);
            const matchStatus = status === "" || cardStatus === status;
            const matchType = type === "" || cardType === type;
            const matchDate = date === "" || cardDate === date;
            const visible =
                matchSearch &&
                matchPatient &&
                matchStatus &&
                matchType &&
                matchDate;
            card.style.display = visible ? "" : "none";
            if (visible) {
                visibleTotalCount++;
                if (cardType === "doctor") visibleDoctorCount++;
                if (cardType === "service") visibleServiceCount++;
            }
        });
        appointmentRows.forEach(function (row) {
            const rowPatient = (row.dataset.patient || "").toLowerCase();
            const rowStatus = (row.dataset.status || "").toLowerCase();
            const rowType = (row.dataset.type || "").toLowerCase();
            const rowDate = row.dataset.date || "";
            const rowSearch = (
                row.dataset.search ||
                row.innerText ||
                ""
            ).toLowerCase();
            const matchSearch = search === "" || rowSearch.includes(search);
            const matchPatient = patient === "" || rowPatient.includes(patient);
            const matchStatus = status === "" || rowStatus === status;
            const matchType = type === "" || rowType === type;
            const matchDate = date === "" || rowDate === date;
            const visible =
                matchSearch &&
                matchPatient &&
                matchStatus &&
                matchType &&
                matchDate;
            row.style.display = visible ? "" : "none";
        });
        updateCount(doctorCountElement, visibleDoctorCount, "Appointment");
        updateCount(serviceCountElement, visibleServiceCount, "Booking");
        if (totalCountElement)
            totalCountElement.textContent = visibleTotalCount;
        if (doctorSection) {
            doctorSection.style.display =
                type === "service" || visibleDoctorCount === 0 ? "none" : "";
        }
        if (serviceSection) {
            serviceSection.style.display =
                type === "doctor" || visibleServiceCount === 0 ? "none" : "";
        }
    }
    searchInput?.addEventListener("input", filterAppointments);
    patientInput?.addEventListener("input", filterAppointments);
    statusFilter?.addEventListener("change", filterAppointments);
    typeFilter?.addEventListener("change", filterAppointments);
    dateFilter?.addEventListener("change", filterAppointments);
    return filterAppointments;
}
