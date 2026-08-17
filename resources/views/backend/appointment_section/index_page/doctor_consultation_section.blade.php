 <!-- DOCTOR CONSULTATION SECTION -->
 <div class="d-flex align-items-center justify-content-between mt-4 mb-3">
     <h3 class="font-weight-bold">
         <i class="fas fa-user-md text-primary"></i>
         Doctor Consultations
     </h3>
     <span class="badge badge-primary px-3 py-2">
         {{ $doctorAppointments->count() }} Appointments
     </span>
 </div>



 <div class="row appointment-wrapper">
     @forelse($doctorAppointments as $appointment)
         <div class="col-md-3 mb-4 appointment-card" data-type="{{ strtolower($appointment->type) }}"
             data-status="{{ strtolower($appointment->status) }}"
             data-search="
            {{ strtolower($appointment->name) }}
            {{ strtolower($appointment->doctor->name ?? '') }}
         ">
             <div class="card shadow border-0 h-100">
                 <div class="card-body">
                     <div class="d-flex justify-content-between">
                         <div>
                             <h5 class="font-weight-bold mb-1">
                                 {{ $appointment->name }}
                             </h5>

                             <small class="text-muted">
                                 {{ $appointment->phone }}
                             </small>
                         </div>
                         <div>
                             @if ($appointment->status == 'pending')
                                 <span class="badge badge-warning">
                                     Pending
                                 </span>
                             @elseif($appointment->status == 'confirmed')
                                 <span class="badge badge-success">
                                     Confirmed
                                 </span>
                             @elseif($appointment->status == 'cancelled')
                                 <span class="badge badge-danger">
                                     Cancelled
                                 </span>
                             @endif
                         </div>
                     </div>

                     <hr>

                     <p class="mb-2">
                         <i class="fas fa-user-md text-primary"></i>

                         <strong>
                             {{ $appointment->doctor->name ?? 'N/A' }}
                         </strong>
                     </p>

                     <p class="mb-2">
                         <i class="fas fa-calendar text-info"></i>
                         {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                     </p>

                     <p class="mb-2">
                         <i class="fas fa-clock text-success"></i>
                         {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                     </p>

                     <p class="mb-0">
                         <i class="fas fa-money-bill-wave text-warning"></i>
                         ৳ {{ number_format($appointment->amount, 2) }}
                     </p>
                 </div>

                 <div class="card-footer bg-white border-0">
                     <div class="d-flex justify-content-between">
                         <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-info btn-sm">
                             <i class="fas fa-eye"></i>
                         </a>
                         <a href="{{ route('appointments.cancel', $appointment->id) }}"
                             class="btn btn-secondary btn-sm">
                             <i class="fas fa-ban"></i>
                         </a>
                         <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                             @csrf
                             @method('DELETE')
                             <button class="btn btn-danger btn-sm" onclick="return confirm('Delete appointment?')">

                                 <i class="fas fa-trash"></i>
                             </button>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     @empty
         <div class="col-12">
             <div class="alert alert-light text-center shadow-sm">
                 No Doctor Consultation Found
             </div>
         </div>
     @endforelse
 </div>
