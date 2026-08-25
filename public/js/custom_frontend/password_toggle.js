document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("loginPassword");
    const passwordToggle = document.getElementById("passwordToggle");

    if (!passwordInput || !passwordToggle) {
        return;
    }

    const toggleIcon = passwordToggle.querySelector("i");

    passwordToggle.addEventListener("click", function () {
        const isPassword = passwordInput.type === "password";

        passwordInput.type = isPassword ? "text" : "password";

        if (isPassword) {
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");

            passwordToggle.setAttribute("aria-label", "Hide password");
        } else {
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");

            passwordToggle.setAttribute("aria-label", "Show password");
        }

        passwordInput.focus();
    });
});
