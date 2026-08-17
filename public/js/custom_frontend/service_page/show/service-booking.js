// ==================================================
// SERVICE BOOKING SCRIPT
// ==================================================

document.addEventListener("DOMContentLoaded", function () {
    // INPUT LISTENERS
    ["name", "phone", "age", "gender"].forEach((id) => {
        const input = el(id);

        if (!input) return;

        input.addEventListener("input", () => {
            updateSummary();

            checkForm();
        });
    });

    // BUTTON CLICK
    document.querySelectorAll(".select-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            const type = this.dataset.type;
            const value = this.dataset.value;

            if (!type || !value) return;

            // REMOVE ACTIVE
            document
                .querySelectorAll(`[data-type="${type}"]`)
                .forEach((b) => b.classList.remove("active"));

            this.classList.add("active");

            // UPDATE STATE
            state[type] = value;

            // REFRESH
            updateHiddenInputs();

            updateSummary();

            checkForm();
        });
    });

    // FORM SUBMIT
    const form = document.querySelector("form");

    if (form) {
        form.addEventListener("submit", function (e) {
            updateHiddenInputs();

            if (!state.payment || !state.date || !state.time) {
                e.preventDefault();

                alert("Select Payment, Date & Time");

                return;
            }

            console.log("Submitting:", {
                date: el("formDate")?.value,
                time: el("formTime")?.value,
                payment: el("paymentMethod")?.value,
            });
        });
    }

    // INIT
    updateHiddenInputs();

    updateSummary();

    checkForm();
});
