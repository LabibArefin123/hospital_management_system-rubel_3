<div class="modal fade" id="patientUserModal" tabindex="-1" aria-labelledby="patientUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="patientUserModalLabel">
                    <i class="fas fa-user-plus mr-2"></i>
                    Add Appointment Patient User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <form method="POST" action="{{ route('system_users.patient_user_store') }}" id="patientUserForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="patientAppointment">
                            Select Patient Appointment
                            <span class="text-danger">*</span>
                        </label>

                        <select name="appointment_id" id="patientAppointment" class="form-control">
                            <option value=""> Select an appointment user</option>
                            @foreach ($patientAppointmentGroups as $group)
                                <optgroup label="{{ $group['date']->format('d F Y') }}">
                                    @foreach ($group['appointments'] as $appointment)
                                        <option value="{{ $appointment->id }}" data-name="{{ $appointment->name }}"
                                            data-phone="{{ $appointment->phone }}"
                                            data-email="{{ $appointment->email }}">
                                            {{ $appointment->name }}
                                            @if ($appointment->type === 'doctor' && $appointment->doctor)
                                                - Doctor:
                                                {{ $appointment->doctor->name }}
                                            @elseif ($appointment->type === 'service' && $appointment->service)
                                                - Service:
                                                {{ $appointment->service->title }}
                                            @endif
                                            -
                                            {{ $appointment->appointment_time->format('h:i A') }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>

                        @error('appointment_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="patientUserName">Name</label>
                                <input type="text" id="patientUserName" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="patientUserPhone">Phone</label>
                                <input type="text" id="patientUserPhone" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="patientUserEmail"> Email </label>
                                <input type="email" name="email" id="patientUserEmail" class="form-control"
                                    placeholder="Enter patient email">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="patientUserPassword">
                                    New Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password" id="patientUserPassword" class="form-control"
                                    placeholder="Enter new password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="patientUserPasswordConfirmation">
                                    Confirm New Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password_confirmation" id="patientUserPasswordConfirmation"
                                    class="form-control" placeholder="Confirm new password">
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mb-0" id="patientUserInfo">
                        <i class="fas fa-info-circle mr-1"></i>
                        Select an appointment to fill patient information.
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary" id="patientUserSubmit" disabled>
                        <i class="fas fa-user-check mr-1"></i>
                        Add Patient User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
