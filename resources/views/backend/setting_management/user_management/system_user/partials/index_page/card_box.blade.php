 <div class="system-user-total-wrapper">
     {{-- ADMIN --}}
     <div class="system-user-total-card">
         <div class="system-user-total-icon admin">
             <i class="fas fa-user-shield"></i>
         </div>

         <div class="system-user-total-content">
             <span class="system-user-total-label">
                 Total Admin Users
             </span>

             <strong class="system-user-total-number">
                 {{ $userTotals['admin'] }}
             </strong>
         </div>
     </div>


     {{-- DOCTOR --}}
     <div class="system-user-total-card">
         <div class="system-user-total-icon doctor">
             <i class="fas fa-user-md"></i>
         </div>

         <div class="system-user-total-content">
             <span class="system-user-total-label">
                 Total Doctor Users
             </span>

             <strong class="system-user-total-number">
                 {{ $userTotals['doctor'] }}
             </strong>
         </div>
     </div>


     {{-- CREATED PATIENT --}}
     <div class="system-user-total-card">
         <div class="system-user-total-icon patient">
             <i class="fas fa-user-check"></i>
         </div>

         <div class="system-user-total-content">
             <span class="system-user-total-label">
                 Patient Users Created
             </span>

             <strong class="system-user-total-number">
                 {{ $userTotals['patient_created'] }}
             </strong>
         </div>
     </div>


     {{-- NOT CREATED PATIENT --}}
     <div class="system-user-total-card">
         <div class="system-user-total-icon pending">
             <i class="fas fa-user-clock"></i>
         </div>

         <div class="system-user-total-content">
             <span class="system-user-total-label">
                 Patient Users Not Created
             </span>

             <strong class="system-user-total-number">
                 {{ $userTotals['patient_not_created'] }}
             </strong>
         </div>
     </div>
 </div>
