/* =========================================================
   FILE: booking-pagination.js
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    function showPage(index) {
        bookingElements.pages.forEach((page) => {
            page.classList.remove("active");
        });

        if (bookingElements.pages[index]) {
            bookingElements.pages[index].classList.add("active");
        }
    }

    window.showBookingPage = showPage;

    if (bookingElements.nextBtn) {
        bookingElements.nextBtn.addEventListener("click", function () {
            if (bookingState.currentPage < bookingElements.pages.length - 1) {
                bookingState.currentPage++;

                showPage(bookingState.currentPage);
            }
        });
    }

    if (bookingElements.prevBtn) {
        bookingElements.prevBtn.addEventListener("click", function () {
            if (bookingState.currentPage > 0) {
                bookingState.currentPage--;

                showPage(bookingState.currentPage);
            }
        });
    }

    showPage(0);
});
