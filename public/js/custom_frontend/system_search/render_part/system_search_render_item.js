/* SYSTEM SEARCH RESULT ITEM */

(function (window, $) {
    "use strict";
    console.log("[System Search] STATE 4B: Item renderer module loaded.");
    if (!window.SystemSearch) {
        console.error(
            "[System Search] ITEM ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    /*CREATE RESULT HTML */
    window.SystemSearch.createResultHtml = function (item) {
        const name = window.SystemSearch.escape(item.name || "-");

        /*DOCTOR RESULT  */
        if (item.type === "doctor") {
            const image = window.SystemSearch.escapeAttribute(
                item.image || window.SystemSearch.defaultImage,
            );
            const qualification = window.SystemSearch.escape(
                item.qualification || "",
            );
            const speciality = window.SystemSearch.escape(
                item.speciality || "",
            );

            const experience =
                item.experience_years !== null &&
                item.experience_years !== undefined &&
                item.experience_years !== ""
                    ? window.SystemSearch.escape(item.experience_years)
                    : "";

            const location = window.SystemSearch.escape(item.location || "");

            const successRate =
                item.success_rate !== null &&
                item.success_rate !== undefined &&
                item.success_rate !== ""
                    ? window.SystemSearch.escape(item.success_rate)
                    : "";

            const totalPatients =
                item.total_patients !== null &&
                item.total_patients !== undefined &&
                item.total_patients !== ""
                    ? window.SystemSearch.escape(item.total_patients)
                    : "";

            const consultationFee =
                item.consultation_fee !== null &&
                item.consultation_fee !== undefined &&
                item.consultation_fee !== ""
                    ? window.SystemSearch.escape(item.consultation_fee)
                    : "";

            const availability = window.SystemSearch.escape(
                item.availability || "",
            );

            let about = item.about || "";

            /*
             * Keep About short inside search result.
             */

            if (about.length > 180) {
                about = about.substring(0, 180) + "...";
            }

            about = window.SystemSearch.escape(about);

            return `
                <a
                    href="${window.SystemSearch.escapeAttribute(
                        item.url || "#",
                    )}"
                    class="system-search-result-item doctor-search-card"
                    data-result-type="doctor"
                >

                    <div class="doctor-search-card-inner">

                        <!-- Doctor Image -->

                        <div class="doctor-search-image-wrapper">

                            <img
                                src="${image}"
                                alt="${name}"
                                class="doctor-search-image"
                                onerror="this.onerror=null;this.src='${window.SystemSearch.escapeAttribute(
                                    window.SystemSearch.defaultImage,
                                )}'"
                            >

                            <span class="doctor-search-online-dot"></span>

                        </div>

                        <!-- Doctor Information -->

                        <div class="doctor-search-information">

                            <div class="doctor-search-heading">

                                <div class="doctor-search-name-area">

                                    ${
                                        qualification
                                            ? `
                                                <span class="doctor-search-qualification">
                                                    ${qualification}
                                                </span>
                                            `
                                            : ""
                                    }

                                    <h4 class="doctor-search-name">
                                        ${name}
                                    </h4>

                                    ${
                                        speciality
                                            ? `
                                                <span class="doctor-search-speciality-title">
                                                    <i class="fas fa-stethoscope"></i>
                                                    ${speciality}
                                                </span>
                                            `
                                            : ""
                                    }

                                </div>

                                <span class="doctor-search-view">
                                    View Profile
                                    <i class="fas fa-arrow-right"></i>
                                </span>

                            </div>

                            ${
                                about
                                    ? `
                                        <p class="doctor-search-about">
                                            ${about}
                                        </p>
                                    `
                                    : ""
                            }

                            <div class="doctor-search-details">
                                ${
                                    experience
                                        ? `
                                            <span class="doctor-search-detail">
                                                <i class="fas fa-briefcase"></i>
                                                <strong>${experience}</strong>
                                                <small>Years Experience</small>
                                            </span>
                                        `
                                        : ""
                                }

                                ${
                                    successRate
                                        ? `
                                            <span class="doctor-search-detail">
                                                <i class="fas fa-chart-line"></i>
                                                <strong>${successRate}%</strong>
                                                <small>Success Rate</small>
                                            </span>
                                        `
                                        : ""
                                }

                                ${
                                    totalPatients
                                        ? `
                                            <span class="doctor-search-detail">
                                                <i class="fas fa-users"></i>
                                                <strong>${totalPatients}</strong>
                                                <small>Patients</small>
                                            </span>
                                        `
                                        : ""
                                }

                                ${
                                    consultationFee
                                        ? `
                                            <span class="doctor-search-detail">
                                                <i class="fas fa-money-bill-wave"></i>
                                                <strong>${consultationFee}</strong>
                                                <small>Consultation</small>
                                            </span>
                                        `
                                        : ""
                                }

                                ${
                                    location
                                        ? `
                                            <span class="doctor-search-detail doctor-search-location">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <strong>${location}</strong>
                                                <small>Location</small>
                                            </span>
                                        `
                                        : ""
                                }

                                ${
                                    availability
                                        ? `
                                            <span class="doctor-search-detail">
                                                <i class="fas fa-calendar-check"></i>
                                                <strong>${availability}</strong>
                                                <small>Availability</small>
                                            </span>
                                        `
                                        : ""
                                }
                            </div>
                        </div>
                    </div>
                </a>
            `;
        }

        /* CONTACT RESULT */
        if (item.type === "contact") {
            const email = window.SystemSearch.escape(item.email || "");
            const phone = window.SystemSearch.escape(item.phone || "");

            const department = window.SystemSearch.escape(
                item.department || "",
            );

            const service = window.SystemSearch.escape(item.service || "");

            const message = window.SystemSearch.escape(item.message || "");

            const date = window.SystemSearch.escape(item.date || "-");

            return `
        <div
            class="system-search-result-item contact-search-card"
            data-result-type="contact"
        >

            <div class="contact-search-inner">

                <!-- Contact Icon -->

                <div class="contact-search-icon-wrapper">

                    <div class="contact-search-icon">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>

                </div>

                <!-- Contact Information -->

                <div class="contact-search-information">

                    <div class="contact-search-heading">

                        <div class="contact-search-name-area">

                            <span class="contact-search-type">
                                <i class="fas fa-address-book"></i>
                                Contact Request
                            </span>

                            <h4 class="contact-search-name">
                                ${name}
                            </h4>

                        </div>

                        <span class="contact-search-date">
                            <i class="far fa-calendar-alt"></i>
                            ${date}
                        </span>

                    </div>

                    <!-- Contact Details -->

                    <div class="contact-search-details">

                        ${
                            email
                                ? `
                                    <div class="contact-search-detail">
                                        <i class="fas fa-envelope"></i>
                                        <span>${email}</span>
                                    </div>
                                `
                                : ""
                        }

                        ${
                            phone
                                ? `
                                    <div class="contact-search-detail">
                                        <i class="fas fa-phone-alt"></i>
                                        <span>${phone}</span>
                                    </div>
                                `
                                : ""
                        }

                        ${
                            department
                                ? `
                                    <div class="contact-search-detail">
                                        <i class="fas fa-hospital"></i>
                                        <span>${department}</span>
                                    </div>
                                `
                                : ""
                        }

                        ${
                            service
                                ? `
                                    <div class="contact-search-detail">
                                        <i class="fas fa-stethoscope"></i>
                                        <span>${service}</span>
                                    </div>
                                `
                                : ""
                        }

                    </div>

                    <!-- Contact Message -->

                    ${
                        message
                            ? `
                                <div class="contact-search-message">

                                    <span class="contact-search-message-label">
                                        <i class="fas fa-comment-medical"></i>
                                        Message
                                    </span>

                                    <p>${message}</p>

                                </div>
                            `
                            : ""
                    }

                </div>

            </div>

        </div>
    `;
        }

        /* APPOINTMENT RESULT  */
        const image = window.SystemSearch.escapeAttribute(
            item.image || window.SystemSearch.defaultImage,
        );

        const statusClass = window.SystemSearch.getStatusClass(item.status);
        const statusLabel = window.SystemSearch.getStatusLabel(item.status);
        const date = window.SystemSearch.escape(item.date || "-");
        const time = window.SystemSearch.escape(item.time || "-");

        return `
            <div
                class="system-search-result-item appointment-search-card"
                data-result-type="appointment"
            >

                <div class="appointment-search-inner">
                    <div class="appointment-search-image-wrapper">
                        <img
                            src="${image}"
                            alt="${name}"
                            class="appointment-search-image"
                            onerror="this.onerror=null;this.src='${window.SystemSearch.escapeAttribute(
                                window.SystemSearch.defaultImage,
                            )}'"
                        >
                    </div>

                    <!-- Appointment Information -->
                    <div class="appointment-search-information">
                        <div class="appointment-search-heading">
                            <div>
                                <span class="appointment-search-type">
                                    <i class="fas fa-calendar-check"></i>
                                    Appointment
                                </span>

                                <h4 class="appointment-search-name">${name}</h4>
                            </div>

                            <span class="system-search-result-status ${statusClass}">
                                <span class="appointment-status-dot"></span>
                                ${statusLabel}
                            </span>
                        </div>

                        <!-- Appointment Bottom Information -->
                        <div class="appointment-search-footer">
                            <div class="appointment-search-date">
                                <span class="appointment-search-label">
                                    <i class="far fa-calendar-alt"></i>
                                    Appointment Date
                                </span>

                                <strong>${date} </strong>
                            </div>

                            <div class="appointment-search-time">
                                <span class="appointment-search-label">
                                    <i class="far fa-clock"></i>
                                    Appointment Time
                                </span>

                                <strong> ${time}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    };
})(window, jQuery);
