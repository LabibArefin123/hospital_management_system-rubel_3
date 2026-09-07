/* =========================================================
   DOCTOR DASHBOARD FILTER - CORE
========================================================= */
document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    /* ELEMENTS */
    window.DoctorFilter = {
        toggleBtn: document.getElementById("toggleFilterBtn"),
        filterSection: document.getElementById("filterSection"),
        filterArrow: document.getElementById("filterArrow"),

        patientInput: document.getElementById("searchPatient"),
        dateInput: document.getElementById("searchDate"),
        statusInput: document.getElementById("searchStatus"),
        resetBtn: document.getElementById("resetFilter"),

        countElement: document.getElementById("doctorAppointmentCount"),
        dataTable: document.getElementById("dataTables"),

        doctorAppointments: document.querySelectorAll(
            ".appointment-card[data-type='doctor']",
        ),

        latestAppointments: document.querySelectorAll(
            "#dataTables tbody tr.appointment-row",
        ),

        serverTotal: 0,
    };

    /* SERVER TOTAL */
    if (DoctorFilter.countElement) {
        const text = DoctorFilter.countElement.textContent.trim();
        const match = text.match(/\d+/);

        if (match) {
            DoctorFilter.serverTotal = parseInt(match[0], 10);
        }
    }

    /* FILTER VALUES */
    DoctorFilter.getValues = function () {
        return {
            patient:
                DoctorFilter.patientInput?.value.toLowerCase().trim() || "",
            date: DoctorFilter.dateInput?.value || "",
            status: DoctorFilter.statusInput?.value.toLowerCase().trim() || "",
        };
    };

    /* FILTER ACTIVE */
    DoctorFilter.isActive = function () {
        const filters = DoctorFilter.getValues();
        return (
            filters.patient !== "" ||
            filters.date !== "" ||
            filters.status !== ""
        );
    };

    /* MATCH APPOINTMENT */
    DoctorFilter.matches = function (element, filters) {
        const patient = (element.dataset.patient || "").toLowerCase().trim();
        const date = element.dataset.date || "";
        const status = (element.dataset.status || "").toLowerCase().trim();
        const matchPatient =
            filters.patient === "" || patient.includes(filters.patient);
        const matchDate = filters.date === "" || date === filters.date;
        const matchStatus = filters.status === "" || status === filters.status;
        return matchPatient && matchDate && matchStatus;
    };

    /* APPLY FILTER */
    DoctorFilter.apply = function () {
        const filters = DoctorFilter.getValues();

        document.dispatchEvent(
            new CustomEvent("doctorFilterChanged", {
                detail: filters,
            }),
        );
    };

    /* INPUT EVENTS */
    DoctorFilter.patientInput?.addEventListener("input", DoctorFilter.apply);
    DoctorFilter.dateInput?.addEventListener("change", DoctorFilter.apply);
    DoctorFilter.statusInput?.addEventListener("change", DoctorFilter.apply);
});
