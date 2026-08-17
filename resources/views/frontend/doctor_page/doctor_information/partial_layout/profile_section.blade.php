 <!-- ================= DOCTOR PROFILE ================= -->
 <section class="doctor-profile">
     <div class="container">

         <div class="row align-items-center g-4">

             <!-- LEFT -->
             <div class="col-md-6">
                 <div class="profile-left">

                     <div class="profile-img">
                         <img src="{{ asset($doctor->image ? $doctor->image : 'uploads/images/default.jpg') }}"
                             alt="{{ $doctor->name }}">
                     </div>

                     <div class="profile-stats">

                         <div class="stat-card success">
                             <div class="icon">✔</div>
                             <h4>{{ $doctor->success_rate }}%</h4>
                             <p>Success Rate</p>
                         </div>

                         <div class="stat-card experience">
                             <div class="icon">⏳</div>
                             <h4>{{ $doctor->experience_years }} Years</h4>
                             <p>Experience</p>
                         </div>

                         <div class="stat-card patients">
                             <div class="icon">👨‍⚕️</div>
                             <h4>{{ $doctor->total_patients }}</h4>
                             <p>Patients</p>
                         </div>

                     </div>

                 </div>
             </div>

             <!-- RIGHT -->
             <div class="col-md-6">
                 <div class="profile-right">

                     <h2>{{ $doctor->name }}</h2>
                     <p class="speciality">{{ $doctor->speciality }}</p>

                     <div class="info-grid">

                         <div class="info-box">
                             <h5>Qualifications</h5>
                             <p>{{ $doctor->qualification }}</p>
                         </div>

                         <div class="info-box">
                             <h5>Location</h5>
                             <p>{{ $doctor->location }}</p>
                         </div>

                         <div class="info-box">
                             <h5>Consultation Fee</h5>
                             <p>{{ $doctor->consultation_fee }} BDT</p>
                         </div>

                         <div class="info-box">
                             <h5>Availability</h5>
                             <p>Available</p>
                         </div>

                     </div>

                     <div class="about-doctor">
                         <h4>About Doctor</h4>
                         <p>{{ $doctor->about }}</p>
                     </div>

                 </div>
             </div>

         </div>

     </div>
 </section>
