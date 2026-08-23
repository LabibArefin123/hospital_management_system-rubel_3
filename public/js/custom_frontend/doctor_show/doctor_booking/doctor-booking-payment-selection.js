document.addEventListener("DOMContentLoaded", function () {
    "use strict";
    if (!window.bookingState || !window.bookingElements) {
        console.error("[Booking Payment] Core not loaded.");
        return;
    }
    function selectPayment(button) {
        const paymentMethod = button.dataset.value || button.value || "";
        if (!paymentMethod) {
            console.warn("[Booking Payment] Payment value missing.", button);
            return;
        }
        document
            .querySelectorAll(".pay-btn,.pay-btn-2")
            .forEach(function (btn) {
                btn.classList.remove("active");
                btn.setAttribute("aria-pressed", "false");
            });
        button.classList.add("active");
        button.setAttribute("aria-pressed", "true");
        bookingState.selectedPayment = paymentMethod;
        if (bookingElements.paymentInput) {
            bookingElements.paymentInput.value = paymentMethod;
        }
        if (bookingElements.email) {
            bookingElements.email.required = paymentMethod === "Online";
        }
        const emailRequiredMark = document.getElementById("emailRequiredMark");
        if (emailRequiredMark) {
            emailRequiredMark.innerText =
                paymentMethod === "Online" ? "*" : "(optional)";
        }
        if (typeof window.validateBookingForm === "function") {
            window.validateBookingForm(false);
        }
        console.log("[Booking Payment] Selected:", paymentMethod);
        console.log("[Booking Payment] State:", bookingState);
    }
    document.querySelectorAll(".pay-btn,.pay-btn-2").forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            event.stopPropagation();
            selectPayment(this);
        });
    });
});
