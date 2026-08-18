/**
 * ==========================================================
 * SUSTHOCARE PAYMENT METHOD TOGGLE
 * ==========================================================
 */
(function (window, $) {
    "use strict";
    $(function () {
        const $tabs = $(".payment-method-tab");
        const $panels = $(".payment-method-panel");
        const $methodInput = $("#paymentMethod");
        const $transactionInput = $("#transaction_id");
        if (!$tabs.length) {
            return;
        }
        function activatePaymentMethod(method) {
            $tabs.removeClass("active");
            $panels.removeClass("active");
            const $tab = $tabs.filter('[data-payment-method="' + method + '"]');
            const $panel = $panels.filter(
                '[data-payment-panel="' + method + '"]',
            );
            $tab.addClass("active");
            $panel.addClass("active");
            $methodInput.val(method);
            if ($transactionInput.length) {
                $transactionInput.attr(
                    "placeholder",
                    "Enter " +
                        method.charAt(0).toUpperCase() +
                        method.slice(1) +
                        " transaction ID",
                );
            }
        }
        $tabs.on("click", function () {
            const method = $(this).data("payment-method");
            activatePaymentMethod(method);
        });
        const initialMethod = $methodInput.val() || "bkash";
        activatePaymentMethod(initialMethod);
    });
})(window, jQuery);
