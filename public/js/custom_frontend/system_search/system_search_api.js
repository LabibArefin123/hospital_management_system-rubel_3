/** SYSTEM SEARCH API*/

(function (window, $) {
    "use strict";

    console.log("[System Search] STATE 3: API module loaded.");

    if (!window.SystemSearch) {
        console.error(
            "[System Search] STATE 3 ERROR: SystemSearch core not loaded.",
        );
        return;
    }

    window.SystemSearch.search = function (search, input) {
        if (!search) {
            console.log(
                "[System Search] STATE 13: Empty search. Clearing results.",
            );

            window.SystemSearch.clear();

            return;
        }

        if (!window.systemSearchUrl) {
            console.error(
                "[System Search] STATE 8 ERROR: Search URL is not defined.",
            );

            window.SystemSearch.showEmpty(input);

            return;
        }

        console.log("[System Search] STATE 8: Search started:", search);

        console.log(
            "[System Search] STATE 8: Request URL:",
            window.systemSearchUrl,
        );

        window.SystemSearch.showLoading(input);

        $.ajax({
            url: window.systemSearchUrl,
            method: "GET",
            data: {
                search: search,
            },
            dataType: "json",

            success: function (response) {
                console.log("[System Search] STATE 9: AJAX success.", response);
                if (!response || response.status !== true) {
                    console.warn(
                        "[System Search] STATE 9 WARNING: Invalid response.",
                    );

                    window.SystemSearch.showEmpty(input);

                    return;
                }

                window.SystemSearch.render(response, input);
            },

            error: function (xhr, status, error) {
                console.error(
                    "[System Search] STATE 11 ERROR: AJAX request failed.",
                    {
                        status: status,
                        error: error,
                        response: xhr.responseText,
                    },
                );

                window.SystemSearch.showEmpty(input);
            },

            complete: function () {
                console.log(
                    "[System Search] STATE 12: AJAX request completed.",
                );

                window.SystemSearch.hideLoading(input);
            },
        });
    };
})(window, jQuery);
