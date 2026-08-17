 <div class="card border-0 shadow-lg mb-4 overflow-hidden"
     style="
        border-radius:20px;
       background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
    ">

     <div class="card-body px-4 py-4">

         <div class="d-flex justify-content-between align-items-center flex-wrap">

             <!-- LEFT SIDE -->
             <div class="d-flex align-items-center">

                 <!-- DOCTOR AVATAR -->
                 <div class="me-3">

                     <img src="{{ asset($doctor->image ?? 'uploads/images/default.jpg') }}" alt="Doctor Image"
                         class="shadow"
                         style="
                width:70px;
                height:70px;
                border-radius:50%;
                object-fit:cover;
                background:rgba(255,255,255,0.15);
                backdrop-filter: blur(10px);
                border:3px solid rgba(255,255,255,0.25);
                padding:2px;
            ">

                 </div>

                 <!-- TEXT -->
                 <div>

                     <h2 class="text-white font-weight-bold mb-1">

                         Welcome,
                         <span style="color:#ffd43b;">
                             {{ $doctor->name }}
                         </span>

                     </h2>

                     <p class="mb-0 text-light" style="font-size:15px; opacity:0.9;">

                         <i class="fas fa-stethoscope me-2"></i>

                         {{ $doctor->speciality ?? 'System Developer' }}

                     </p>

                 </div>

             </div>

             <!-- RIGHT SIDE -->
             <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">

                 <!-- FILTER BUTTON -->
                 <button class="btn text-white px-4 py-2 rounded-pill shadow-sm" id="toggleFilterBtn" type="button"
                     style="
                        background:rgba(255,255,255,0.15);
                        backdrop-filter:blur(10px);
                        border:1px solid rgba(255,255,255,0.2);
                        transition:0.3s;
                    "
                     onmouseover="this.style.background='rgba(255,255,255,0.25)'"
                     onmouseout="this.style.background='rgba(255,255,255,0.15)'">

                     <i class="fas fa-filter me-2"></i>

                     Filter

                     <i class="fas fa-chevron-down ms-2" id="filterArrow"></i>

                 </button>

                 <!-- DASHBOARD BADGE -->
                 <div class="px-4 py-2 rounded-pill shadow-sm text-white fw-bold"
                     style="
                        background:rgba(255,255,255,0.15);
                        backdrop-filter:blur(10px);
                        border:1px solid rgba(255,255,255,0.2);
                        letter-spacing:0.5px;
                    ">

                     <i class="fas fa-chart-line me-2"></i>

                     Admin Dashboard

                 </div>

             </div>

         </div>

     </div>

 </div>
