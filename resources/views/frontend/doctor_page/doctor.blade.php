@extends('frontend.layouts.app')

@section('title', 'Our Doctors - SusthoCare')

@section('content')

    @include('frontend.custom_layout.header')

    <!-- TRANSPARENT INTRO -->
    <section class="doctor-intro ">
        <div class="container text-center">
            <h2>Our Medical Experts</h2>
            <p>Find your ideal doctor by name or specialization</p>
            <input type="text" id="doctorSearch" placeholder="Search doctor or specialization...">
        </div>
    </section>

    <!-- DOCTOR GRID -->
    <section class="doctor-section py-5">
        <div class="container">
            <div class="doctor-grid" id="doctorGrid">
                @forelse($doctors as $doctor)
                    <div class="doctor-card">
                        <div class="doctor-img">
                            <img src="{{ asset($doctor->image ? $doctor->image : 'uploads/images/default.jpg') }}"
                                alt="{{ $doctor->name }}">
                        </div>

                        <h5>{{ $doctor->name }}</h5>
                        <p>{{ $doctor->speciality }}</p>
                        <span>{{ $doctor->experience_years }} Years Experience</span>

                        <a href="{{ route('doctor.show', $doctor->id) }}" class="btn-book">
                            Book Now
                        </a>
                    </div>
                @empty
                    <p class="text-center w-100">No doctors found.</p>
                @endforelse

            </div>
        </div>
    </section>

    @include('frontend.custom_layout.footer')

    {{-- LIVE SEARCH SCRIPT --}}
    <script>
        document.getElementById('doctorSearch').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            let cards = document.querySelectorAll('.doctor-card');

            cards.forEach(card => {
                let text = card.innerText.toLowerCase();
                card.style.display = text.includes(value) ? 'block' : 'none';
            });
        });
    </script>
@endsection
