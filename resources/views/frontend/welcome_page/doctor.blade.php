{{-- DOCTOR SECTION FOR WELCOME PAGE --}}
<section class="home-doctor-section py-5">
    <div class="container">

        {{-- SECTION HEADER --}}
        <div class="section-title text-center mb-5">
            <span class="mini-title">Medical Specialists</span>
            <h2>Our Medical Team</h2>
            <p>
                Book appointments quickly with our verified specialists.
            </p>
        </div>

        {{-- DOCTOR GRID --}}
        <div class="doctor-grid">

            @forelse($doctors->take(4) as $doctor)
                <div class="doctor-card">

                    {{-- IMAGE --}}
                    <div class="doctor-img">
                        <img src="{{ asset($doctor->image) }}" alt="{{ $doctor->name }}">
                    </div>

                    {{-- INFO --}}
                    <div class="doctor-info">
                        <h5>{{ $doctor->name }}</h5>

                        <p class="speciality">
                            {{ $doctor->speciality }}
                        </p>

                        <span class="experience">
                            {{ $doctor->experience_years }} Years Experience
                        </span>

                        <a href="{{ route('doctor.show', $doctor->id) }}" class="btn-doctor">
                            Book Appointment
                        </a>
                    </div>

                </div>
            @empty
                <div class="text-center w-100">
                    <p>No doctors available right now.</p>
                </div>
            @endforelse

        </div>

        {{-- VIEW ALL --}}
        <div class="text-center mt-5">
            <a href="{{ route('doctor') }}" class="view-all-btn">
                View All Doctors
            </a>
        </div>

    </div>
</section>
