/* =========================================================
   SWEET ALERT HELPERS
========================================================= */

function showSuccess(message) {
    Swal.fire({
        icon: "success",
        title: "Success",
        text: message,
        timer: 2000,
        showConfirmButton: false,
        toast: true,
        position: "top-end",
    });
}

function showError(message) {
    Swal.fire({
        icon: "error",
        title: "Error",
        text: message,
        timer: 3000,
        showConfirmButton: false,
        toast: true,
        position: "top-end",
    });
}

function showWarning(message) {
    Swal.fire({
        icon: "warning",
        title: "Warning",
        text: message,
        timer: 3000,
        showConfirmButton: false,
        toast: true,
        position: "top-end",
    });
}

function showInfo(message) {
    Swal.fire({
        icon: "info",
        title: "Information",
        text: message,
        timer: 3000,
        showConfirmButton: false,
        toast: true,
        position: "top-end",
    });
}
