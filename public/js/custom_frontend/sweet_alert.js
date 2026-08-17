document.addEventListener("DOMContentLoaded", function () {
    // SUCCESS MESSAGE
    if (window.appData.success) {
        Swal.fire({
            icon: "success",
            title: "Form Accepted",
            text: window.appData.success,
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
            position: "center",
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        }).then(() => {
            if (typeof closeProblemModal === "function") {
                closeProblemModal();
            }
        });
    }

    // VALIDATION ERRORS
    if (window.appData.errors && window.appData.errors.length > 0) {
        let errorMessages = window.appData.errors
            .map((error) => `• ${error}`)
            .join("\n");

        Swal.fire({
            icon: "error",
            title: "Submission Failed",
            text: errorMessages,
            confirmButtonColor: "#dc3545",
            position: "center",
        });

        if (typeof openProblemModal === "function") {
            openProblemModal();
        }
    }
});
