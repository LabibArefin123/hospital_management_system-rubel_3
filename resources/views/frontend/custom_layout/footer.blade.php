<footer class="premium-footer">
    <div class="premium-footer-shape premium-footer-shape-one"></div>
    <div class="premium-footer-shape premium-footer-shape-two"></div>
    <div class="container">
        <div class="row gy-5">
            {{-- BRAND INFO --}}
            <div class="col-lg-5 col-md-12">
                <div class="footer-brand">
                    <div class="footer-logo-wrap">
                        <div class="footer-logo-box">
                            <img src="{{ asset('uploads/images/original_logor.JPG') }}" alt="SusthoCare Logo"
                                class="footer-brand-logo">
                        </div>
                    </div>
                    <p class="footer-description">
                        Your trusted partner in healthcare innovation. We're committed to providing exceptional medical
                        care with cutting-edge technology and compassionate service.
                    </p>
                    <div class="footer-brand-badge">
                        <i class="fas fa-shield-alt"></i>
                        <span>Trusted Healthcare Partner</span>
                    </div>
                </div>
            </div>
            {{-- QUICK LINKS --}}
            <div class="col-lg-2 col-md-6">
                <div class="footer-widget">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="{{ route('welcome') }}"><i class="fas fa-angle-right"></i>Home</a></li>
                        <li><a href="{{ route('doctor') }}"><i class="fas fa-angle-right"></i>Doctors</a></li>
                        <li><a href="{{ route('service') }}"><i class="fas fa-angle-right"></i>Services</a></li>
                        <li><a href="{{ route('contact') }}"><i class="fas fa-angle-right"></i>Contact</a></li>
                        <li><a href="{{ route('appointment') }}"><i class="fas fa-angle-right"></i>Appointments</a></li>
                    </ul>
                </div>
            </div>
            {{-- SERVICES --}}
            <div class="col-lg-2 col-md-6">
                <div class="footer-widget">
                    <h5>Our Services</h5>
                    <ul>
                        <li><a href="{{ route('service.show', 3) }}"><i class="fas fa-angle-right"></i>Blood Pressure
                                Check</a></li>
                        <li><a href="{{ route('service.show', 4) }}"><i class="fas fa-angle-right"></i>Blood Sugar
                                Test</a></li>
                        <li><a href="{{ route('service.show', 5) }}"><i class="fas fa-angle-right"></i>Full Blood
                                Count</a></li>
                        <li><a href="{{ route('service.show', 2) }}"><i class="fas fa-angle-right"></i>X-Ray Scan</a>
                        </li>
                        <li><a href="{{ route('service.show', 1) }}"><i class="fas fa-angle-right"></i>Full Body
                                Checkup</a></li>
                    </ul>
                </div>
            </div>
            {{-- NEWSLETTER --}}
            <div class="col-lg-3 col-md-12">
                <div class="footer-widget newsletter-widget">
                    <h5>Stay Connected</h5>
                    <p>Subscribe for health tips, medical updates, and wellness insights delivered to your inbox.</p>
                    <form action="{{ route('newsletter.store') }}" method="POST" class="newsletter-form">
                        @csrf
                        <div class="newsletter-input-wrap">
                            <i class="far fa-envelope"></i>
                            <input type="email" name="newsletter_email" value="{{ old('newsletter_email') }}"
                                class="@error('newsletter_email') is-invalid @enderror" placeholder="Enter your email">
                        </div>
                        @error('newsletter_email')
                            <div class="newsletter-error">{{ $message }}</div>
                        @enderror
                        <button type="submit">
                            <span>Subscribe</span>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-divider"></div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} <strong>SusthoCare</strong>. All Rights Reserved.</p>
            <div class="footer-bottom-links">
                <span>Healthcare with Care</span>
                <i class="fas fa-heart"></i>
            </div>
        </div>
    </div>
</footer>

