 <div class="col-md-6">
     <div class="service-booking-right">
         <h4>Booking Summary</h4>
         <p class="service-no-slot" id="serviceNoSlotText">Select a date and time slot</p>
         <div class="service-summary-card">
             <p>
                 <strong>Service:</strong>
                 <span>{{ $service->name ?? $service->title }}</span>
             </p>

             <p>
                 <strong>Name:</strong>
                 <span id="serviceSummaryName">{{ old('name') ?: 'Not Filled' }}</span>
             </p>

             <p>
                 <strong>Age:</strong>
                 <span id="serviceSummaryAge">{{ old('age') ?: 'Not Filled' }}</span>
             </p>

             <p>
                 <strong>Mobile:</strong>
                 <span id="serviceSummaryPhone">{{ old('phone') ?: 'Not Filled' }}</span>
             </p>

             <p>
                 <strong>Gender:</strong>
                 <span id="serviceSummaryGender">{{ old('gender') ?: 'Not Filled' }}</span>
             </p>

             <p>
                 <strong>Date:</strong>
                 <span id="serviceSelectedDate">Not Selected</span>
             </p>

             <p>
                 <strong>Time:</strong>
                 <span id="serviceSelectedTime">Not Selected</span>
             </p>

             <p>
                 <strong>Fee:</strong>
                 <span>{{ number_format($service->price, 2) }} BDT</span>
             </p>


             {{-- PAYMENT PART --}}
             <div class="service-payment">
                 <button type="button" class="service-pay-btn {{ old('payment_method') === 'Cash' ? 'active' : '' }}"
                     data-value="Cash">
                     <i class="fas fa-money-bill-wave"></i>
                     Cash
                 </button>

                 <button type="button"
                     class="service-pay-btn-online {{ old('payment_method') === 'Online' ? 'active' : '' }}"
                     data-value="Online">
                     <i class="fas fa-credit-card"></i>
                     Online
                 </button>
             </div>

             {{-- SELECTED PAYMENT --}}
             <p>
                 <strong>Payment:</strong>
                 <span id="serviceSelectedPayment">{{ old('payment_method') ?: 'Not Selected' }}</span>
             </p>

             {{-- CONFIRM --}}
             <button type="submit" id="serviceConfirmBtn" disabled>
                 <i class="fas fa-calendar-check"></i>
                 Confirm Booking
             </button>
         </div>
     </div>
 </div>
