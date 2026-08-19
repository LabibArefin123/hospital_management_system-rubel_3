<input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
<input type="hidden" name="type" value="doctor">
<input type="hidden" name="appointment_date" id="formDate" value="{{ old('appointment_date') }}">
<input type="hidden" name="appointment_time" id="formTime" value="{{ old('appointment_time') }}">
<input type="hidden" name="payment_method" id="paymentMethod" value="{{ old('payment_method') }}">
