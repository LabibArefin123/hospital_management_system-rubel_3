  <input type="hidden" name="service_id" value="{{ $service->id }}">
  <input type="hidden" name="type" value="service">
  <input type="hidden" name="appointment_date" id="serviceFormDate" value="{{ old('appointment_date') }}">
  <input type="hidden" name="appointment_time" id="serviceFormTime" value="{{ old('appointment_time') }}">
  <input type="hidden" name="payment_method" id="servicePaymentMethod" value="{{ old('payment_method') }}">
