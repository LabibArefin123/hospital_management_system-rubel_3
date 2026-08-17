// ==================================================
// SUMMARY & VALIDATION
// ==================================================

// UPDATE SUMMARY
function updateSummary() {
    if (el("s_name")) {
        el("s_name").innerText = el("name")?.value || "Not Filled";
    }

    if (el("s_mobile")) {
        el("s_mobile").innerText = el("phone")?.value || "Not Filled";
    }

    if (el("s_age")) {
        el("s_age").innerText = el("age")?.value || "Not Filled";
    }

    if (el("s_gender")) {
        el("s_gender").innerText = el("gender")?.value || "Not Filled";
    }

    if (el("s_date")) {
        el("s_date").innerText = state.date || "Not Selected";
    }

    if (el("s_time")) {
        el("s_time").innerText = state.time || "Not Selected";
    }

    if (el("s_payment")) {
        el("s_payment").innerText = state.payment || "Not Selected";
    }
}

// VALIDATION
function checkForm() {
    let valid =
        el("name")?.value &&
        el("phone")?.value &&
        el("age")?.value &&
        el("gender")?.value &&
        state.payment &&
        state.date &&
        state.time;

    const btn = el("confirmBtn");

    if (btn) {
        btn.disabled = !valid;

        btn.style.opacity = valid ? "1" : "0.5";
    }
}
