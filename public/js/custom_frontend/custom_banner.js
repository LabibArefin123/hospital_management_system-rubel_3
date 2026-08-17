document.addEventListener("DOMContentLoaded", function () {
    const slider = document.getElementById("slider");
    if (!slider) return;

    let currentIndex = 0;
    const slides = slider.querySelectorAll(".slide");
    const dots = slider.querySelectorAll(".dot");

    if (slides.length === 0) return;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle("active", i === index);
        });

        dots.forEach((dot, i) => {
            dot.classList.toggle("active", i === index);
        });

        currentIndex = index;
    }

    function nextSlide() {
        let newIndex = (currentIndex + 1) % slides.length;
        showSlide(newIndex);
    }

    window.goToSlide = function (index) {
        showSlide(index);
    };

    // Auto slide every 5 seconds
    setInterval(nextSlide, 5000);

    // Initialize first slide
    showSlide(0);
});
