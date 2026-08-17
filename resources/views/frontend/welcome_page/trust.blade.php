<section class="trust-section py-5">

    <div class="container">

        <!-- Section Header -->
        <div class="text-center mb-5">
            <h2 class="trust-title">Trusted by Doctors & Patients</h2>
            <p class="trust-subtitle">
                Real experiences from medical professionals and patients using our platform
            </p>
        </div>

        <div class="row g-4">

            <!-- Doctors -->
            <div class="col-md-6">
                <div class="trust-box">

                    <h5 class="trust-group-title">Medical Professionals</h5>

                    <div class="trust-slider" id="doctorSlider">

                        <div class="trust-slide active">
                            <div class="trust-card">
                                <div class="user">
                                    <div class="avatar">DR</div>
                                    <div>
                                        <strong>Dr. Farhana Rahman</strong>
                                        <small>Cardiologist, Dhaka</small>
                                    </div>
                                </div>
                                <p>“This system has streamlined my appointment workflow significantly.”</p>
                            </div>

                            <div class="trust-card">
                                <div class="user">
                                    <div class="avatar">DR</div>
                                    <div>
                                        <strong>Dr. Tanvir Ahmed</strong>
                                        <small>Pediatrician</small>
                                    </div>
                                </div>
                                <p>“Clinic operations are now faster and more organized.”</p>
                            </div>
                        </div>

                        <div class="trust-slide">
                            <div class="trust-card">
                                <div class="user">
                                    <div class="avatar">DR</div>
                                    <div>
                                        <strong>Dr. Nusrat Jahan</strong>
                                        <small>Dermatologist</small>
                                    </div>
                                </div>
                                <p>“Automated reminders reduced missed appointments.”</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Patients -->
            <div class="col-md-6">
                <div class="trust-box">

                    <h5 class="trust-group-title">Patients</h5>

                    <div class="trust-slider" id="patientSlider">

                        <div class="trust-slide active">
                            <div class="trust-card">
                                <div class="user">
                                    <div class="avatar user-avatar">MR</div>
                                    <div>
                                        <strong>Md. Rakib Hasan</strong>
                                        <small>Patient</small>
                                    </div>
                                </div>
                                <p>“Booking appointments is now simple and fast.”</p>
                            </div>

                            <div class="trust-card">
                                <div class="user">
                                    <div class="avatar user-avatar">SA</div>
                                    <div>
                                        <strong>Sharmeen Akter</strong>
                                        <small>Patient</small>
                                    </div>
                                </div>
                                <p>“Reminders help me stay on track with my health.”</p>
                            </div>
                        </div>

                        <div class="trust-slide">
                            <div class="trust-card">
                                <div class="user">
                                    <div class="avatar user-avatar">IH</div>
                                    <div>
                                        <strong>Imran Hossain</strong>
                                        <small>Patient</small>
                                    </div>
                                </div>
                                <p>“No more waiting in long hospital queues.”</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</section>

<script>
    function initSlider(id) {
        const slider = document.getElementById(id);
        const slides = slider.querySelectorAll('.trust-slide');
        let index = 0;

        setInterval(() => {
            slides[index].classList.remove('active');
            index = (index + 1) % slides.length;
            slides[index].classList.add('active');
        }, 4000);
    }

    initSlider('doctorSlider');
    initSlider('patientSlider');
</script>
