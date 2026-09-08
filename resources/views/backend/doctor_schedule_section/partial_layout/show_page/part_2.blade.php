 <div class="card shadow border-0">

     <div class="card-header bg-white">

         <h4 class="card-title font-weight-bold">

             <i class="fas fa-info-circle text-primary mr-1"></i>

             Schedule Information

         </h4>

     </div>

     <div class="card-body p-0">

         <table class="table table-hover mb-0">

             <tbody>

                 <tr>

                     <th width="250">
                         Doctor Name
                     </th>

                     <td>
                         {{ $schedule->doctor->name ?? 'N/A' }}
                     </td>

                 </tr>

                 <tr>

                     <th>
                         Speciality
                     </th>

                     <td>
                         {{ $schedule->doctor->speciality ?? 'N/A' }}
                     </td>

                 </tr>

                 <tr>

                     <th>
                         Date
                     </th>

                     <td>
                         {{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}
                     </td>

                 </tr>

                 <tr>

                     <th>
                         Time
                     </th>

                     <td>
                         {{ \Carbon\Carbon::parse($schedule->time)->format('h:i A') }}
                     </td>

                 </tr>

                 <tr>

                     <th>
                         Status
                     </th>

                     <td>

                         @if ($schedule->is_booked)
                             <span class="badge badge-danger px-3 py-2">

                                 Booked

                             </span>
                         @else
                             <span class="badge badge-success px-3 py-2">

                                 Available

                             </span>
                         @endif

                     </td>

                 </tr>

             </tbody>

         </table>

     </div>

 </div>
