<section class="certified-section">
    <div class="container">

        <!-- HEADER -->
        <div class="certified-header text-center">
            <h2>CERTIFIED & EXCELLENCE</h2>
            <p>Government recognized and internationally accredited healthcare standards</p>

            <div class="certified-badge">
                OFFICIALLY CERTIFIED
            </div>
        </div>

        <!-- SLIDER -->
        <div class="certified-slider">
            <div class="certified-track" id="certTrack">

                {{-- ORIGINAL ITEMS --}}
                <div class="cert-card">
                    <div class="cert-img">
                        <img src="{{ asset('uploads/images/welcome_page/certify_section/C1.png') }}">
                    </div>
                    <h5>Medical Commission</h5>
                </div>

                <div class="cert-card">
                    <div class="cert-img">
                        <img src="{{ asset('uploads/images/welcome_page/certify_section/C2.png') }}">
                    </div>
                    <h5>Government Approved</h5>
                </div>

                <div class="cert-card">
                    <div class="cert-img">
                        <img src="{{ asset('uploads/images/welcome_page/certify_section/C3.png') }}">
                    </div>
                    <h5>NABH Accreditation</h5>
                </div>

                <div class="cert-card">
                    <div class="cert-img">
                        <img src="{{ asset('uploads/images/welcome_page/certify_section/C3.png') }}">
                    </div>
                    <h5>NABH Accredited</h5>
                </div>

                <div class="cert-card">
                    <div class="cert-img">
                        <img src="{{ asset('uploads/images/welcome_page/certify_section/C4.svg') }}">
                    </div>
                    <h5>Medical Council</h5>
                </div>

                <div class="cert-card">
                    <div class="cert-img">
                        <img src="{{ asset('uploads/images/welcome_page/certify_section/C5.png') }}">
                    </div>
                    <h5>Quality Healthcare</h5>
                </div>

                <div class="cert-card">
                    <div class="cert-img">
                        <img src="{{ asset('uploads/images/welcome_page/certify_section/C6.png') }}">
                    </div>
                    <h5>Paramedical Council</h5>
                </div>

                <div class="cert-card">
                    <div class="cert-img">
                        <img src="{{ asset('uploads/images/welcome_page/certify_section/C2.png') }}">
                    </div>
                    <h5>Ministry of Health</h5>
                </div>

            </div>
        </div>

    </div>
</section>
<script>
    const track = document.getElementById('certTrack');

    // duplicate items for smooth loop
    track.innerHTML += track.innerHTML;
</script>