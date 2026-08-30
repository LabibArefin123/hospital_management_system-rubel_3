 <div class="card">
     <div class="card-header bg-white">
         <h5 class="mb-0">My All Appointments</h5>
     </div>
     <div class="card-body table-responsive">
         <table class="table table-bordered table-hover" id="dataTables">
             <thead>
                 <tr>
                     <th>Doctor</th>
                     <th>Type</th>
                     <th>Date</th>
                     <th>Time</th>
                     <th>Amount</th>
                     <th>Status</th>
                 </tr>
             </thead>

             <tbody>
                 @forelse ($appointments as $appointment)
                     <tr>
                         <td>
                             <div class="d-flex align-items-center">
                                 <div style="width:38px;height:38px;flex:0 0 38px;margin-right:8px;">
                                     <img src="{{ $appointment->doctor->image ? asset($appointment->doctor->image) : asset('images/default-doctor.png') }}"
                                         alt="{{ $appointment->doctor->name ?? 'Doctor' }}"
                                         style="width:38px;height:38px;object-fit:cover;border-radius:5px;">
                                 </div>
                                 <strong style="font-size:13px;">{{ $appointment->doctor->name ?? 'N/A' }}</strong>
                             </div>
                         </td>
                         <td>{{ ucfirst($appointment->type) }}</td>
                         <td>
                             {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                         </td>
                         <td>{{ $appointment->appointment_time }}</td>
                         <td>৳{{ number_format($appointment->amount, 2) }}</td>
                         <td>
                             <span
                                 class="badge
                                @if ($appointment->status == 'confirmed') badge-success
                                @elseif($appointment->status == 'cancelled')
                                    badge-danger
                                @else
                                    badge-warning @endif">
                                 {{ ucfirst($appointment->status) }}
                             </span>
                         </td>
                     </tr>
                 @empty
                     <tr>
                         <td colspan="6" class="text-center py-4">
                             <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                             <div class="text-muted mt-2">
                                 You don't have any appointments yet.
                             </div>
                         </td>
                     </tr>
                 @endforelse
             </tbody>
         </table>
     </div>
 </div>
