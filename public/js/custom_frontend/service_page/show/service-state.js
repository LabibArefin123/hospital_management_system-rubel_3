// ==================================================
// GLOBAL STATE & HELPERS
// ==================================================

const el = (id) => document.getElementById(id);

let state = {
    payment: null,
    date: null,
    time: null,
};

// UPDATE HIDDEN INPUTS
function updateHiddenInputs() {
    if (el("formDate")) {
        el("formDate").value = state.date ?? "";
    }

    if (el("formTime")) {
        el("formTime").value = state.time ?? "";
    }

    if (el("paymentMethod")) {
        el("paymentMethod").value = state.payment ?? "";
    }

    console.log("Hidden Values:", {
        date: el("formDate")?.value,
        time: el("formTime")?.value,
        payment: el("paymentMethod")?.value,
    });
}
