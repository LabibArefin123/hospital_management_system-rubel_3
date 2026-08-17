document
    .getElementById("whatsappForm")
    .addEventListener("submit", function (e) {
        e.preventDefault();

        let name = document.getElementById("name").value;
        let phone = document.getElementById("phone").value;
        let department = document.getElementById("department").value;
        let service = document.getElementById("service").value;
        let message = document.getElementById("message").value;

        let text = `Appointment Request:%0A
Name: ${name}%0A
Phone: ${phone}%0A
Department: ${department}%0A
Service: ${service}%0A
Message: ${message}`;

        let whatsappNumber = "88017XXXXXXXX";

        window.open(`https://wa.me/${whatsappNumber}?text=${text}`, "_blank");
    });
