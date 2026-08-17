$(function () {
    "use strict";

    const input = $("#systemSearchInput");
    const results = $("#systemSearchResults");
    const loading = $("#systemSearchLoading");
    const empty = $("#systemSearchEmpty");

    const patientResults = $("#systemPatientResults");
    const doctorResults = $("#systemDoctorResults");

    const patientList = $("#systemPatientList");
    const doctorList = $("#systemDoctorList");

    const clearButton = $("#systemSearchClear");

    let searchTimer = null;
    let request = null;

    /*
    |--------------------------------------------------------------------------
    | SEARCH URL
    |--------------------------------------------------------------------------
    */

    const searchUrl = window.systemSearchUrl;

    if (!searchUrl) {
        console.error("System Search: window.systemSearchUrl is not defined.");

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | ESCAPE HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {
        return $("<div>")
            .text(value ?? "")
            .html();
    }

    /*
    |--------------------------------------------------------------------------
    | RESET
    |--------------------------------------------------------------------------
    */

    function resetResults() {
        patientList.html("");
        doctorList.html("");

        patientResults.addClass("d-none");
        doctorResults.addClass("d-none");

        empty.addClass("d-none");
        loading.addClass("d-none");
    }

    /*
    |--------------------------------------------------------------------------
    | RENDER PATIENTS
    |--------------------------------------------------------------------------
    */

    function renderPatients(patients) {
        patientList.html("");

        if (!patients || !patients.length) {
            patientResults.addClass("d-none");

            return;
        }

        let html = "";

        $.each(patients, function (index, patient) {
            html += `
                <div class="system-result-item">

                    <img
                        src="${escapeHtml(patient.photo)}"
                        class="system-result-photo"
                        alt="${escapeHtml(patient.name)}"
                    >

                    <div class="system-result-info">

                        <div class="system-result-name">
                            ${escapeHtml(patient.name)}
                        </div>

                        <div class="system-result-meta">

                            <i class="fas fa-id-card mr-1"></i>
                            ${escapeHtml(patient.patient_code)}

                            &nbsp;&nbsp;

                            <i class="fas fa-phone mr-1"></i>
                            ${escapeHtml(patient.phone)}

                        </div>

                        <div class="system-result-meta">

                            <i class="fas fa-envelope mr-1"></i>
                            ${escapeHtml(patient.email)}

                            &nbsp;&nbsp;

                            <i class="fas fa-calendar mr-1"></i>
                            ${escapeHtml(patient.created_at)}

                        </div>

                    </div>

                    ${
                        patient.url
                            ? `
                                <a
                                    href="${escapeHtml(patient.url)}"
                                    class="system-result-link"
                                >
                                    View
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            `
                            : ""
                    }

                </div>
            `;
        });

        patientList.html(html);

        patientResults.removeClass("d-none");
    }

    /*
    |--------------------------------------------------------------------------
    | RENDER DOCTORS
    |--------------------------------------------------------------------------
    */

    function renderDoctors(doctors) {
        doctorList.html("");

        if (!doctors || !doctors.length) {
            doctorResults.addClass("d-none");

            return;
        }

        let html = "";

        $.each(doctors, function (index, doctor) {
            html += `
                <div class="system-result-item">

                    <img
                        src="${escapeHtml(doctor.image)}"
                        class="system-result-photo"
                        alt="${escapeHtml(doctor.name)}"
                    >

                    <div class="system-result-info">

                        <div class="system-result-name">
                            ${escapeHtml(doctor.name)}
                        </div>

                        <div class="system-result-meta">

                            <i class="fas fa-stethoscope mr-1"></i>
                            ${escapeHtml(doctor.speciality)}

                            &nbsp;&nbsp;

                            <i class="fas fa-briefcase mr-1"></i>
                            ${escapeHtml(doctor.experience_years)}
                            Years Experience

                        </div>

                        <div class="system-result-meta">

                            <i class="fas fa-phone mr-1"></i>
                            ${escapeHtml(doctor.phone)}

                            &nbsp;&nbsp;

                            <i class="fas fa-envelope mr-1"></i>
                            ${escapeHtml(doctor.email)}

                        </div>

                    </div>

                    ${
                        doctor.url
                            ? `
                                <a
                                    href="${escapeHtml(doctor.url)}"
                                    class="system-result-link"
                                >
                                    View
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            `
                            : ""
                    }

                </div>
            `;
        });

        doctorList.html(html);

        doctorResults.removeClass("d-none");
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX SEARCH
    |--------------------------------------------------------------------------
    */

    function searchData() {
        const search = $.trim(input.val());

        clearTimeout(searchTimer);

        if (request) {
            request.abort();
            request = null;
        }

        if (search.length < 2) {
            results.addClass("d-none");

            clearButton.addClass("d-none");

            resetResults();

            return;
        }

        clearButton.removeClass("d-none");

        results.removeClass("d-none");

        resetResults();

        loading.removeClass("d-none");

        request = $.ajax({
            url: searchUrl,

            type: "GET",

            data: {
                search: search,
            },

            dataType: "json",

            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },

            success: function (response) {
                loading.addClass("d-none");

                if (!response || !response.status) {
                    empty.removeClass("d-none");

                    return;
                }

                const patients = response.patients || [];

                const doctors = response.doctors || [];

                renderPatients(patients);

                renderDoctors(doctors);

                if (patients.length === 0 && doctors.length === 0) {
                    empty.removeClass("d-none");
                }
            },

            error: function (xhr, status) {
                if (status === "abort") {
                    return;
                }

                console.error("System Search Error:", xhr.responseText);

                loading.addClass("d-none");

                empty.removeClass("d-none");
            },

            complete: function () {
                request = null;
            },
        });
    }

    /*
    |--------------------------------------------------------------------------
    | LIVE SEARCH
    |--------------------------------------------------------------------------
    */

    input.on("input", function () {
        clearTimeout(searchTimer);

        searchTimer = setTimeout(function () {
            searchData();
        }, 350);
    });

    /*
    |--------------------------------------------------------------------------
    | CLEAR
    |--------------------------------------------------------------------------
    */

    clearButton.on("click", function () {
        input.val("").focus();

        results.addClass("d-none");

        clearButton.addClass("d-none");

        resetResults();
    });

    /*
    |--------------------------------------------------------------------------
    | OUTSIDE CLICK
    |--------------------------------------------------------------------------
    */

    $(document).on("click", function (e) {
        if (!$(e.target).closest(".system-search-bar").length) {
            results.addClass("d-none");
        }
    });

    /*
    |--------------------------------------------------------------------------
    | FOCUS
    |--------------------------------------------------------------------------
    */

    input.on("focus", function () {
        if ($.trim(input.val()).length >= 2) {
            results.removeClass("d-none");
        }
    });
});
